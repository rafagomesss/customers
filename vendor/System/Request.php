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

    private function defineRequest(): void
    {
        $uri = parse_url(substr($_SERVER['REQUEST_URI'], 1), PHP_URL_PATH);
        $uri = explode('/', $uri);

        $this->controller = !empty($uri[0]) ? array_shift($uri) : DEFAULT_CONTROLLER;
        $this->method = !empty($uri[0]) ? array_shift($uri) : DEFAULT_METHOD;
        $this->args = !empty($uri) ? $uri : [];
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController($controller): Request
    {
        $this->controller = $controller;

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod($method): Request
    {
        $this->method = $method;

        return $this;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function setArgs($args): Request
    {
        $this->args = $args;

        return $this;
    }
}