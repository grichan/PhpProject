<?php

$config = array(
    "db" => array(
        "db1" => array(
            "dbname" => 'workersdb',
            "username" => 'root',
            "password" => '',
            "host" => '127.0.0.1'
        ),
        "db2" => array(
            "dbname" => "database2",
            "username" => "dbUser",
            "password" => "pa$$",
            "host" => "localhost"
        )
    ),

    "paths" => array(
        "resources" => "/resources",
        "images" => array(
            "content" =>  "images/content", // $_SERVER["DOCUMENT_ROOT"] .
            "layout" => "images/layout" //  $_SERVER["DOCUMENT_ROOT"] .
            )
        )
    );
    defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", 'resources/library' ); //  Пълния път и име на файла.  __FILE__ вълшебна константа!

    defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", 'resources/templates' ); // realpath(dirname(__FILE__) . '/templates'));



// $database = include('config.php');
// echo $database['host']; // 'localhost'

?>
