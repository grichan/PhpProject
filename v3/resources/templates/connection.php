<?php




function OpenCon()
{
    $conn = mysqli_connect("127.0.0.1", "root", "", "workersDb");
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}

function NewConn()
{
    $config = include('../config.php');
    $conn = mysqli_connect( $config['host'], $config['username'], $config['password'], $config['dbname']);
    return $conn;
}

?>