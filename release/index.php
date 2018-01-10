<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">


    <title>Table with workers</title>
</head>


    <body>
    <?php
    session_start();
    if ( $_SESSION["logged_in"] == true){
        echo ( "LOGGED IN AS: ");
        echo ($_SESSION["naam"]);

    } else {
        echo (" <a href='landing.php'>LOGIN TO EDDIT</a> ");
    }

    include 'db_connnection.php';
    ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>




            <?php
            include 'separateSearch.php';
            //include 'phpajax 2.php';?>
    <h1></h1>
    </body>
<script>
    var dialog = $(h1).dialog('open');
    setTimeout(function() { dialog.dialog('close'); }, time);
    localStorage.setItem('SearchType', 0);

</script>
</html>