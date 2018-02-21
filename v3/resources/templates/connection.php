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

function getDepartments() {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT * FROM Departments");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    while ( $row = $result->fetch_row()){
        $data[] = $row;
    }
    CloseCon($conn);
    return $data;
}

function addWorker( $fname, $lname, $depart, $title) {
    $conn = OpenCon();
    $fname = mysqli_real_escape_string($conn,  $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $depart = mysqli_real_escape_string($conn,  $depart);
    $title = mysqli_real_escape_string($conn,  $title);

    $stmt = $conn->prepare('
                    INSERT INTO workers ( FirstName, LastName,  DepartmentId , Title )
                    VALUES (  ?, ?, ?, ?);
                    ');
    $stmt->bind_param("ssss", $fname, $lname,  $depart , $title);
    $stmt->execute();
    CloseCon($conn);
    try {
        return "Success";
    } catch ( mysqli_sql_exception $e ){
        return "Error occurred: $e";
    }
}

function updateWorker( $worker ) {

    try {
        $conn = OpenCon();
        $worker->id = mysqli_real_escape_string($conn, $worker->id);
        $worker->firstName = mysqli_real_escape_string($conn, $worker->firstName);
        $worker->lastName = mysqli_real_escape_string($conn, $worker->lastName);
        $worker->department = mysqli_real_escape_string($conn, $worker->department);
        $worker->title = mysqli_real_escape_string($conn, $worker->title);

        $stmt = $conn->prepare('
        UPDATE workers AS W
        SET W.FirstName =? , W.LastName =?, W.Title =?, W.DepartmentId =?
        WHERE  W.Id =?    
        ');
        $stmt->bind_param("sssis", $worker->firstName,$worker->lastName,$worker->title,$worker->department,$worker->id);
        $stmt->execute();
        return "Success";
    } catch (Exception $e) {
        return "Error: " . $e;
    }

}

function getWorker( $id ) {

    $conn = OpenCon();
    $id = mysqli_real_escape_string($conn, $id);
    $stmt = $conn->prepare('SELECT * FROM workers WHERE Id = ?');
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $worker = new Worker;

    while ($row = $result->fetch_assoc()) {
        $worker->firstName = $row['FirstName'];
        $worker->lastName = $row['LastName'];
        $worker->title = $row['Title'];
        $worker->department = $row['DepartmentId'];
    }
    CloseCon($conn);
    return $worker;
}

function deleteWorker( $id ){
    try {
        $conn = OpenCon();
        $id = mysqli_real_escape_string($conn, $id);

        $stmt = $conn->prepare('DELETE FROM  	workers WHERE Id = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        CloseCon($conn);
        return true;

    } catch (Exception $e){
        CloseCon($conn);
        return false;
    }
}

function loginCheck( $username, $password){

    $conn = OpenCon();
    $sql = $conn->prepare( "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'");
    $sql->execute();
    $result = $sql->get_result();
    $row_count = $result->num_rows;
    CloseCon($conn);
    if ( $row_count > 0 ){
        return true;
    } else {
        return false;
    }
}

?>