<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodePhoenixOrg\Pond\Framework\Web;

/**
 * Description of view
 *
 * @author David
 */
class View extends BaseWebObject
{
    //put your code here
    private $viewName = '';
    private $viewFileName = '';
    
    public function __construct($viewName)
    {
        $this->viewName = $viewName;
        $this->viewFileName = POND_SRC_DIR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $viewName . '.phtml';
        $this->viewFileName = realpath($this->viewFileName);
    }
    
    public function getViewName() : string 
    {
        return $this->viewName;
    }

    public function getViewFilename() : string 
    {
        return $this->viewFileName;
    }

    public function getRelativeViewFilename() : string 
    {
        return $this->viewName . '.phtml';
    }

    public function getTemplate(): string
    {
        $template = file_get_contents($this->viewFileName);
        
        return $template;
    }
}
