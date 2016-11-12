<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478951785_createAlbums
    extends Migration
{
    public function up()
    {
        if (!$this->existsTable('albums')) {
            $this->createTable('albums', [
                'title'       => ['type' => 'string'],
                'published'   => ['type' => 'date'],
                'image'       => ['type' => 'string'],
            ]);
        }

        if (!$this->existsTable('albums_to_songs')) {
            $this->createTable('albums_to_songs', [
                '__album_id' => ['type' => 'link'],
                '__song_id' => ['type' => 'link'],
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('albums_to_songs');
        $this->dropTable('albums');
    }
    
}