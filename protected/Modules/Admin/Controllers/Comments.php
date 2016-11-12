<?php

namespace App\Modules\Admin\Controllers;

use App\Models\Comment;
use App\Models\User;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Comments
    extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Comment::class);
        $this->data->page = $page;
    }

    public function actionEdit($id)
    {
        $item = Comment::findByPK($id);
        if (empty($item)) {
            throw new E404Exception('Комментарий не найден');
        }
        $this->data->item = $item;
        $this->data->users = User::findAll();
    }

    public function actionSave($comment)
    {
        $item = Comment::findByPK($comment->__id);

        if (!empty($item)) {
            $item->fill($comment)->save();
        }

        $this->redirect('/admin/comments');
    }

    public function actionDelete($id)
    {
        $item = Comment::findByPK($id);

        if (!empty($item)) {
            $item->delete();
        }

        $this->redirect('/admin/comments');
    }
}