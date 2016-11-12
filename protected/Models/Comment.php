<?php

namespace App\Models;

use T4\Orm\Model;

class Comment extends Model
{
    protected static $schema = [
        'columns' => [
            'text'      => ['type' => 'text'],
            'published' => ['type' => 'date'],
        ],
        'relations' => [
            'user' => ['type' => self::BELONGS_TO, 'model' => User::class],
            'post' => ['type' => self::BELONGS_TO, 'model' => Post::class],
        ],
    ];

}