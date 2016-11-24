<?php

namespace App\Controllers;

use T4\Mvc\Controller;

class User extends Controller
{
    public function actionDefault()
    {
        $this->data->users = \App\Models\User::findAll();
    }
}