<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="css/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="css/popper.min.js"></script>

    <title>Table with workers</title>
</head>

<?php
require_once("../resources/config.php");
?>

<body>
<?php
require_once( "../" . TEMPLATES_PATH . "/header.php");
require_once("../". TEMPLATES_PATH . '/connection.php');
require_once("search.php");
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
