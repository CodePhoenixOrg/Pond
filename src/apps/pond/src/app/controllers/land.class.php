<?php
namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Land extends Controller
{
    public function load(): ?array
    {

        return [];
    }

    public function here() : ?array
    {
        return ['label' => 'text'];
    }
}

