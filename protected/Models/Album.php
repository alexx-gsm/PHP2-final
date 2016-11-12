<?php

namespace App\Models;

use T4\Orm\Model;

class Album extends Model
{
    protected static $schema = [
        'columns' => [
            'name'       => ['type' => 'string'],
            'birthday'   => ['type' => 'date'],
        ],
        'relations' => [
            'songs'      => ['type' => self::MANY_TO_MANY, 'model' => Song::class],
        ],
    ];
}