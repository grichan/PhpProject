<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/popper.min.js"></script>
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
    $(" #searchform button").click(onSearchSumbitClick);
    $("#searchform  button").trigger('click');
    function onDocumentReady(){
        $(" #page_btns li").click(onPageButtonClicked);
    }
    localStorage.setItem('SearchType', 0);
</script>
<style>

</style>
</html>
