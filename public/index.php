<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 30.06.2019
 * Time: 15:34
 */
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/system/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

require_once '../system/core/Router.php';
require_once '../system/libs/tools.php';
//require_once '../app/controllers/Main.php';
//require_once '../app/controllers/Files.php';

spl_autoload_register(function ($class) {
    $file = APP . "/controllers/$class.php";
    if (is_file($file)) {
        require_once $file;
    }
});
debug($queryString = $_SERVER['REQUEST_URI']);

Router::addRoute('files/add', ['controller' => 'Files', 'action' => 'add']);
Router::addRoute('^/$', ['controller' => 'Main', 'action' => 'index']);
Router::addRoute('(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
debug(Router::getRouteTable());
Router::handleRoute($queryString);
