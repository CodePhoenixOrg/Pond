<?php
namespace CodePhoenixOrg\Pond\Framework\Core;

class Registry
{
    private static $items;

    public static function write(string $key, $item): void
    {
        if (!isset(self::$items[$key])) {
            self::$items[$key] = null;
        }
        self::$items[$key] = $item;
    }

    public static function read($key, $item = null)
    {
        if (!isset(self::$items[$key])) {
            throw new \Exception("No key like $key has been found");
        }

        if ($item === null) {
            return self::$items[$key];
        }

        if (!isset(self::$items[$key][$item])) {
            throw new \Exception("No item like $item has been found under key $key");
        }

        return self::$items[$key][$item];

    }
}
