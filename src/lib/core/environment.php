<?php
namespace CodePhoenixOrg\Pond\Framework\Core;

final class Environment
{
    const TEST = "test";
    const STAGING = "staging";
    const PRODUCTION = "live";

    private const filename = CONFIG_DIR . 'environment.json';
    private $json = '';

    public function __construct()
    {
        if (!\file_exists(Environment::filename)) {
            throw new \Exception('Environment file does not exist');
        }

        $this->json = \file_get_contents(Environment::filename);
        $this->json = \json_decode($this->json, true);

    }

    public function getEnv(): string
    {
        if (!isset($this->json['env'])) {
            throw new \Exception('You must provide the running environment');
        }
        return $this->json['env'];
    }


}
