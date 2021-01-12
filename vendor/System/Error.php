<?php

namespace System;

use Customer\Controller\Controller;

class Error extends Controller
{
    public function handleException($exception)
    {
        $data['exception'] = $exception;
        parent::prepareView('error/error', $data, true);
    }
}