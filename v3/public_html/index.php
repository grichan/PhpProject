<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <title>Table with workers</title>
</head>


<?php
require_once("../resources/config.php");
?>

<body>
<?php
require_once( "../" . TEMPLATES_PATH . "/header.php");
?>
<?php
require_once ("../". TEMPLATES_PATH . '/connection.php');
?>
    <?php
        require_once("search.php");
    ;?>
<?php
    require_once( "../" . TEMPLATES_PATH . "/footer.php");
?>
</body>

<script>
    var dialog = $(h1).dialog('open');
    setTimeout(function() { dialog.dialog('close'); }, time);
    localStorage.setItem('SearchType', 0);
</script>
<style>

    .dropdown-toggle {
        margin: 3px;
    }
    .control_row {
        background: linear-gradient(to right, rgba(1, 32, 60, 0.8), #057487);
    }
    .dropdown-menu {
        background-color: #efefef;
        border: solid;
        border-color: #057487;
        border-width: 2px;
        padding: 3px;
        margin-right: 7px;
        margin-top: 5px;
    }
    .dropdown-menu > li:hover {
        background-color: #FFF;
         color: #057487;
    }
    col {
        padding-left: 0!important;
        padding-right: 0!important;
    }

    #response {
        width: 100%;
    }

    #body {
        padding:10px;
        padding-bottom:60px;	/* Height of the footer */
    }
</style>
</html>
