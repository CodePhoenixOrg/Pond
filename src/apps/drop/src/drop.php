<?php

namespace CodePhoenixOrg\Pond;

include 'bootstrap.php';

use CodePhoenixOrg\Pond\Framework\Commands\CommandRunner;
use CodePhoenixOrg\Pond\Framework\Core\Console;
use CodePhoenixOrg\Pond\Framework\Core\Environment;
use CodePhoenixOrg\Pond\Framework\Core\Registry;
use CodePhoenixOrg\Pond\Pond\Commands\CommandCollection;

class Pond
{

    private $userCmd = '';

    public static function main(array $argv, int $argc)
    {
        (new Pond($argv, $argc))->run();
    }

    public function __construct(array $argv, int $argc)
    {

        Registry::write('argv', $argv);
        Registry::write('argc', $argc);

        if ($argc > 1) {
            $this->userCmd = $argv[1];
        }
    }

    public function run(): void
    {
        try {

            $env = new Environment();
            Registry::write('env', $env->getEnv());

            $commands = new CommandCollection();
            $runner = new CommandRunner($commands);
            $runner->run($this->userCmd);
        } catch (\Exception $ex) {
            Console::writeLine($ex->getMessage());
            Console::writeLine($ex->getTraceAsString());

        }
    }
}

Pond::main($argv, $argc);
