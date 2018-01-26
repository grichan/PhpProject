<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Simple Site</title>
</head>

<body>
<div id="header">

<?php
    $username = "Please Login";
    session_start();
if(isset($_SESSION['name']) && !empty($_SESSION['name'])) {
        $username = $_SESSION["name"];
        echo "
                                    
                        <div class=\"row control_row\">
                            <div class=\"col\"></div>
                            <div class=\"col text-center\" style='color: #FFFFFF'>Welcome $username</div>
                            <div class=\"col\"></div>
                        </div>                   
                ";
    } else {
        echo "
                                    
                        <div class=\"row control_row\">
                            <div class=\"col\"></div>
                            <div class=\"col text-center\" style='color: #FFFFFF'>Please Login to eddit</div>
                            <div class=\"col\"></div>
                        </div>                   
                ";
    }
?>
</div>