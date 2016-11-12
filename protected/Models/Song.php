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
class Song extends Model
{
    protected static $schema = [
        'columns' => [
            'title'       => ['type' => 'string'],
            'duration'    => ['type' => 'time'],
        ],
        'relations' => [
            'author' => ['type' => self::BELONGS_TO, 'model' => Author::class],
            'albums' => ['type' => self::MANY_TO_MANY, 'model' => Album::class],
        ],
    ];

    protected function sanitizeDuration($val)
    {
        return str_replace(' ', '', $val);
    }
}