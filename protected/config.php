<?php

return [
    'db' => [
        'default' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'dbname' => 'php2_final_db',
            'user' => 'root',
            'password' => '25L10i1979'
        ],
    ],
    'extensions' => [
        'jstree' => [
            'autoload' => false,
        ],
        'ckeditor' => [
            'location' => 'local',
        ],
    ],
    'errors' => [
        403 => '///403',
        404 => '///404',
    ],
];