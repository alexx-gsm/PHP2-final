<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478951769_createSongs
    extends Migration
{
    public function up()
    {
        if (!$this->existsTable('songs')) {
            $this->createTable('songs', [
                'title'       => ['type' => 'string'],
                'duration'    => ['type' => 'time'],
                'link'        => ['type' => 'string'],
                '__author_id' => ['type' => 'link']
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('songs');
    }
    
}