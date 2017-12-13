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

?>