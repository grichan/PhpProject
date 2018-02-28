<?php
include '../config.php';
require_once ("../classes/Worker.php");
require_once ("connection.php");

if(isset($_POST['Id'])) {
    $worker = new Worker();
    $worker->id = $_POST['Id'];
    $worker->firstName = $_POST['FirstName'];
    $worker->lastName = $_POST['LastName'];
    $worker->department = $_POST['dropdown'];
    $worker->title = $_POST['Title'];
    echo $result = dbUpdateWorker( $worker );
    header("location:../../public_html/index.php"); /* Redirect browser */
    exit();
}
?>



