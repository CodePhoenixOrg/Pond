<?php
namespace CodePhoenixOrg\Pond\Framework\Web;

class WebRequest extends BaseRequest
{

    /**
     * urlBuilder
     *
     * @param  string $method
     * @param  string $queryString
     *
     * @return string
     */
    public function urlBuilder(string $method, string $queryString = ''): string
    {
        if ($queryString !== '') {
            $queryString = '?' . $queryString;
        }

        $url = $this->getFullyQualifiedHostName() . $method . $queryString;

        if (!@\parse_url($url, PHP_URL_QUERY) == $queryString) {
            throw new \Exception('Invalid URL');
        }

        return $url;
    }

}
