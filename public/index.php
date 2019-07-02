<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 30.06.2019
 * Time: 15:34
 */
require_once '../system/core/Router.php';
require_once '../system/libs/tools.php';

debug($queryString = $_SERVER['REQUEST_URI']);

//Router::addRoute('posts/add', ['controller' => 'Posts', 'action' => 'add']);
Router::addRoute('^/$', ['controller' => 'Main', 'action' => 'index']);
Router::addRoute('(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
debug(Router::getRouteTable());
Router::handleRoute($queryString);
