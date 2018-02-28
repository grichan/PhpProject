<?php

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

function dbGetDepartments() {
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

function dbAddWorker($fname, $lname, $depart, $title) {
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

function dbUpdateWorker($worker ) {

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

function dbGetWorker($id ) {

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

function dbDeleteWorker($id ){
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

function dbCountSearchRows($table, $search ) {

    $conn = OpenCon();
    $search = mysqli_real_escape_string($conn, $search);
    $sql = $conn->prepare(" 
    SELECT
      *
    FROM
      $table
    WHERE
      FirstName LIKE '%".$search."%' OR 
      LastName LIKE '%".$search."%' OR 
      Title LIKE '%".$search."%' OR 
      Id LIKE '%".$search."%'
    ");
    $sql->execute();
    $result = $sql->get_result();
    $totalRows = $result->num_rows;
    CloseCon($conn);
    // total of rows
    return $totalRows;
}

function dbSearchWorkers($searchString, $offset, $limit ) {
    $conn = OpenCon();
    $search = mysqli_real_escape_string($conn, $searchString);
    $sql = $conn->prepare("
    SELECT
      Id,
      FirstName,
      LastName,
      DepartmentId,
      Title
    FROM
      workers
    WHERE
      FirstName LIKE '%" . $searchString .  "%'OR 
      LastName LIKE '%" . $searchString ."%'OR 
      Title LIKE '%" . $searchString ."%'OR 
      Id LIKE '%" . $searchString ."%'
    LIMIT
      $limit
    OFFSET 
      $offset  
      ");


    $sql->execute();
    $result = $sql->get_result();
    $workersArray = array();
    $i = 0;
    foreach ( $result as $row ){
        $worker = new Worker;
        $worker->id = $row['Id'];
        $worker->firstName = $row['FirstName'];
        $worker->lastName = $row['LastName'];
        $worker->department = $row['Title'];
        $worker->title = $row['DepartmentId'];
        array_push($workersArray, $worker);
    }
    CloseCon($conn);

    return $workersArray;
}

function dbLoginCheck( $username, $password ){

    $conn = OpenCon();
    $sql = $conn->prepare( "SELECT username, hash FROM users WHERE username = '$username'");
    $sql->execute();
    $result = $sql->get_result();
    $row_count = $result->num_rows;
    $result = $result->fetch_assoc();
    CloseCon($conn);
    if ( $row_count > 0 ){
        if (password_verify( $password, $result['hash'] )) {
            return true; 
        }
    } else {
        return false;
    }
}

function dbRegistration($username , $plain_txt_password ) {
    require_once "../library/authorisation.php";
    $conn = OpenCon();
    $username = mysqli_real_escape_string($conn, $username);
    $plain_txt_password = mysqli_real_escape_string($conn, $plain_txt_password);
    $plain_txt_password = passwordHash( $plain_txt_password );

    $sql = $conn->prepare( "
    INSERT INTO users ( username, hash) VALUES ( ?, ?);
    " );
    $sql->bind_param("ss", $username, $plain_txt_password );
    $sql->execute();
    CloseCon($conn);
    
}
?>