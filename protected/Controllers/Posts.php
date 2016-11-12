<?php

namespace App\Controllers;

use App\Models\Post;
use T4\Mvc\Controller;

class Posts extends Controller
{
    public function actionDefault()
    {
        $this->data->posts = Post::findAll();
    }
}