<?php
namespace CodePhoenixOrg\Pond\Framework\Commands;

use CodePhoenixOrg\Pond\Framework\Commands\ICommandCollection;
use CodePhoenixOrg\Pond\Framework\Core\BaseObject;
use CodePhoenixOrg\Pond\Framework\Core\Console;

class CommandRunner extends BaseObject
{

    private $_commands;

    public function __construct(ICommandCollection $commands)
    {
        $this->_commands = $commands;    
    }

    public function run(string $userCommamd): void
    {
        $isFound = false;
        $commands = $this->_commands->items();

        foreach ($commands as $command) {
            $key = key($command); 

            $callback = $command[$key]['callback'];

            if ($key === $userCommamd) {
                $isFound = true;
                \call_user_func($callback);
            }
        }

        if (!$isFound) {
            $cowsay = <<<COWSAY
 ___________________________
/       It looks like       \
| you don't know what to do |
\      Use pond help      /
 ---------------------------
     \  ^__^
      \ (oo)\________
        (__)\        )\/\
             ||----w |
             ||     ||

COWSAY;
            Console::writeLine($cowsay);
        }
    }

}
