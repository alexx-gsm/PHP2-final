<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_0000000001_initApp
    extends Migration
{

    public function up()
    {
        if (!$this->existsTable('__users')) {
            $this->createTable('__users', [
                'name'       => ['type' => 'string'],
                'email'      => ['type' => 'string'],
                'password'  => ['type'=>'string'],
                'birthday'   => ['type' => 'date'],
                'registered' => ['type' => 'date'],
                '__role_id' => ['type'=>'link'],
            ], [
                ['columns' => ['email']],
            ]);

            $this->createTable('roles', [
                'name' => ['type'=>'string'],
                'title' => ['type'=>'string'],
            ], [
                ['columns' => ['name']]
            ]);

            $adminRoleId = $this->insert('roles', [
                'name'  => 'admin',
                'title' => 'Администратор'
            ]);

            $this->insert('__users', [
                'email'     => 'alexx-gsm@yandex.ru',
                'password'  => '$2y$10$C.y7Li3jIQIoycYuPKvExuB7/C.mALI8JureDx9rEUb3pEYmJa0ee',
                '__role_id' => $adminRoleId,
            ]);

            $this->createTable('__user_sessions', [
                'hash'          => ['type'=>'string'],
                '__user_id'     => ['type'=>'link'],
            ], [
                'hash'  => ['columns'=>['hash']],
                'user'  => ['columns'=>['__user_id']],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('__user_sessions');
        $this->dropTable('roles');
        $this->dropTable('__users');
    }
    
}