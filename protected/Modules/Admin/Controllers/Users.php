<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Auth\Identity;
use App\Models\Role;
use App\Models\User;

use T4\Crypt\Helpers;
use T4\Mvc\Controller;
use T4\Orm\ModelDataProvider;

class Users
    extends Controller
{
    protected function access($action, $params = [])
    {
        return !empty($this->app->user) && $this->app->user->hasRole('admin');
    }

    public function actionDefault($page = 1)
    {
        $this->data->provider = new ModelDataProvider(User::class);
        $this->data->page = $page;
    }

    public function actionEdit($id = null)
    {
        if (null === $id || 'new' == $id) {
            $this->data->item = new User();
        } else {
            $this->data->item = User::findByPK($id);
        }
        $this->data->roles = Role::findAll();
    }

    public function actionSave($user)
    {
        $item = !empty($user->__id) ? User::findByPK($user->__id) :  new User();
        $item->fill($user);

        $role = !empty($user->role_id) ? Role::findByPK($user->role_id) : Role::findByTitle('Пользователь');
        $item->role = $role;

        if ($item->isNew()) {
            $item->registered = date('Y-m-d');
            $item->password = password_hash($item->password, PASSWORD_DEFAULT);
        }

        $item->save();
        $this->redirect('/admin/users');
    }

    public function actionDelete($id)
    {
        $item = User::findByPK($id);
        if (empty($item)) {
            $this->redirect('/admin/users');
        }
        $item->delete();
        $this->redirect('/admin/users');
    }

    public function actionLogin($id)
    {
        $user = User::findByPK($id);
        if (empty($user)) {
            $this->redirect('/admin/users/');
        }

        $auth = new Identity();
        $auth->logout();
        $auth->login($user);
        $this->redirect('/');
    }
}