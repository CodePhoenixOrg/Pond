<?php
namespace CodePhoenixOrg\Pond\Framework\Auth;

final class Credentials
{
    private const filename = CONFIG_DIR . 'credentials.json';
    private $json = '';

    public function __construct()
    {
        if (!\file_exists(Credentials::filename)) {
            throw new \Exception('Credentials file does not exist');
        }

        $this->json = \file_get_contents(Credentials::filename);
        $this->json = \json_decode($this->json, true);

    }

    public function getUserName(): string
    {
        if (!isset($this->json['username'])) {
            throw new \Exception('You must provide the user name');
        }
        return $this->json['username'];
    }

    public function getPassword(): string
    {
        if (!isset($this->json['password'])) {
            throw new \Exception('You must provide the password');
        }
        return $this->json['password'];
    }

}
