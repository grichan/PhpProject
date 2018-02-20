
<head>
    <title>Eddit Name</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
</head>

<body>
<?php
    require_once("../resources/config.php");
    require_once( "../" . TEMPLATES_PATH . "/header.php");
?>

    <div class="container">
        <div class="row ">
            <div class="col">
                <br>
                <h1 class="text-center"> Edit User</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
<?php
if(isset($_POST['Edit'])){


                require_once "../". TEMPLATES_PATH . '/connection.php';

                $name = $_POST["Edit"];
                $conn = OpenCon();
                $name = mysqli_real_escape_string($conn, $name);

                $stmt = $conn->prepare('SELECT * FROM workers WHERE Id = ?');
                $stmt->bind_param('s', $name);
                $stmt->execute();
                echo "<table class='table'>";
                echo "<tr>";
                echo "<th>First Name  </th>";
                echo "<th>Last Name </th>";
                echo "<th>Title </th>";
                echo "<th>Department  </th>";
                echo "</tr>";
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    global $id;
                    $id = $row['Id'];
                    $fname = $row['FirstName'];  echo "<td>" . $fname . "</td>";
                    $lname = $row['LastName']; echo "<td>" . $lname . "</td>";
                    $title = $row['Title']; echo "<td>" . $title . "</td>";
                    $department = $row['DepartmentId']; echo "<td>" . $department . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
            <div class="col-2">

            </div>
        </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form action="../resources/templates/updateRequest.php" method="POST">
                            First name: <input type="text" name="FirstName" class="form-control" value="<?php echo("". $fname ."")?>"><br>
                            Last name: <input type="text" name="LastName" class="form-control"  value="<?php echo("". $lname ."")?>" ><br>
                            Title: <input type="text" name="Title" class="form-control"  value="<?php echo("". $title ."")?>" ><br>
                            <div class="dropdown">
                                <?php
                                $stmt = $conn->prepare('SELECT * FROM Departments');
                                $stmt->execute();
                                $result = $stmt->get_result();

                                echo "<select name='dropdown'>";
                                while ($row = $result->fetch_assoc()) {
                                    if ( $department == $row['Id'] )
                                    {
                                        echo "  <option selected=\"selected\" value=\""  .$row['Id']."\">". $row['DepartmentName'] ." </option>";
                                    } else
                                    {
                                        echo "  <option value=\""  .$row['Id']."\">". $row['DepartmentName'] ." </option>";
                                    }
                                };
                                echo "</select>";
                                ?>
                            </div>
                            <br>
                            <input name="Id" type="hidden" value="<?php echo $id ?>">
                            <input type="button" onclick="window.location.href='index.php'" value="Back" name="back" class="btn">
                            <input type="submit" value="Sumbit" name="submit" class="btn btn-primary">
                        </form>

<?php
} else
    echo "Nope";
?>


                    </div>
                    <div class="col-2"></div>
                </div>

    </div>
</body>

<style>
    div.container {
    }

</style>
