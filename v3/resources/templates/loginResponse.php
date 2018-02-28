<?php

if(isset($_POST["username"], $_POST["password"]))
{
    session_start();
    include "../library/authorisation.php";
    include_once "../templates/connection.php";


    if ( dbLoginCheck( $_POST["username"], $_POST["password"] ) ){
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $_POST["username"];
        $url = "index.php";
        echo json_encode(array( "true", $url));

    } else {
        $_SESSION["logged_in"] = false;
        $url = "#";

        echo json_encode(array( "false", $url));
    }
}
?>