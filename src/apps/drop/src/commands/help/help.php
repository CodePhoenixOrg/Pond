<?php
namespace CodePhoenixOrg\Pond\Pond\Commands;

use CodePhoenixOrg\Pond\Pond\Commands\CommandCollection;
use CodePhoenixOrg\Pond\Framework\Commands\ICommand;

class Help implements ICommand
{

    /**
     * run
     *
     * @return void
     */
    public function run(): void
    {

        $commands = CommandCollection::items();

        $help = <<<HELP
Pond usage :

php pond.php <command> <...params>

where command may be :

HELP;

        foreach ($commands as $command) {
            $key = key($command);
            $usage = $command[$key]['description'];

            $help .= " - $key: $usage" . PHP_EOL;
        }

        $help .= <<<HELP
        
Environment may be one of : test, staging and live.
The default choice is staging, it's the recommended choice anyway.

HELP;
        $help .= PHP_EOL;

        echo $help;
    }
}
