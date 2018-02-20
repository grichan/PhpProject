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
                        <div class=\"row control_row \">
                            <div class=\"col \"></div>
                            <div id='greetingMessage' class=\"col text-center \" ><b>Welcome $username</b></div>
                            <div class=\"col\">
                                <div class='dropdown float-right '>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown'  aria-haspopup='true' aria-expanded='false'>
                                        $username
                                    </button> 
                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item' href='#'>A</a>
                                        <a class='dropdown-item' href='#'>B</a>
                                        <a class='dropdown-item' href='#'>C</a>
                                        <a class='dropdown-item' href='#'>Settings</a>
                                        <a class='dropdown-item' href='logout.php'>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                ";
    } else {
        echo "
                        <div class=\"row top_header\">
                            <div class=\"col\"></div>
                            <div class=\"col text-center\" style='color: #FFFFFF'><a href='login.php' >Please Login to edit</a></div>
                            <div class=\"col\"></div>
                        </div>                   
                ";
    }
?>
</div>