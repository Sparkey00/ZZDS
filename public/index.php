<?php
error_reporting(-1);

use system\core\Router;

$queryString = rtrim($_SERVER['REQUEST_URI'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/system/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

require_once '../system/libs/tools.php';


spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
//    $file = APP . "/controllers/$class.php";
    if (is_file($file)) {
        require_once $file;
    }
});

//Router::addRoute('files/add', ['controller' => 'Files', 'action' => 'add']);
Router::addRoute('^/$', ['controller' => 'Main', 'action' => 'index']);
//Router::addRoute('(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
Router::addRoute('^files/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Files']);
debug(Router::getRouteTable());
Router::handleRoute($queryString);
