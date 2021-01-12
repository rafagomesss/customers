<?php

declare(strict_types = 1);

namespace System;


class Request
{
    private string $controller;
    private string $method;
    private array $args = [];
    
    public function __construct()
    {
        $this->defineRequest();
    }

    private function defineRequest()
    {
        $uri = parse_url(substr($_SERVER['REQUEST_URI'], 1), PHP_URL_PATH);
        $uri = explode('/', $uri);

        $this->controller = !empty($uri[0]) ? array_shift($uri) : DEFAULT_CONTROLLER;
        $this->method = !empty($uri[0]) ? array_shift($uri) : DEFAULT_METHOD;
        $this->args = !empty($uri) ? $uri : [];
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function setArgs($args)
    {
        $this->args = $args;

        return $this;
    }
}