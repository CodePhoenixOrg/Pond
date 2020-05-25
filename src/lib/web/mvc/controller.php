<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodePhoenixOrg\Pond\Framework\Web;

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

    public function __construct(?View $view = null)
    {

        $id = uniqid(microtime());
        parent::__construct($id);

        $this->response = new WebResponse();
        $this->request = new WebRequest();

        if($view === null) {
            return;
        }

        $this->view = $view;
        $loader = new \Twig\Loader\FilesystemLoader(VIEWS_DIR);
        $this->twigEnvironment = new \Twig\Environment($loader, [
            'cache' => CACHE_DIR,
        ]);
    }

    abstract public function load(): ?array;

    public function render()
    {
        $dictionary = $this->load();

        $html = $this->twigEnvironment->render($this->view->getRelativeViewFilename(), $dictionary);
        echo $html;
    }
}
