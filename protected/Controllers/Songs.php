<?php

namespace App\Controllers;

use App\Models\Menu;
use App\Models\Song;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Songs extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Song::class);
        $this->data->page = $page;
    }

    public function actionMenu($url = '/')
    {
        $this->data->items = Menu::findAllTree();
        $this->data->url = $url;
    }
}