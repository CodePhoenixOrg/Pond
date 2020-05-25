<?php
namespace CodePhoenixOrg\Pond\Framework\Commands;

use CodePhoenixOrg\Pond\Framework\Core\BaseObject;
use CodePhoenixOrg\Pond\Framework\Core\Recovery;
use CodePhoenixOrg\Pond\Framework\Commands\ICommand;

abstract class BaseCommand extends BaseObject implements ICommand
{
    private static $recovery = null;

    public function __construct()
    {
        parent::__construct();
        self::$recovery = new Recovery();

    }

    public static function getRecovery() {
        return self::$recovery;
    }

}
