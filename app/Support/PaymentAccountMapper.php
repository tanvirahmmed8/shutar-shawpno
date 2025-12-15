<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function getWebConfig;

class PaymentAccountMapper
{
    protected static ?array $configCache = null;
    protected static ?array $overrideCache = null;

    public static function config(): array
    {
        if (static::$configCache !== null) {
            return static::$configCache;
        }

        $config = config('payment_accounts', []);
        $overrides = static::overrideConfig();

        if (!empty($overrides)) {
            if (!empty($overrides['accounts']) && is_array($overrides['accounts'])) {
                $config['accounts'] = array_replace($config['accounts'] ?? [], $overrides['accounts']);
            }

            if (!empty($overrides['methods']) && is_array($overrides['methods'])) {
                foreach ($overrides['methods'] as $methodKey => $definition) {
                    if (!isset($config['methods'][$methodKey]) || !is_array($definition)) {
                        continue;
                    }

                    $config['methods'][$methodKey] = array_merge(
                        $config['methods'][$methodKey],
                        Arr::only($definition, ['label', 'accounts', 'default_account', 'visible'])
                    );
                }
            }

            if (!empty($overrides['aliases']) && is_array($overrides['aliases'])) {
                $config['aliases'] = array_replace($config['aliases'] ?? [], $overrides['aliases']);
            }
        }

        return static::$configCache = $config;
    }

    public static function accounts(): array
    {
        return static::config()['accounts'] ?? [];
    }

    public static function methods(): array
    {
        return static::config()['methods'] ?? [];
    }

    public static function aliases(): array
    {
        return static::config()['aliases'] ?? [];
    }

    public static function normalizeMethod(?string $method): string
    {
        $method = Str::lower(trim((string) $method));
        $aliases = static::aliases();
        if (isset($aliases[$method])) {
            $method = $aliases[$method];
        }

        $methods = static::methods();
        if (!isset($methods[$method])) {
            return 'default';
        }

        return $method;
    }

    public static function methodKeys(): array
    {
        return array_keys(static::methods());
    }

    public static function methodOptions(bool $visibleOnly = true): array
    {
        $methods = static::methods();

        return collect($methods)
            ->filter(function ($definition, $key) use ($visibleOnly) {
                if ($key === 'default' && $visibleOnly) {
                    return false;
                }

                return $visibleOnly ? ($definition['visible'] ?? true) : true;
            })
            ->mapWithKeys(function ($definition, $key) {
                return [$key => static::translateLabel($definition['label'] ?? $key)];
            })
            ->all();
    }

    public static function accountOptionsFor(string $method, bool $includeCustom = true): array
    {
        $method = static::normalizeMethod($method);
        $methods = static::methods();
        $accounts = static::accounts();
        $methodDef = $methods[$method] ?? $methods['default'] ?? [];
        $accountKeys = $methodDef['accounts'] ?? [];

        $options = [];
        foreach ($accountKeys as $accountKey) {
            if (!isset($accounts[$accountKey])) {
                continue;
            }
            $options[$accountKey] = static::translateLabel($accounts[$accountKey]['label'] ?? $accountKey);
        }

        if ($includeCustom) {
            $options['custom'] = static::customAccountLabel();
        }

        return $options;
    }

    public static function methodAccountMatrix(): array
    {
        $matrix = [];
        foreach (static::methods() as $methodKey => $definition) {
            $matrix[$methodKey] = static::formatAccountsForMatrix($methodKey);
        }
        $matrix['__default'] = static::formatAccountsForMatrix('default');

        return $matrix;
    }

    protected static function methodDefaultAccounts(): array
    {
        $defaults = [];
        $methods = static::methods();
        foreach ($methods as $methodKey => $definition) {
            $defaults[$methodKey] = $definition['default_account'] ?? null;
        }

        if (!array_key_exists('__default', $defaults)) {
            $defaults['__default'] = $defaults['default'] ?? null;
        }

        return $defaults;
    }

    protected static function formatAccountsForMatrix(string $method): array
    {
        $options = static::accountOptionsFor($method, false);
        $formatted = [];
        foreach ($options as $value => $label) {
            $formatted[] = ['value' => $value, 'label' => $label];
        }

        return $formatted;
    }

    public static function resolveAccount(string $method, string $accountKey): ?array
    {
        $method = static::normalizeMethod($method);
        $accounts = static::accounts();
        if (!isset($accounts[$accountKey])) {
            return null;
        }

        $allowed = static::accountOptionsFor($method, false);
        if (!array_key_exists($accountKey, $allowed)) {
            return null;
        }

        $definition = $accounts[$accountKey];

        return [
            'key' => $accountKey,
            'code' => $definition['code'] ?? null,
            'label' => static::translateLabel($definition['label'] ?? $accountKey),
        ];
    }

    public static function defaultAccountFor(string $method): ?string
    {
        $method = static::normalizeMethod($method);
        $methods = static::methods();
        $definition = $methods[$method] ?? $methods['default'] ?? [];

        return $definition['default_account'] ?? null;
    }

    public static function customAccountLabel(): string
    {
        return __('Custom account');
    }

    public static function methodAccountMatrixForJs(): array
    {
        return [
            'options' => static::methodAccountMatrix(),
            'defaults' => static::methodDefaultAccounts(),
            'custom_label' => static::customAccountLabel(),
        ];
    }

    protected static function translateLabel(string $label): string
    {
        return __($label);
    }

    protected static function overrideConfig(): array
    {
        if (static::$overrideCache !== null) {
            return static::$overrideCache;
        }

        $stored = getWebConfig('payment_account_mapping');
        if (is_string($stored)) {
            $decoded = json_decode($stored, true);
        } else {
            $decoded = $stored;
        }

        if (!is_array($decoded)) {
            $decoded = [];
        }

        return static::$overrideCache = $decoded;
    }

    public static function refresh(): void
    {
        static::$configCache = null;
        static::$overrideCache = null;
    }
}
