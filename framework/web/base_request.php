<?php

namespace CodePhoenixOrg\Pond\Framework\Web;

use CodePhoenixOrg\Pond\Framework\Auth\Certificate;
use CodePhoenixOrg\Pond\Framework\Auth\Cookie;
use CodePhoenixOrg\Pond\Framework\Web\BaseWebObject;

abstract class BaseRequest extends BaseWebObject
{

    /**
     * get
     *
     * @param  string $url
     *
     * @return array
     */
    public function get(string $url): array
    {
        $cookie = Cookie::load();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_CAINFO, Certificate::path()); // Disabled SSL Cert checks
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        $headers = [];
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0';
        $headers[] = 'POND_ACCEPT: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Origin: ' . $this->getHostName();
        $headers[] = 'Cookie: ' . $cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $header = curl_getinfo($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);

        if ($errorno) {
            $errormsg = curl_error($ch);
            throw new \Exception($errormsg, $errorno);
        }

        return [$header, $result];
    }

    /**
     * post
     *
     * @param  string $url
     * @param  string $postFields
     *
     * @return array
     */
    public function post(string $url, string $postFields): array
    {
        $cookie = Cookie::load();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_CAINFO, Certificate::path()); // Disabled SSL Cert checks
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        $headers = [];
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0';
        $headers[] = 'POND_ACCEPT: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Origin: ' . $this->getHostName();
        $headers[] = 'Cookie: ' . $cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $header = curl_getinfo($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);

        if ($errorno) {
            $errormsg = curl_error($ch);
            throw new \Exception($errormsg, $errorno);
        }

        return [$header, $result];
    }

    /**
     * put
     *
     * @param  string $url
     * @param  string $postFields
     *
     * @return array
     */
    public function put(string $url, string $postFields = ''): array
    {
        $cookie = Cookie::load();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_CAINFO, Certificate::path()); // Disabled SSL Cert checks
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        $headers = [];
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0';
        $headers[] = 'POND_ACCEPT: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Origin: ' . $this->getHostName();
        $headers[] = 'Cookie: ' . $cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $header = curl_getinfo($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);

        if ($errorno) {
            $errormsg = curl_error($ch);
            throw new \Exception($errormsg, $errorno);
        }

        return [$header, $result];
    }

    /**
     * form
     *
     * @param  string $url
     * @param  string $postFields
     *
     * @return array
     */
    public function form(string $url, string $postFields): array
    {
        $result = [];

        $len = \strlen($postFields);
        $headers = [];
        $headers[] = 'Host: ' . $this->getServerName();
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Content-Length: ' . $len;
        $headers[] = 'Origin: ' . $this->getHostName();

        $ch = curl_init();

        // // curl_setopt($ch, CURLOPT_URL, $url); 

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 0);
        curl_setopt($ch, CURLOPT_CAINFO, Certificate::path()); // Disabled SSL Cert checks
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $body = curl_exec($ch);

        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);

        curl_close($ch);

        if ($errmsg !== '') {
            throw new \Exception($errmsg, $err);
        }

        return [$header, $body];
    }

}
