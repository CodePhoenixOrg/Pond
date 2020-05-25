<?php
namespace CodePhoenixOrg\Pond\Framework\Auth;

class Certificate
{
    private const filename = CONFIG_DIR . 'certificate.json';
    private $json = '';
    private static $instance = null;

    public function __construct()
    {
        if (!\file_exists(Certificate::filename)) {
            throw new \Exception('Certificate file does not exist');
        }

        $this->json = \file_get_contents(Certificate::filename);
        $this->json = \json_decode($this->json, true);

    }

    public function getPath(): string
    {
        if (!isset($this->json['path'])) {
            throw new \Exception('You must provide the path of the certificate');
        }
        return SRC_DIR . '..' . DIRECTORY_SEPARATOR . $this->json['path'];
    }

    public static function getInstance(): Certificate
    {
        if (self::$instance === null) {
            self::$instance = new Certificate();
        }
        return self::$instance;
    }

    public static function path(): string
    {
        return self::getInstance()->getPath();
    }

}
