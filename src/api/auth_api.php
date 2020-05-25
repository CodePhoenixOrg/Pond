<?php
namespace CodePhoenixOrg\Pond\Api;

use CodePhoenixOrg\Pond\Framework\Api\BaseApi;

abstract class AuthApi extends BaseApi
{
    public function getApiPath(): string
    {       
        return 'https://' . $this->getServerName() . '/auth/api/';     
    }
}
