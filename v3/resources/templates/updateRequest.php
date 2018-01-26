<?php
include '../config.php';
require_once ("connection.php");

    if(isset($_POST['Id'])) {
        $id = $_POST['Id'];
        $fname = $_POST['FirstName'];
        $lname = $_POST['LastName'];
        $depart = $_POST['dropdown'];
        $title = $_POST['Title'];

        $conn = OpenCon();
        $name = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $fname);
        $name = mysqli_real_escape_string($conn, $lname);
        $name = mysqli_real_escape_string($conn, $depart);


        $stmt = $conn->prepare('
            UPDATE workers AS W

            SET W.FirstName =? , W.LastName =?, W.Title =?, W.DepartmentId =?
            WHERE  W.Id =?
                    
        ');
        $stmt->bind_param("sssis", $fname,$lname,$title,$depart,$id);
        $stmt->execute();

        header("location:javascript://history.go(-1)"); /* Redirect browser */
        exit();
    }
?>



