<?php

namespace App\Controllers;

use App\Components\Auth\Identity;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Song;
use T4\Core\Exception;
use T4\Core\Std;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {
        $this->data->lastNews = Article::findAll([
            'order' => '__id DESC',
            'limit'=> 3
        ]);

        $song = Song::findAll([
            'order' => 'rand()',
            'limit' => 1
        ]);
        if (!empty($song)) {
            $this->data->rndSong = $song[0];
        }

    }

    public function action404()
    {
    }

    public function action403()
    {
    }

    public function actionLogin($email=null, $password=null, $return='/')
    {
        $this->data->error = $this->app->flash->error;
        if (!empty($email) && !empty($password)) {
            try {
                $identity = new Identity();
                $identity->authenticate(new Std(['email'=>$email, 'password'=>$password]));
                $this->redirect($return);
            } catch (Exception $e) {
                $this->app->flash->error = $e->getMessage();
            }
        }
        $this->data->email  = $email;
        $this->data->return = $return;
    }

    public function actionLogout()
    {
        $identity = new Identity();
        $identity->logout();
        $this->redirect('/');
    }

    public function actionMenu($url = '/')
    {
        $this->data->items = Menu::findAllTree();
        $this->data->url = $url;
    }

}