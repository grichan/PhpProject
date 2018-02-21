<?php

if(isset($_POST["username"], $_POST["password"]))
{
    session_start();
    include 'connection.php';
    if ( loginCheck( $_POST["username"], $_POST["password"] ) ){
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $_POST["username"];
        $url = "index.php";
        $message = "LOGED IN";
        echo json_encode(array($message, $url));
    } else {
        $_SESSION["logged_in"] = false;
        $url = "#";
        $message = "FALED TO LOGIN";
        echo json_encode(array($message, $url));
    }
}
?>