<?php

use System\{
    Router, 
    Request
};

require_once '../vendor/autoload.php';

require_once '../config/config.php';
require_once '../config/db.php';

try {
    (new Router(new Request()))->run();
} catch(\Exception $ex) {
    echo 'Exception: ' . $ex->getMessage() . ' Line: ' . $ex->getLine() . ' File: ' . $ex->getFile();
} catch(\Throwable $th) {
    echo 'Throwable: ' . $th->getMessage() . ' Line: ' . $th->getLine() . ' File: ' . $th->getFile();
}