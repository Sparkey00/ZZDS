<?php

namespace system\core\base;


abstract class Controller
{
    protected $route = [];
    protected $view = '';

    public function __construct(array $route)
    {
        $this->route = $route;
//        $this->view = $route['action'];
//        include  APP . "/views/{$route['controller']}/{$this->view}.php";
    }
}