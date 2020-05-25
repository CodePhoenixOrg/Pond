<?php

namespace CodePhoenixOrg\Pond\Pond\Commands;

use CodePhoenixOrg\Pond\Framework\Commands\ICommandCollection;

class CommandCollection implements ICommandCollection
{

    public function items(): array
    {

        return
            [
                [
                    "help" => [
                        "description" => "show this help",
                        "callback" => function () {
                            (new \CodePhoenixOrg\Pond\Pond\Commands\Help())->run();
                        },
                    ],
                ],
            ];
    }
}
