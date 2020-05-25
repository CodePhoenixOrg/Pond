<?php

namespace CodePhoenixOrg\Pond\Framework\Api;

use CodePhoenixOrg\Pond\Api\Auth\Login;
use CodePhoenixOrg\Pond\Api\Auth\User;
use CodePhoenixOrg\Pond\Framework\Auth\Cookie;
use CodePhoenixOrg\Pond\Framework\Auth\Credentials;

class ApiHelper
{
    private static $_context = null;

    public static function getEntry(?array $entry): ?array
    {
        if (is_array($entry) && isset($entry['0'])) {
            $entry = $entry['0'];
        }

        return $entry;
    }

    public static function toObject($entry): ?object
    {
        $o = null;

        if (is_array($entry)) {
            $o = (object) $entry;
        }
        if (is_object($entry)) {
            $o = $entry;
        }

        return $o;
    }

    public static function hasProperty(?object $object, string $member): bool
    {
        $result =  (is_object($object) && property_exists($object, $member));

        return $result;
    }

    public static function userLogon(): bool
    {
        $ok = false;

        $credentials = new Credentials();
        $req = new Login();
        $loginData = [
            "_username" => $credentials->getUserName(),
            "_password" => $credentials->getPassword()
        ];

        $res = $req->post($loginData);

        $ok = Cookie::save($res);

        if (!$ok) {
            throw new \Exception("Authentication failed");
        }

        $req = new User();
        $res = $req->get();

        $entry = ApiHelper::getEntry($res);

        $ok = isset($entry['username']);
        if (!$ok) {
            throw new \Exception("Authentication failed");
        }

        $o = ApiHelper::toObject($entry);
        $ok = $credentials->getUserName() === $o->username;

        return $ok;
    }

    public static function contextLanguage(): string
    {
        if (self::$_context === null) {
            self::$_context =  new ApiContext();
        }

        return self::$_context->getLanguage();
    }

    public static function contextCountry(): string
    {
        if (self::$_context === null) {
            self::$_context =  new ApiContext();
        }

        return self::$_context->getCountry();
    }

    public static function contextPartner(): string
    {
        if (self::$_context === null) {
            self::$_context =  new ApiContext();
        }

        return self::$_context->getPartner();
    }

    public static function contextProject(): string
    {
        if (self::$_context === null) {
            self::$_context =  new ApiContext();
        }

        return self::$_context->getProject();
    }

    public static function contextCache(): bool
    {
        if (self::$_context === null) {
            self::$_context =  new ApiContext();
        }

        return self::$_context->getCache() == 1;
    }
}
