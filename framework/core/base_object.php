<?php
namespace CodePhoenixOrg\Pond\Framework\Core;

use CodePhoenixOrg\Pond\Framework\Core\Registry;
use JsonSerializable;

abstract class BaseObject implements JsonSerializable
{
    protected $id;

    private $env = '';
    private static $logger = null;

    public function __construct(?int $id = null)
    {
        $this->id = $id;

        $this->setEnv(Registry::read('env'));
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected function setEnv(string $value)
    {
        $this->env = $value;
    }

    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            self::$logger = new Logger();
        }
        return self::$logger;
    }

    /**
     * getEnv
     *
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }

    public function toString($data = null) : string
    {
        if($data === null) {
            $data = $this;
        }
        return \json_encode($this, JSON_PRETTY_PRINT);
    }

    public function toArray($data = null)
    {
        if($data === null) {
            $data = $this;
        }
        $array = json_decode(json_encode($data), true);

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    
}
