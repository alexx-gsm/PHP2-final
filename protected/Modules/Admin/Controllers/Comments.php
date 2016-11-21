<?php

namespace App\Modules\Admin\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use T4\Http\E404Exception;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Comments
    extends Controller
{
    protected function access($action, $params = [])
    {
        return !empty($this->app->user) && $this->app->user->hasRole('admin');
    }

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(Comment::class);
        $this->data->page = $page;
    }

    public function actionSave($comment)
    {
        $post = Post::findByPK($comment->post_id);
        if (!empty($post)) {
            $item = new Comment();
            $item->text = $comment->text;
            $item->published = date('Y-m-d');
            $item->post = $post;
            $item->user = User::findByPK(1);
            $item->save();
            $this->redirect('/posts/one/?id=' . $comment->post_id);
        }

        $this->redirect('/posts/');
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