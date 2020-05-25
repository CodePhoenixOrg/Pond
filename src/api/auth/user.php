<?php

namespace CodePhoenixOrg\Pond\Api\Auth;

use CodePhoenixOrg\Pond\Api\AuthApi;
use CodePhoenixOrg\Pond\Framework\Web\RestRequest;

class User extends AuthApi
{
    private const METHOD = 'user';

    public function post(array $data): array
    {

        $result = [];

        $params = \json_encode($data);

        $req = new RestRequest($this);
        $url = $req->restUrlBuilder(User::METHOD);

        self::getLogger()->debug($url);

        list($headers, $content) = $req->post($url, $params);
        $result = json_decode($content, true);

        return $result;
    }
}
