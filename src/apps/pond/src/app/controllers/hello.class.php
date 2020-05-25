<?php
namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Hello extends Controller
{
    public function load(): ?array
    {
        $name =  "David";

        return ["name" => $name];
    }
}
