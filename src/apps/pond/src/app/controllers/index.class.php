<?php

namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Home extends Controller
{
    public function load(): ?array
    {
        return [
            "items" => [
                ["name" => "David"],
            ]
        ];
    }
}
