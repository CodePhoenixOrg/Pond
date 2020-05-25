<?php
namespace CodePhoenixOrg\Pond\Framework\Web;

use CodePhoenixOrg\Pond\Framework\Api\BaseApi;

class RestRequest extends BaseRequest
{
    private $parent;

    public function __construct(BaseApi $parent)
    {
        $this->parent = $parent;
    }

    /**
     * restUrlBuilder
     *
     * @param  string $method
     * @param  string $queryString
     *
     * @return string
     */
    public function restUrlBuilder(string $method, string $queryString = ''): string
    {
        if ($queryString !== '') {
            $queryString = '?' . $queryString;
        }

        $url = $this->parent->getApiPath() . $method . $queryString;

        if (!@\parse_url($url, PHP_URL_QUERY) == $queryString) {
            throw new \Exception('Invalid URL', 1);
        }

        return $url;
    }

    

}
