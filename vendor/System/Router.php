<?php
declare(strict_types = 1);

namespace System;

use System\Request;

class Router
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function run()
    {
        $controller = 'Customer\\Controller\\' . mb_convert_case($this->request->getController(), MB_CASE_TITLE, 'UTF8');
        $method = $this->request->getMethod();
        $args = $this->request->getArgs();
        $response = call_user_func_array([
            new $controller, 
            $method], 
            $args
        );
        print $response;
    }
}