<?php






    if(isset($_POST['Delete'])) {
        $post = $_POST['Delete'];
        echo "/" . $post . "/";

        include 'db_connnection.php';
        $conn = OpenCon();

        $post = $_POST['Delete'];
        $post = mysqli_real_escape_string($conn, $post);

        $stmt = $conn->prepare('DELETE FROM  	workers WHERE Id = ?');
        $stmt->bind_param('s', $post);
        $stmt->execute();
        CloseCon($conn);

    }

    header("Location: index.php"); /* Redirect browser */
    exit();

?>