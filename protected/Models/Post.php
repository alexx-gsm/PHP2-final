<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class Post
 * @package App\Models
 *
 * @property string $title
 * @property string $lead
 * @property string $text
 * @property string $image
 * @property string $date
 *
 */
class Post extends Model
{
    protected static $schema = [
        'columns' => [
            'title'     => ['type' => 'string'],
            'lead'      => ['type' => 'text'],
            'text'      => ['type' => 'text'],
            'image'     => ['type' => 'string'],
            'published' => ['type' => 'date'],
        ],
        'relations' => [
            'user' => ['type' => self::BELONGS_TO, 'model' => User::class],
            'comments' => ['type' => self::HAS_MANY, 'model' => Comment::class],
        ],
    ];
}