<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Uploader;
use App\Models\Post;
use App\Models\User;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Posts
    extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Post::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        if ('new' == $id) {
            $item = new Post();
            $item->published = date('Y-m-d');
        } else {
            $item = Post::findByPK($id);
            if (empty($item)) {
                throw new E404Exception('Статья не найдена');
            }
        }
        $this->data->item = $item;
        $this->data->users = User::findAll();
    }

    public function actionSave($post)
    {
        $item = empty($post->__id) ? new Post() : Post::findByPK($post->__id);
        $item->fill($post);

        $image = (new Uploader('file'))->setPathUpload(ROOT_PATH_PROTECTED . '/Layouts/assets/images/posts/');
        if ($image->upload()) {
            $item->image = $image->getFileName();
        }
        $item->save();

        $this->redirect('/admin/posts');
    }

    public function actionDelete($id)
    {
        $item = Post::findByPK($id);
        if (!empty($item)) {
            $item->delete();
        }
        $this->redirect('/admin/posts');
    }
}