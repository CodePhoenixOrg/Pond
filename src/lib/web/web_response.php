<?php

namespace CodePhoenixOrg\Pond\Framework\Web;

/**
 * Description of response
 *
 * @author David
 */
class WebResponse extends BaseWebObject implements \JsonSerializable
{
    private $data = [];
    //put your code here
    
    public function setData($key, $value = '')
    {
        if(is_array($key)) {
            foreach ($key as $left => $right) {
                $this->data[$left] = $right;
            }
        } else {
            self::getLogger()->debug($key);
            $this->data[$key] = $value;
        }
    }

    public function returnCode($httpCode)
    {
        return http_response_code($httpCode);
    }
    
    public function jsonSerialize()
    {
        return $this->data;
    }
    
    public function sendJsonData()
    {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($this);
    }
}
