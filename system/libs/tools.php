<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 30.06.2019
 * Time: 16:25
 */
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}