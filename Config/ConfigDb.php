<?php
class ConfigDb
{
    // 数据库实例1
    public static $user = array(
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'user'    => 'root',
        'password' => '',
        'dbname'  => 'rabbit',
        'charset'    => 'utf8',
    );

    // 数据库实例2
    public static $db2 = array(
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'user'    => 'mysql_user',
        'password' => 'mysql_password',
        'dbname'  => 'db2',
        'charset'    => 'utf8',
    );
}