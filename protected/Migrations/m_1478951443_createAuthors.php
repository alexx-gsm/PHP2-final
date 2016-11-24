<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478951443_createAuthors
    extends Migration
{
    public function up()
    {
        if (!$this->existsTable('authors')) {
            $this->createTable('authors', [
                'name'       => ['type' => 'string'],
                'birthday'   => ['type' => 'date'],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('authors');
    }
    
}