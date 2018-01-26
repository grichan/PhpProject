<?php

    if(isset($_POST['Delete'])) {
        $post = $_POST['Delete'];
        echo "/" . $post . "/";

        include 'connection.php';
        $conn = OpenCon();

        $post = $_POST['Delete'];
        $post = mysqli_real_escape_string($conn, $post);

        $stmt = $conn->prepare('DELETE FROM  	workers WHERE Id = ?');
        $stmt->bind_param('s', $post);
        $stmt->execute();
        CloseCon($conn);

        header("Location: ../../public_html/index.php"); /* Redirect browser */
        exit();
    } else {
        echo "
            <h1>ERROR</h1>
            <style> body{ background-color:red; } </style>
        ";
    }



?>