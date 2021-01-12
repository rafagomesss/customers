<?php
define('DEFAULT_CONTROLLER', mb_convert_case('home',MB_CASE_TITLE,'UTF8'));
define('DEFAULT_METHOD', mb_convert_case('main',MB_CASE_LOWER,'UTF8'));
define('CONFIG_CLASSES', ['db']);

define('DIR_ROOT', dirname($_SERVER['DOCUMENT_ROOT']));
define('VIEWS_PATH', DIR_ROOT . DIRECTORY_SEPARATOR . 'views');
define('VIEWS_EXT', '.view.php');

define('ASSETS_PATH', '/assets');
define('CSS_PATH', ASSETS_PATH . '/css');
define('JS_PATH', ASSETS_PATH . '/js');
define('IMG_PATH', ASSETS_PATH . '/img');