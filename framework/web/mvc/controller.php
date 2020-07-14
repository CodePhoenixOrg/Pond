<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodePhoenixOrg\Pond\Framework\Web;

use Reed\Template\TTemplateEngine;
use Reed\Template\TTemplateLoader;

/**
 * Description of controller
 *
 * @author David
 */
abstract class Controller extends BaseWebObject
{

    use HttpTransport;

    //put your code here
    private $view;
    private $twigEnvironment = null;
    private $engine = null;

    public function __construct(?View $view = null)
    {

        $id = uniqid(microtime());
        parent::__construct($id);

        $this->response = new WebResponse();
        $this->request = new WebRequest();

        if ($view === null) {
            return;
        }

        $this->view = $view;

        $loader = new TTemplateLoader(VIEWS_DIR);
        $this->engine = new TTemplateEngine($loader);

        // $loader = new \Twig\Loader\FilesystemLoader(VIEWS_DIR);
        // $this->twigEnvironment = new \Twig\Environment($loader, [
        //     'cache' => POND_CACHE_DIR,
        // ]);
    }

    abstract public function load(): ?array;

    public function render()
    {
        $dictionary = $this->load();

        // $html = $this->twigEnvironment->render($this->view->getRelativeViewFilename(), $dictionary);
        $html = $this->engine->render($this->view->getRelativeViewFilename(), $dictionary);

        echo $html;
    }
}
