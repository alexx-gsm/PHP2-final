<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478863583_createComments
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('comments')) {
            $this->createTable('comments', [
                'text'      => ['type' => 'text'],
                'published' => ['type' => 'date'],
                '__user_id' => ['type' => 'link'],
                '__post_id' => ['type' => 'link'],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('comments');
    }
    
}