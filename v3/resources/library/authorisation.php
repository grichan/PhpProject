<?php

    function passwordHash( $plaintxtPassword ){

        // just hash the password and return it
        $hashed_password = password_hash( $plaintxtPassword, PASSWORD_DEFAULT );
        return $hashed_password;
    }




?>