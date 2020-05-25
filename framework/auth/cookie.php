<?php
namespace CodePhoenixOrg\Pond\Framework\Auth;

use CodePhoenixOrg\Pond\Framework\File\FileUtils;

class Cookie
{
    private const COOKIES_DIR = ROOT_DIR . 'cookies';
    private const COOKIES_FILENAME = Cookie::COOKIES_DIR . DIRECTORY_SEPARATOR . 'cookies.txt';

    public static function load(): ?string
    {
        return (\file_exists(Cookie::COOKIES_FILENAME)) ? \file_get_contents(Cookie::COOKIES_FILENAME) : null;
    }

    public static function save(array $cookies): bool
    {
        $result = [];
        $hasPhxToken = false;
        $hasRefreshToken = false;

        foreach ($cookies as $key => $value) {
            if($key == 'token') {
                $key = 'phx_token';
                $hasPhxToken = true;
            }
            if($key == 'refresh_token') {
                $key = 'phx_refresh_token';
                $hasRefreshToken = true;
            }

            $result[] = $key . '=' . $value;
        }

        file_put_contents(Cookie::COOKIES_FILENAME, join(";", $result));

        return $hasPhxToken && $hasRefreshToken;
    }

    public static function parse(string $response): array
    {
        $result = [];

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);

        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $result = array_merge($result, $cookie);
        }

        return $result;
    }
}
