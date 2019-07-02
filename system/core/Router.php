<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 30.06.2019
 * Time: 15:53
 */

class Router
{
    protected static $routeTable = [];
    protected static $currentRoute = [];

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
                self::$currentRoute = $route;
                return true;
            }
        }
        return false;
    }

    public static function handleRoute($url)
    {
        if (self::findRoute($url)) {
            print 'OK';
        } else {
            include '404.html';
        }
    }

}