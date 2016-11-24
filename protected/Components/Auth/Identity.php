<?php

namespace App\Components\Auth;

use App\Models\User;
use T4\Mvc\Application;
use T4\Core\Session;
use T4\Auth\Exception;

class Identity
    extends \T4\Auth\Identity
{
    const ERROR_INVALID_CAPTCHA = 102;
    const ERROR_INVALID_CODE = 103;
    const ERROR_INVALID_TIME = 104;
    const ERROR_INVALID_FIRSTNAME = 105;
    const ERROR_INVALID_LASTNAME = 106;
    const AUTH_COOKIE_NAME = 'T4auth';

    public function checkPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function check($data)
    {
        $user = User::findByEmail($data->email);
        if (empty($user)) {
            throw new Exception('User with email ' . $data->email . ' does not exists', self::ERROR_INVALID_EMAIL);
        }
        if (!Helpers::checkPassword($data->password, $user->password)) {
            throw new Exception('Invalid password', self::ERROR_INVALID_PASSWORD);
        }
        return true;
    }

    public function authenticate($data)
    {
        $errors = new MultiException();

        if (empty($data->email)) {
            $errors->add(new Exception('Не введен e-mail', self::ERROR_INVALID_EMAIL));
        }
        if (empty($data->password)) {
            $errors->add(new Exception('Не введен пароль', self::ERROR_INVALID_PASSWORD));
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        /** @var \App\Models\User $user */
        $user = User::findByEmail($data->email);
        if (empty($user)) {
            $errors->add(new Exception('Пользователь с e-mail ' . $data->email . ' не существует', self::ERROR_INVALID_EMAIL));
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        if (!$this->checkPassword($data->password, $user->password)) {
            $errors->add(new Exception('Неверный пароль', self::ERROR_INVALID_PASSWORD));
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        $this->login($user);
        $user->lastvisit = date('Y-m-d H:i:s');
        $user->save();

        Application::instance()->user = $user;

        return $user;
    }

    public function getUser()
    {
        return Session::get('__user');
    }

    public function login($user)
    {
        Session::set('__user', $user);
    }

    public function logout()
    {
        Session::clear('__user');
    }

}