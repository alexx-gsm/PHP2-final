<?php

namespace App\Modules\Admin\Controllers;

use App\Models\User;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Users
    extends Controller
{
    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(User::class);
        $this->data->page = $page;
    }
}