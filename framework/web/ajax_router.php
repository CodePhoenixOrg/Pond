<?php
namespace CodePhoenixOrg\Pond\Framework\Web;

/**
 * Description of router
 *
 * @author David
 */
class AjaxRouter extends BaseWebObject
{
    use HttpTransport;
    
    //put your code here
    private $apiName = '';
    private $method = '';
    private $className = '';
    private $baseNamespace = '';
    private $controllerFileName = '';
    private $parameter = '';

    public function __construct(WebApplication $app)
    {
        $this->request = $app->getRequest();
        $this->response = $app->getResponse();
    }

    public function translate()
    {
        $url = parse_url(POND_REQUEST_URI);
        $qParts = explode('/', substr($url['path'], 1));
        $this->apiName = array_shift($qParts);
        $this->method = array_shift($qParts);
        $this->parameter = array_shift($qParts);
 
        $this->controllerFileName = POND_SRC_DIR . 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $this->apiName . '.class.php';
        
        return file_exists($this->controllerFileName);
    }

    public function dispatch()
    {
        $data = [];

        list($namespace, $className) = static::getClassDefinition($this->controllerFileName);
        $this->className = $className;

        $fqObject =  '\\' . $namespace . '\\' . $className;

        include $this->controllerFileName;

        $instance = new $fqObject();
        
        $request_body = file_get_contents('php://input');
        if(!empty($request_body)) {
            $data = json_decode($request_body, true);
        }
        
        $params = [];
        if(count($data) > 0) {
            $params = array_values($data);
            if($this->parameter !== null) {
                array_unshift($params, $this->parameter);
            }
        } else {
            if($this->parameter !== null) {
                $params = [$this->parameter];
            }
        }

        $data = null;
        $ref = new \ReflectionMethod($instance, $this->method);
        if(count($params) > 0) {
            $data = $ref->invokeArgs($instance, $params);
        } else {
            $data = $ref->invoke($instance);
        }
        
        $this->response->setData($data);
        $this->response->sendJsonData();		
    }
}