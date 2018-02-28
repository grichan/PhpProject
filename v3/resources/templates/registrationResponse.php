<?php

    if ( $_POST["password"] == $_POST["password_confirmation"] ) {
        
        include_once "../templates/connection.php";
        try {
            $username =(string) $_POST["username"];
            $password =(string) $_POST["password"];
            dbRegistration($username, $password);
            echo "Registered Successfully";
        } catch( Exception $e ) {
            echo "An ERROR ocured";
        }     
    } else echo "passwords do not match";
        
?>