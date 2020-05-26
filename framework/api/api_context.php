<?php

namespace CodePhoenixOrg\Pond\Framework\Api;

final class ApiContext
{

    private const filename = POND_CONFIG_DIR . 'api-context.json';
    private $json = '';

    public function __construct()
    {
        if (!\file_exists(ApiContext::filename)) {
            throw new \Exception('Api context file does not exist');
        }

        $this->json = \file_get_contents(ApiContext::filename);
        $this->json = \json_decode($this->json, true);
    }

    public function getLanguage(): string
    {
        if (!isset($this->json['language'])) {
            throw new \Exception('At least, you must provide the language');
        }
        return $this->json['language'];
    }

    public function getCountry(): string
    {
        if (!isset($this->json['country'])) {
            return '';
        }
        return $this->json['country'];
    }

    public function getPartner(): string
    {
        if (!isset($this->json['partner'])) {
            return '';
        }
        return $this->json['partner'];
    }

    public function getProject(): string
    {
        if (!isset($this->json['project'])) {
            return '';
        }
        return $this->json['project'];
    }


    public function getCache(): string
    {
        if (!isset($this->json['cache'])) {
            return '';
        }
        return $this->json['cache'];
    }
}
