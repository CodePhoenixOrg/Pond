<?php
namespace CodePhoenixOrg\Pond\Framework\Web;

use CodePhoenixOrg\Pond\Framework\Core\Environment;
use CodePhoenixOrg\Pond\Framework\Core\Registry;

/**
 * Description of application
 *
 * @author David
 */
class WebApplication extends BaseWebObject
{
    //put your code here
    use HttpTransport;
    
    public static function create()
    {
        (new WebApplication())->run();
    }

    public function __construct()
    {
        $env = new Environment();
        Registry::write('env', $env->getEnv());

        parent::__construct();
    }
    
    public function run()
    {
        $this->request = new WebRequest();
        $this->response = new WebResponse();
        
        $router = null;
        if(strstr(POND_ACCEPT, 'application/json' )) {
            $router = new AjaxRouter($this);
        }
        if(strstr(POND_ACCEPT, 'application/xhtml+xml' )) {
            $router = new WebRouter($this);
        }

        if(strstr(POND_ACCEPT, '*/*' )) {
            $router = new WebRouter($this);
        }

        if($router->translate()) {
            $router->dispatch();
        } else {
            $this->response->returnCode(404);
            echo "<h1>Error 404 - You're searching in the wrong place</h1>";
        }
        
    }
}
