<?php

namespace CodePhoenixOrg\Pond\Api\Auth;

use CodePhoenixOrg\Pond\Api\AuthApi;
use CodePhoenixOrg\Pond\Framework\Web\RestRequest;

class Login extends AuthApi
{
    private const METHOD = 'login';

    public function post(array $data): array
    {

        $result = [];

        $params = \json_encode($data);

        $req = new RestRequest($this);
        $url = $req->restUrlBuilder(Login::METHOD);

        self::getLogger()->debug($url);

        list($headers, $content) = $req->post($url, $params);
        $result = json_decode($content, true);

        return $result;
    }
}
