<?php

namespace App\Models;

use T4\Orm\Model;

class User extends Model
{
    protected static $schema = [
        'table' => '__users',
        'columns' => [
            'name'       => ['type' => 'string'],
            'email'      => ['type' => 'string'],
            'password'  => ['type'=>'string'],
            'birthday'   => ['type' => 'date'],
            'registered' => ['type' => 'date'],
        ],
        'relations' => [
            'posts'     => ['type' => self::HAS_MANY, 'model' => Post::class],
            'comments'  => ['type' => self::HAS_MANY, 'model' => Comment::class],
            'role'      => ['type'=>self::BELONGS_TO, 'model'=>Role::class]
        ],
    ];

    public function hasRole($role)
    {
        return !empty($this->role) && ( ($role == $this->role->name) || ($role == $this->role->title) );
    }
}