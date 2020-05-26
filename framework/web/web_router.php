<?php
namespace CodePhoenixOrg\Pond\Framework\Web;

/**
 * Description of router
 *
 * @author David
 */
class WebRouter extends BaseWebObject
{
    use HttpTransport;
    
    //put your code here
    private $viewName = '';    
    private $className = '';
    private $baseNamespace = '';
    private $controllerFileName = '';

    public function __construct(WebApplication $app)
    {
        $this->request = $app->getRequest();
        $this->response = $app->getResponse();
    }

    public function translate()
    {
        $url = parse_url(POND_REQUEST_URI);
        $this->viewName = $url['path'];
        $info = pathinfo($this->viewName);
        $this->viewName = $info['filename'];
        $extension = isset($info['extension']) ? $info['extension'] : '';
        $this->viewName = ($this->viewName === '') ? 'home' : $this->viewName;
        $extension = ($this->viewName === 'home') ? 'html' : $extension;
        
        $this->controllerFileName = POND_SRC_DIR . 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $this->viewName . '.class.php';
        
        return $extension === 'html' && file_exists($this->controllerFileName);
    }

    public function dispatch()
    {

        list($namespace, $className) = static::getClassDefinition($this->controllerFileName);
        $this->className = $className;

        $fqObject = $namespace . '\\' . $className;

        include $this->controllerFileName;

        $view = new View($this->viewName);
        $instance = new $fqObject($view);
        $instance->render();
    }

}
