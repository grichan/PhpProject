<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title> </title>
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
                            <div id='greetingMessage' class=\"col text-center \" >Logged in as: $username</div>
                            <div class=\"col\">
                                <div class='dropdown float-right '>
                                    <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown'  aria-haspopup='true' aria-expanded='false'>
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
                            <div class=\"col text-center\" ><a href='login.php' style='color: #c82333;' >Please Login to edit</a></div>
                            <div class=\"col\"></div>
                        </div>                   
                ";
    }
?>

</div>
<div class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>