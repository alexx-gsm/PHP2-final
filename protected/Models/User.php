<?php

namespace App\Models;

use T4\Core\Collection;
use T4\Core\Std;
use T4\Orm\Model;

class User extends Model
{
    protected static $schema = [
        'table' => '__users',
        'columns' => [
            'name'       => ['type' => 'string'],
            'email'      => ['type' => 'string'],
            'password'  => ['type'=>'string'],
            'birthday'   => ['type' => 'date'],
            'registered' => ['type' => 'date'],
        ],
        'relations' => [
            'posts'     => ['type' => self::HAS_MANY, 'model' => Post::class],
            'comments'  => ['type' => self::HAS_MANY, 'model' => Comment::class],
            'role'=>['type'=>self::BELONGS_TO, 'model'=>Role::class]
        ],
    ];

    public function hasRole($role)
    {
        return !empty($this->role) && ( ($role == $this->role->name) || ($role == $this->role->title) );
    }
    public function fillRoles(Std $data)
    {
        $i = new Collection();
        $roles = array_unique($data->toArray());
        foreach ($roles as $id) {
            $role = Role::findByPK($id);
            if (!empty($role)) {
                $i[] = $role;
            }
        }
        $this->setRoles($i);
        return $this;
    }
}