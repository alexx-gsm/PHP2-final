<?php

namespace App\Models;

use T4\Orm\Model;

class Author extends Model
{
    protected static $schema = [
        'columns' => [
            'name'       => ['type' => 'string'],
            'birthday'   => ['type' => 'date'],
        ],
        'relations' => [
            'songs'     => ['type' => self::HAS_MANY, 'model' => Song::class],
        ],
    ];

    protected function sanitizeBirthday($val)
    {
        $date = date('Y-m-d', strtotime($val));
        return $date;
    }
}