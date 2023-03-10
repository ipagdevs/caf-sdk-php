<?php

namespace Kyc\Caf\Util;

abstract class ArrayUtil
{
    public const ACCESS_SEPARATOR = '.';

    public static function get(string $path, array $array, $default = null)
    {
        $splitPath = explode(self::ACCESS_SEPARATOR, $path);

        while (is_array($array) && ($key = array_shift($splitPath))) {
            if (array_key_exists($key, $array)) {
                $array = &$array[$key];
            } else {
                $array = null;
            }
        }

        return is_null($array) || !empty($splitPath) ? $default : $array;
    }

    public static function set(string $path, array &$array, $value = null): void
    {
        $splitPath = explode(self::ACCESS_SEPARATOR, $path);

        while (is_array($array) && ($key = array_shift($splitPath))) {
            if (!$splitPath) {
                $array[$key] = $value;
            } else {
                if (array_key_exists($key, $array) && is_array($array[$key])) {
                    $array = &$array[$key];
                } else {
                    $array[$key] = [];
                    $array = &$array[$key];
                }
            }
        }
    }

    public static function array_filter_recursive(array $input, $checkBoolean = false): array
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = self::array_filter_recursive($value, $checkBoolean);
            }
        }

        if ($checkBoolean) {
            return array_filter($input, static function ($var) {
                return $var !== null;
            });
        }

        return array_filter($input, function ($value) {
            return (isset($value) && $value != '');
        });
    }
}
