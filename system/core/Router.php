<?php

class Router
{
    protected static $routeTable = [];
    protected static $currentRoute = [];

    const DEFAULT_CONTROLLER = 'main';

    /**
     * @param $regexp
     * @param array $route
     */
    public static function addRoute($regexp, $route = [])
    {
        self::$routeTable[$regexp] = $route;
    }

    /**
     * @return array
     */
    public static function getRouteTable()
    {
        return self::$routeTable;
    }

    /**
     * @return array
     */
    public static function getCurrentRoute()
    {
        return self::$currentRoute;
    }

    /**
     * Шукає співпадіння урл з таблицею маршрутів
     *
     * @param $url
     *
     * @return bool
     */
    public static function findRoute($url)
    {
        foreach (self::$routeTable as $path => $route) {
            if (preg_match("#$path#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['controller'])) {
                    $route['controller'] = self::DEFAULT_CONTROLLER;
                }
                self::$currentRoute = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Повертає Строку в камелКейсі
     * @param $string
     * @param bool $startWithUpper
     * @return mixed|string
     */
    protected static function stringToCamelCase($string, $startWithUpper = true)
    {
        $returnString = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        if ($startWithUpper) {
            return $returnString;
        } else {
            return lcfirst($returnString);
        }
    }

    /**
     * Виконує роутинг по маршруту
     *
     * @param $url
     */
    public static function handleRoute($url)
    {
        if (self::findRoute($url)) {
            $controller = self::stringToCamelCase(self::$currentRoute['controller'], true);
            if (class_exists($controller)) {
                $controllerObject = new $controller;
                $action = self::stringToCamelCase(self::$currentRoute['action'], false);
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                } else {
                    echo "Action <b> $action </b> does not exist";
                }
            } else {
                echo "Controller <b> $controller </b> does not exist";
            }
        } else {
            include '404.html';
        }
    }

}