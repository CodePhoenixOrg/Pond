<?php

namespace CodePhoenixOrg\Pond\Framework\File;

class FileUtils 
{

    private const filename = POND_CONFIG_DIR . 'directories.json';
    private $outputDir = POND_OUTPUT_DIR;
    private $inputDir = POND_INPUT_DIR;
    private static $instance;

    private $json = null;

    public function __construct()
    {
        if (!\file_exists(FileUtils::filename)) {
            // using default dirs
            $this->json = [];
            return;
        }

        $this->json = \file_get_contents(FileUtils::filename);
        $this->json = \json_decode($this->json, true);
    }

    public static function getInstance(): FileUtils
    {
        if (self::$instance === null) {
            self::$instance = new FileUtils();
        }
        return self::$instance;
    }

    public static function inputExists(string $filename): bool
    {
        $file = self::inputDir() . $filename;

        return \file_exists($file);
    }

    public static function outputExists(string $filename): bool
    {
        $file = self::outputDir() . $filename;

        return \file_exists($file);
    }

    public static function makedir(string $dirname, ?int $perm = null): bool
    {
        $result = false;

        if ($perm === null) {
            $perm = 0755;
        }

        if (!\file_exists($dirname)) {
            mkdir($dirname, $perm, true);
        }

        $result = \file_exists($dirname);

        return $result;
    }


    public static function translateInput(string $filename): ?string
    {
        return self::inputDir() . $filename;
    }

    public static function translateOutput(string $filename): ?string
    {
        return self::outputDir() . $filename;
    }

    public static function input(string $filename): ?string
    {
        $result = null;

        if (self::inputExists($filename)) {
            $result =  \file_get_contents(self::inputDir() . $filename);
        }
        return $result;
    }

    public static function load(string $filename): ?string
    {
        $result = null;

        if (self::outputExists($filename)) {
            $result =  \file_get_contents(self::outputDir() . $filename);
        }
        return $result;
    }

    public static function output(string $filename, $data, int $flags = 0): bool
    {
        $result = false;

        $info = (object) \pathinfo($filename);
        if (FileUtils::makedir($info->dirname)) {
            \file_put_contents(self::getInstance()->getOutputDir() . $filename, $data, $flags);
        }

        return $result;
    }

    public static function unlink(string $filename): void
    {
        if (self::outputExists($filename)) {
            \unlink(self::outputDir() . $filename);
        }
        
    }

    public function getInputDir(): string
    {
        if (count($this->json) == 0 || !isset($this->json['input'])) {
            return POND_INPUT_DIR;
        }

        $this->inputDir = self::absolutePath($this->json['input'], POND_INPUT_DIR) . DIRECTORY_SEPARATOR;

        return $this->inputDir;
    }

    public function getOutputDir(): string
    {
        if (count($this->json) == 0 || !isset($this->json['output'])) {
            return POND_OUTPUT_DIR;
        }

        $this->outputDir = self::absolutePath($this->json['output'], POND_OUTPUT_DIR) . DIRECTORY_SEPARATOR;

        return $this->outputDir;
    }

    public static function inputDir(): string
    {
        return self::getInstance()->getInputDir();
    }

    public static function outputDir(): string
    {
        return self::getInstance()->getOutputDir();
    }

    public static function absolutePath(string $directory, ?string $default = null): string
    {

        if(POND_IS_WEBAPP && $default !== null) {
            $directory = $default;
            if (!file_exists($directory)) {
                self::makedir($directory);
            }
    
            $path = realpath($directory);

            return $path;

        }

        if ($directory[0] === '@') {
            $directory = __DIR__ . DIRECTORY_SEPARATOR . substr($directory, 1);
        }

        if ($directory[0] === '~') {
            $directory = getenv('HOME') . substr($directory, 1);
        }

        if (!file_exists($directory)) {
            self::makedir($directory);
        }

        $path = realpath($directory);

        if($path == DIRECTORY_SEPARATOR && $default !== null )
        {
            $directory = $default;
            if (!file_exists($directory)) {
                self::makedir($directory);
            }
    
            $path = realpath($directory);
        }

        return $path;
    }
}
