<?php
namespace CodePhoenixOrg\Pond\Framework\Core;

use CodePhoenixOrg\Pond\Framework\Core\Registry;
use CodePhoenixOrg\Pond\Framework\File\FileUtils;
use Exception;

class Logger
{
    private const ACCESS_FILENAME = POND_LOGS_DIR . 'access.log';
    private const DEBUG_FILENAME = POND_LOGS_DIR . 'debug.log';
    private const ERROR_FILENAME = POND_LOGS_DIR . 'error.log';
    private $env = '';

    public function __construct()
    {
        $this->env = Registry::read('env');
    }

    public function access($value): void
    {
        $this->log($value, Logger::ACCESS_FILENAME);
    }

    public function debug($value): void
    {
        if ($this->env === Environment::TEST || $this->env === Environment::STAGING) {
            $this->log($value, Logger::DEBUG_FILENAME);
        }
    }

    public function error($value, ?\Exception $ex = null): void
    {
        $this->log($value, Logger::ERROR_FILENAME);
        if($ex !== null) {
            $this->log($ex->getMessage(), Logger::ERROR_FILENAME);
            if($ex->getPrevious() instanceof \Exception) {
                $this->log($ex->getPrevious()->getMessage(), Logger::ERROR_FILENAME);
            }
            $this->log($ex->getTraceAsString(), Logger::ERROR_FILENAME);
        }
    }

    private function log($value, $file): void
    {
        if (is_array($value)) {
            $value = print_r($value, true);
        }
        $value .= PHP_EOL;
        
        \file_put_contents($file, $value, FILE_APPEND);
    }
}
