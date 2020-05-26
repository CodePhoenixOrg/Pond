<?php

namespace CodePhoenixOrg\Pond\Framework\Core;

use CodePhoenixOrg\Pond\Framework\Text\TextUtils;

class Console
{
    public static function write($string, ...$params): void
    {
        if (POND_IS_WEBAPP) {
            return;
        }

        $value = TextUtils::concat($string, $params);

        echo $value;
    }

    public static function writeLine($string, ...$params): void
    {
        if (POND_IS_WEBAPP) {
            return;
        }
        
        $value = TextUtils::concat($string, $params);

        echo $value . PHP_EOL;
    }
}
