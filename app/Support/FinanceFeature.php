<?php

namespace App\Support;

class FinanceFeature
{
    private static array $cache = [];

    public static function enabled(string $feature): bool
    {
        if (array_key_exists($feature, self::$cache)) {
            return self::$cache[$feature];
        }

        $config = config('finance_features.features', []);
        $default = (bool) config('finance_features.default_enabled', true);
        $value = $config[$feature] ?? $default;

        return self::$cache[$feature] = (bool) $value;
    }

    public static function flushCache(): void
    {
        self::$cache = [];
    }
}
