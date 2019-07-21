<?php

namespace app\controllers;

use system\core\base\Controller;

class Files extends Controller
{
    public function indexAction()
    {
        print ' action index';
    }

    public function addAction()
    {
        debug($this->route);
        print ' action add';
    }
}