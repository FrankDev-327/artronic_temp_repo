<?php
    define('HOST', '172.19.0.2');
    define('DATABASE', 'users_test');
    define('USERNAME', 'root');
    define('PASSWORD', 'root');
    define('TABLE_NAME', 'users');
    define('PORT', 3306);
    define('PDO_OPTION', array(
        PDO::MYSQL_ATTR_INIT_COMMAND 	=> 'SET NAMES utf8',
        PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_FOUND_ROWS 		=> true,
        PDO::ATTR_PERSISTENT 			=> true
    ));
?>