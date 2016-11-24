<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Menu;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class News
    extends Controller
{

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Article::class, ['order' => 'published DESC']);
        $this->data->page = $page;
    }

    public function actionMenu($url = '/')
    {
        $this->data->items = Menu::findAllTree();
        $this->data->url = $url;
    }

}