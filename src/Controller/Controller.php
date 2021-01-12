<?php

declare(strict_types = 1);

namespace Customer\Controller;

use System\Request;

class Controller
{
    public function __construct()
    {
    }

    private function delimeterRequest(): array
    {
        $request = new Request();
        return [
            'controller' => $request->getController(),
            'method' => $request->getMethod(),
            'args' => $request->getArgs(),
        ];
    }

    protected function prepareView(string $view, array $data = [], bool $menu = false)
    {
        $ds = DIRECTORY_SEPARATOR; 
        $this->loadView("include{$ds}header");
        if ($menu) {
            $this->loadView("include{$ds}menu");
        }
        $data['request'] = $this->delimeterRequest();
        $this->loadView($view, $data);
        $this->loadView("include{$ds}footer", $data['request']);
    }

    protected function loadView(string $view, $data = null)
    {
        if (is_array($data) && count($data)) {
            extract($data, EXTR_PREFIX_SAME, 'data');
        }

        $file = str_replace(
            ['\\', '\\\\', '/', '\/'],
            DIRECTORY_SEPARATOR,
            VIEWS_PATH . DIRECTORY_SEPARATOR . $view . VIEWS_EXT
        );

        if (!file_exists($file)) {
            throw new \Exception('View ' . $file . ' não existe!');
        }

        if (!require_once($file)) {
            throw new \Exception('Erro ao carregar o arquivo ' . $file);
        }

    }
}