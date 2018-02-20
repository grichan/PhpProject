
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<body>
<?php
require_once("../resources/config.php");
require_once( "../" . TEMPLATES_PATH . "/header.php");
?>
<div class="container">
    <br>
    <h2 class="text-center">Add new user</h2>
    <div class="row">
        <div class="col">
        </div>
        <div class="col-6">
            <form action="" method="POST" class="form-group">
                First name: <input required  id="FirstName" type="text" name="FirstName" value="" class="form-control" required><br>
                Last name: <input required type="text" name="LastName"  value="" class="form-control" required><br>
                Title: <input required type="text" name="Title"  value="" class="form-control" required><br>
                Department:
                <div required class="dropdown" required>
                    <?php
                    include "../" . TEMPLATES_PATH . "/connection.php";
                    $conn = OpenCon();
                    $stmt = $conn->prepare('SELECT * FROM Departments');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    echo "<select name='dropdown' class='form-control'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "  <option value=\""  .$row['Id']."\">". $row['DepartmentName'] ."</option>";
                    };
                    echo "</select>";
                    ?>
                </div>
                <br>
                <input type="button" onclick="window.location.href='index.php'"   value="Back" name="back" class="btn">
                <input type="submit"  value="Submit" name="submit" class="btn btn-primary">
            </form>
            <?php
                if(isset($_POST['submit'] ) != null && $_POST["FirstName"] && $_POST["LastName"] && $_POST["dropdown"] && $_POST["Title"] != null ) {

                    $fname = $_POST['FirstName'];
                    $lname = $_POST['LastName'];
                    $depart = $_POST['dropdown'];
                    $title = $_POST['Title'];
                    $name = mysqli_real_escape_string($conn, $fname);
                    $name = mysqli_real_escape_string($conn, $lname);
                    $name = mysqli_real_escape_string($conn, $depart);
                    $name = mysqli_real_escape_string($conn, $title);

                    $stmt = $conn->prepare('
                    INSERT INTO workers ( FirstName, LastName,  DepartmentId , Title )
                    VALUES (  ?, ?, ?, ?);
                    ');
                    $stmt->bind_param("ssss", $fname, $lname,  $depart , $title);
                    $stmt->execute();
                }
                ?>
        </div>
        <div class="col">
        </div>
    </div>
</div>

</body>





