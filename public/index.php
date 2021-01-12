<?php

use System\{
    Error,
    Router, 
    Request
};

require_once '../vendor/autoload.php';

require_once '../config/config.php';
require_once '../config/db.php';

try {
    (new Router(new Request()))->run();
} catch(\Exception $ex) {
    (new Error())->handleException($ex);
    exit();
} catch(\Throwable $th) {
    (new Error())->handleException($th);
    exit();
}