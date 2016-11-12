<?php

namespace App\Models;

use T4\Orm\Model;

class Article extends Model
{
    protected static $schema = [
        'table'   => 'news',
        'columns' => [
            'title'     => ['type' => 'string'],
            'text'      => ['type' => 'text'],
            'image'     => ['type' => 'string'],
            'published' => ['type' => 'date'],
        ]
    ];

    const IMAGE_PATH = ROOT_PATH_PROTECTED . '/Layouts/assets/images/news/';
    const PREFIX_IMAGE_NAME = '/images/news/';

}