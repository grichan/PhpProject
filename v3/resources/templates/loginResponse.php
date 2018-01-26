<?php

if(isset($_POST["username"], $_POST["password"]))
{
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
  //  include('connection.php');
  //  $conn = NewConn();
    $conn = mysqli_connect("127.0.0.1", "root", "", "workersDb");

    $sql = $conn->prepare("SELECT username, password FROM users WHERE username = '".$username."' AND  password = '".$password."'");
    $sql->execute();
    $result = $sql->get_result();
    $row_cnt = $result->num_rows;

    if($row_cnt > 0 )
    {
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $username;
        $url = "index.php";
        $message = "LOGED IN";
        echo json_encode(array($message, $url));

    }
    else
    {
        $_SESSION["logged_in"] = false;
        $url = "#";
        $message = "FALED TO LOGIN";
        echo json_encode(array($message, $url));
    }
}



?>