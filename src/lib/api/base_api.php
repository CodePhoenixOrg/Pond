<?php
namespace CodePhoenixOrg\Pond\Framework\Api;

use CodePhoenixOrg\Pond\Framework\Web\BaseWebObject;

abstract class BaseApi extends BaseWebObject 
{
    protected $filename;

    public abstract function getApiPath(): string;
    //{        return 'https://' . $this->serverName . '/helios/api/';     }
}
