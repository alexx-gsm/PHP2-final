<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478863229_createPosts
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('posts')) {
            $this->createTable('posts', [
                'title'     => ['type' => 'string'],
                'lead'      => ['type' => 'text'],
                'text'      => ['type' => 'text'],
                'image'     => ['type' => 'string'],
                'published' => ['type' => 'date'],
                '__user_id' => ['type' => 'link'],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('posts');
    }
    
}