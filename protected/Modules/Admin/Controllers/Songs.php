<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Uploader;
use App\Models\Author;
use App\Models\Song;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Songs
    extends Controller
{
    protected function access($action, $params = [])
    {
        return !empty($this->app->user) && $this->app->user->hasRole('admin');
    }

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Song::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        if ('new' == $id) {
            $item = new Song();
        } else {
            $item = Song::findByPK($id);
            if (empty($item)) {
                throw new E404Exception('Композиция не найдена');
            }
        }
        $this->data->item = $item;
        $this->data->authors = Author::findAll();
    }

    public function actionSave($song)
    {
        $item = empty($song->__id) ? new Song() : Song::findByPK($song->__id);
        $item->fill($song);


        $file = (new Uploader('song'))->setPathUpload(Song::IMAGE_PATH);
        if ($file->upload()) {
            $item->link = Song::PREFIX_IMAGE_NAME . $file->getFileName();
        }

        $item->save();

        $this->redirect('/admin/songs');
    }

    public function actionDelete($id)
    {
        $item = Song::findByPK($id);
        if (!empty($item)) {
            $item->delete();
        }
        $this->redirect('/admin/songs');
    }
}