<?php

namespace App\Models;

use T4\Dbal\QueryBuilder;
use T4\Orm\Model;

class Album extends Model
{
    protected static $schema = [
        'columns' => [
            'title'       => ['type' => 'string'],
            'published'   => ['type' => 'date'],
            'image'       => ['type' => 'string'],
        ],
        'relations' => [
            'songs'      => ['type' => self::MANY_TO_MANY, 'model' => Song::class],
        ],
    ];

    const IMAGE_PATH = ROOT_PATH_PROTECTED . '/Layouts/assets/images/albums/';
    const PREFIX_IMAGE_NAME = '/images/albums/';

    protected function sanitizePublished($val)
    {
        $date = date('Y-m-d', strtotime($val));
        return $date;
    }

    public function getRestSongs()
    {
        $query = (new QueryBuilder())
            ->select('*')
            ->from(Song::getTableName())
            ->where('`__id` NOT IN (SELECT DISTINCT albums_to_songs.`__song_id` FROM albums_to_songs WHERE albums_to_songs.`__album_id` = :album_id)')
            ->params([':album_id' => $this->getPk()]);

       return Song::findAllByQuery($query);
    }

}