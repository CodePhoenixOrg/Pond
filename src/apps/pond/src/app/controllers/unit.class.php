<?php

namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Token extends Controller
{
    public function load(): ?array
    {
        return ["assert" => true ? 'TRUE' : 'FALSE'];
    }
}
