<?php

namespace App\Controllers;

use App\Models\Menu;
use App\Models\Post;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Posts extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Post::class, ['order' => 'published DESC']);
        $this->data->page = $page;
    }

    public function actionOne($id = null)
    {
        if (null === $id) {
            throw new E404Exception();
        }
        $this->data->post = Post::findByPK($id);
    }

    public function actionMenu($url = '/')
    {
        $this->data->items = Menu::findAllTree();
        $this->data->url = $url;
    }
}