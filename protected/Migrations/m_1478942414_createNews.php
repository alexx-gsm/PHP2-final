<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478942414_createNews
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('news')) {
            $this->createTable('news', [
                'title'     => ['type' => 'string'],
                'text'      => ['type' => 'text'],
                'image'     => ['type' => 'string'],
                'published' => ['type' => 'date'],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('news');
    }
    
}