<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Uploader;
use App\Models\Article;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class News extends Controller
{
    protected function access($action, $params = [])
    {
        return !empty($this->app->user) && $this->app->user->hasRole('admin');
    }

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Article::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        if ('new' == $id) {
            $item = new Article();
            $item->published = date('m.d.Y');
        } else {
            $item = Article::findByPK($id);
            if (empty($item)) {
                throw new E404Exception('Новость не найдена');
            }
        }
        $this->data->item = $item;
    }

    public function actionSave($article)
    {
        $item = empty($article->__id) ? new Article() : Article::findByPK($article->__id);
        if (null === $item->published) {
            $item->published = date('Y-m-d');
        }
        $item->fill($article);

        $image = (new Uploader('image'))->setPathUpload(Article::IMAGE_PATH);
        if ($image->upload()) {
            $item->image = Article::PREFIX_IMAGE_NAME . $image->getFileName();
        }
        $item->save();

        $this->redirect('/admin/news');
    }

    public function actionDelete($id)
    {
        $item = Article::findByPK($id);
        if (!empty($item)) {
            $item->delete();
        }
        $this->redirect('/admin/news');
    }
}