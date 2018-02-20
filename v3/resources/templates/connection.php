<?php
function Cnect()
{

    try {
        $conn = mysqli_connect("127.0.0.1", "root", "", "workersDb");
        return $conn;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}
function CloseCon($conn)
{
    $conn -> close();
}
function OpenCon()
{
    include('C:\xampp\htdocs\personale\v3\resources\config.php');
    $conn = mysqli_connect( $config["db"]["db1"]['host'], $config["db"]["db1"]['username'], $config["db"]["db1"]['password'], $config["db"]["db1"]['dbname']);
    return $conn;
}
/*
function InsertUsers(  $worker ) {
    $worker;
    $conn = OpenCon();
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $department = mysqli_real_escape_string($conn, $department);
    $title = mysqli_real_escape_string($conn, $title);



    $stmt = $conn->prepare('
                    INSERT INTO workers ( FirstName, LastName,  DepartmentId , Title )
                    VALUES (  ?, ?, ?, ?);
                    ');
    $stmt->bind_param("ssss", $firstName, $lastName,  $department , $title);
    $stmt->execute();
    return
    CloseCon($conn);
}
*/
?>