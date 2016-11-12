<?php

namespace App\Models;

use T4\Orm\Model;

class User extends Model
{
    protected static $schema = [
        'columns' => [
            'name'       => ['type' => 'string'],
            'email'      => ['type' => 'string'],
            'birthday'   => ['type' => 'date'],
            'registered' => ['type' => 'date'],
        ],
        'relations' => [
            'posts'     => ['type' => self::HAS_MANY, 'model' => Post::class],
            'comments'  => ['type' => self::HAS_MANY, 'model' => Comment::class],
        ],
    ];
}