<?php

declare(strict_types = 1);

namespace Customer\Controller;

use Customer\Controller\Controller;
use Customer\Model\ModelCustomer;

class Home extends Controller
{
    public function __construct()
    {
    }

    public function main()
    {
        parent::prepareView('home',[], true);
    }
}