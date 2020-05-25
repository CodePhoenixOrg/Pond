<?php

namespace CodePhoenixOrg\Pond\Framework\Web;

use CodePhoenixOrg\Pond\Framework\Core\BaseObject;
use CodePhoenixOrg\Pond\Framework\Core\Environment;
use CodePhoenixOrg\Pond\Framework\Core\ServerName;

abstract class BaseWebObject extends BaseObject
{
    protected $serverName = '';

    protected function setEnv(string $value)
    {

        parent::setEnv($value);

        if ($value == Environment::TEST) {
            $this->serverName = ServerName::TEST;
        }
        if ($value == Environment::STAGING) {
            $this->serverName = ServerName::STAGING;
        }
        if ($value == Environment::PRODUCTION) {
            $this->serverName = ServerName::PRODUCTION;
        }

        if ($this->serverName === null) {
            $this->serverName = ServerName::TEST;
        }
    }

    public function getServerName(): string
    {
        return $this->serverName;
    }

    public function getHostName(): string
    {
        return 'https://' . $this->getServerName();
    }

    public function getFullyQualifiedHostName(): string
    {
        return 'https://' . $this->getServerName() . '/';
    }
    
    public static function getClassDefinition(string $filename): array
    {
        $classText = file_get_contents($filename);

        $namespace = self::grabKeywordName('namespace', $classText, ';');
        $className = self::grabKeywordName('class', $classText, ' ');

        return [$namespace, $className, $classText];
    }

    private static function grabKeywordName(string $keyword, string $classText, $delimiter): string
    {
        $result = '';

        $start = strpos($classText, $keyword);
        if ($start > -1) {
            $start += \strlen($keyword) + 1;
            $end = strpos($classText, $delimiter, $start);
            $result = substr($classText, $start, $end - $start);
        }

        return $result;
    }
}
