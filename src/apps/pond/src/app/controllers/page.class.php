<?php

namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Page extends Controller
{
    public function load(): ?array
    {
        return ["firstname" => "David"];
    }
}
