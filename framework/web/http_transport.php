<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodePhoenixOrg\Pond\Framework\Web;

/**
 * Description of httpmessage
 *
 * @author David
 */
trait HttpTransport
{
    //put your code here
    protected $request = null;
    protected $response = null;

    public function getRequest(): WebRequest
    {
        return $this->request;
    }

    public function getResponse(): WebResponse
    {
        return $this->response;
    }
}
