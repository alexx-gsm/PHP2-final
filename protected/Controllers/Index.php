<?php

namespace App\Controllers;

use App\Models\Menu;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionMenu($url = '/')
    {
        $this->data->items = Menu::findAllTree();
        $this->data->url = $url;
    }

}