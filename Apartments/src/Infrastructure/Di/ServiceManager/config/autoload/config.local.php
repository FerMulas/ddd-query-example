<?php

return [
    'db' => [
        'username'       => 'root',
        'password'       => 'demo',
        'hostname'       => 'mysqlserver',
        'database'       => 'demo',
        'charset'        => 'UTF8',
        'driver'         => 'PDO_Mysql',
        'driver_options' => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    ]
];
