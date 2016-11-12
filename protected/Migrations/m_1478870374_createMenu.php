<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478870374_createMenu
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('menu')) {
            $this->createTable('menu', [
                'title'     => ['type' => 'string'],
                'link'      => ['type' => 'string'],
                'isVisible' => ['type' => 'boolean', 'default' => 1],
                'order'     => ['type' => 'int'],
            ], [
                ['type' => 'unique', 'columns' => ['order']]
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('menu');
    }
    
}