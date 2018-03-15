<?php

    if(isset($_POST['Delete'])) {
        include 'connection.php';
        $id = $_POST['Delete'];
        if (dbDeleteWorker($id)){
            header("Location: ../../public_html/index.php"); /* Redirect browser */
        } else {
            echo "an error occured" . "<style> body{ background-color:red; } </style>";
            header("refresh:5;url=../../public_html/index.php");
        }
        exit();
    } else {
        echo "
            <h1>ERROR</h1>
            <style> body{ background-color:red; } </style>
        ";
    }

?>