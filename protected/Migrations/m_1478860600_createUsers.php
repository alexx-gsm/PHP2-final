<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1478860600_createUsers
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('users')) {
            $this->createTable('users', [
                'name'       => ['type' => 'string'],
                'email'      => ['type' => 'string'],
                'birthday'   => ['type' => 'date'],
                'registered' => ['type' => 'date'],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('users');
    }
    
}