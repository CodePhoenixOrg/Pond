<?php

namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Token extends Controller
{

    public function load(): ?array
    {
        $token = (isset(REQUEST_PARAMS['token'])) ? REQUEST_PARAMS['token'] : '';

        $translated = 'Token is empty';
        if(!empty($token)) {
            $translated = $this->decodeToken($token);
        }

        return ['token' => $token, 'cumulus' => $translated];
    }

    public function decodeToken(string $token): string
    {

        $result = "";
        $password = 'fFhsdvg4§$5dfgDFFH572q9sFKdxb5sjsSW';

        $result = basename($token);
        $result = self::safeBase64decode($result);
        $output = openssl_decrypt($result, 'AES-128-ECB', $password);

        $pos = strrpos($output, '/');
        $output = substr($output, 0, $pos);

        $result = $output;

        return $result;

        // $this->getResponse()->setData(["token" => $token]);

        // $this->getResponse()->sendJsonData();
    }

    public static function safeBase64decode($string)
    {

        $data = str_replace(['-', '_'], ['+', '/'], $string);
        $mod4 = strlen($data) % 4;

        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        return base64_decode($data);
    }
}
