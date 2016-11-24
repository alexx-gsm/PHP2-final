<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Uploader;
use App\Models\Album;
use App\Models\Song;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Albums
    extends Controller
{
    protected function access($action, $params = [])
    {
        return !empty($this->app->user) && $this->app->user->hasRole('admin');
    }

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Album::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        if ('new' == $id) {
            $item = new Album();
        } else {
            $item = Album::findByPK($id);
            if (empty($item)) {
                throw new E404Exception('Альбом не найден');
            }
        }
        $this->data->item = $item;
    }

    public function actionSave($album)
    {
        $item = empty($album->__id) ? new Album() : Album::findByPK($album->__id);
        $item->fill($album);

        $image = (new Uploader('image'))->setPathUpload(Album::IMAGE_PATH);
        if ($image->upload()) {
            $item->image = Album::PREFIX_IMAGE_NAME . $image->getFileName();
        }
        $item->save();

        $this->redirect('/admin/albums');
    }

    public function actionAddSong($song)
    {
        $album = Album::findByPK($song->album_id);
        $song = Song::findByPK($song->id);
        $album->songs->add($song);
        $album->save();
        $this->redirect('/admin/albums/edit/?id=' . $album->getPk());
    }

    public function actionDelSong($album_id, $song_id)
    {
        $album = Album::findByPK($album_id);
        $song_to_del = Song::findByPK($song_id);

        if (!empty($song_to_del)) {
            $album->songs = $album->songs->filter(function (Song $item) use ($song_to_del) {
                return $item->getPk() != $song_to_del->getPk();
            });
            $album->save();
        }

        $this->redirect('/admin/albums/edit/?id=' . $album_id);
    }

    public function actionDelete($id)
    {
        $item = Album::findByPK($id);
        if (!empty($item)) {
            $item->delete();
        }
        $this->redirect('/admin/albums');
    }
}