<?php

namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Home extends Controller
{
    public function load(): ?array
    {
        return [
            "items" => [
                ["title" => "CodePhoenixOrg.fr Hello", "url" => "hello.html"],
                ["title" => "CodePhoenixOrg.fr Landing", "url" => "land.html"],
            ]
        ];
    }
}
