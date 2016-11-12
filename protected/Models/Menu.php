<?php

namespace App\Models;

use T4\Orm\Model;

class Menu extends Model
{
    protected static $schema = [
        'table'   => 'menu',
        'columns' => [
            'name'       => ['type' => 'string'],
            'email'      => ['type' => 'string'],
            'birthday'   => ['type' => 'date'],
            'registered' => ['type' => 'date'],
        ]
    ];
}