<?php

// constants to connect to DB, passed to Db class
$ini = parse_ini_file('configs/db.ini');

    define('HOST', $ini['host']); //server
    define('USER', $ini['username']); //user
    define('PASSWORD', $ini['password']); //pass
    define('DBNAME', $ini['dbname']);//DB name


// not yet reworked for OOP
$config = parse_ini_file('configs/db.ini');
if(is_array($config)){
    $link = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
    
    if(mysqli_connect_errno()){
        echo 'connection failed' . mysqli_connect_error();
        exit();
    }
    
}