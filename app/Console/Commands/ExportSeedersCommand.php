<?php

namespace App\Console\Commands;

use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;

class ExportSeedersCommand extends Command
{
    protected $signature = 'db:export-seeders
                            {--connection= : Database connection to use}
                            {--path= : Relative path where seeder files will be stored}
                            {--chunk=1000 : Number of rows per chunk when exporting data}';

    // php artisan db:export-seeders --path=database/seeders/snapshots

    protected $description = 'Generate seeder classes for every non-empty table in the database.';

    public function handle(): int
    {
        $connection = $this->option('connection') ?: config('database.default');
        $relativePath = $this->option('path');
        $targetPath = $relativePath ? base_path($relativePath) : database_path('seeders/exports');
        $this->ensureDirectory($targetPath);

        $tables = $this->listTables($connection);
        if (empty($tables)) {
            $this->warn('No tables were discovered for the selected connection.');
            return self::SUCCESS;
        }

        $chunkSize = max((int) $this->option('chunk'), 100);
        $written = 0;

        foreach ($tables as $table) {
            $count = DB::connection($connection)->table($table)->count();
            if ($count === 0) {
                $this->line("Skipping {$table} (empty)");
                continue;
            }

            $className = $this->classNameFor($table);
            $filePath = $targetPath . DIRECTORY_SEPARATOR . $className . '.php';

            $this->exportTable($connection, $table, $className, $filePath, $chunkSize);
            $written++;
            $this->info("Exported {$count} row(s) to {$className}.");
        }

        $this->info("Seeder export finished. {$written} file(s) saved to {$targetPath}.");
        return self::SUCCESS;
    }

    private function ensureDirectory(string $path): void
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    private function listTables(string $connection): array
    {
        try {
            $schemaManager = DB::connection($connection)->getDoctrineSchemaManager();
            if ($schemaManager) {
                return $schemaManager->listTableNames();
            }
        } catch (Throwable $exception) {
            // fall through to driver specific queries
        }

        $connectionInstance = DB::connection($connection);
        $driver = $connectionInstance->getDriverName();
        $database = $connectionInstance->getDatabaseName();

        return match ($driver) {
            'mysql' => $this->pluckColumn(
                DB::select('SHOW FULL TABLES WHERE Table_type = "BASE TABLE"'),
                'Tables_in_' . $database
            ),
            'pgsql' => $this->pluckColumn(
                DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'"),
                'tablename'
            ),
            'sqlite' => $this->pluckColumn(
                DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'"),
                'name'
            ),
            'sqlsrv' => $this->pluckColumn(
                DB::select("SELECT TABLE_NAME as name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'"),
                'name'
            ),
            default => [],
        };
    }

    private function pluckColumn(array $rows, string $column): array
    {
        $names = [];
        foreach ($rows as $row) {
            $rowArray = (array) $row;
            if (!empty($rowArray[$column])) {
                $names[] = $rowArray[$column];
            }
        }

        return $names;
    }

    private function firstSortableColumn(string $connection, string $table): ?string
    {
        try {
            $schemaManager = DB::connection($connection)->getDoctrineSchemaManager();
            $details = $schemaManager?->listTableDetails($table);
            if ($details) {
                $primaryKey = $details->getPrimaryKey();
                if ($primaryKey && !empty($primaryKey->getColumns())) {
                    return $primaryKey->getColumns()[0];
                }

                $columns = $details->getColumns();
                if (!empty($columns)) {
                    return array_keys($columns)[0];
                }
            }
        } catch (Throwable $exception) {
            // ignore and fallback to schema builder
        }

        $list = DB::connection($connection)->getSchemaBuilder()->getColumnListing($table);
        return $list[0] ?? null;
    }

    private function exportTable(string $connection, string $table, string $className, string $filePath, int $chunkSize): void
    {
        $handle = fopen($filePath, 'w');
        if (! $handle) {
            throw new \RuntimeException("Unable to open {$filePath} for writing.");
        }

        fwrite($handle, $this->fileHeader($className, $table));
        fwrite($handle, "        \$chunks = [];" . PHP_EOL);

        $builder = DB::connection($connection)->table($table);
        if ($orderColumn = $this->firstSortableColumn($connection, $table)) {
            $builder->orderBy($orderColumn);
        }

        $buffer = [];
        foreach ($builder->lazy($chunkSize) as $row) {
            $buffer[] = $this->normalizeRow((array) $row);
            if (count($buffer) >= $chunkSize) {
                $this->writeChunk($handle, $buffer);
                $buffer = [];
            }
        }

        if (! empty($buffer)) {
            $this->writeChunk($handle, $buffer);
        }

        fwrite($handle, <<<PHP
        foreach (\$chunks as \$rows) {
            DB::table('{$table}')->insert(\$rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}

PHP);

        fclose($handle);
    }

    private function fileHeader(string $className, string $table): string
    {
        return <<<PHP
<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Schema;

class {$className} extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('{$table}')->truncate();

PHP;
    }

    private function writeChunk($handle, array $chunk): void
    {
        $export = var_export($chunk, true);
        $export = $this->indent($export, 3);
        fwrite($handle, '        $chunks[] =' . PHP_EOL . $export . ';' . PHP_EOL);
    }

    private function normalizeRow(array $row): array
    {
        foreach ($row as $key => $value) {
            if ($value instanceof DateTimeInterface) {
                $row[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $row;
    }

    private function indent(string $value, int $level): string
    {
        $padding = str_repeat('    ', $level);
        return preg_replace('/^/m', $padding, $value);
    }

    private function classNameFor(string $table): string
    {
        return Str::studly(Str::singular($table)) . 'TableSeeder';
    }
}
