
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
    include "../resources/classes/Worker.php";
?>
    <div class="container">
        <div class="row ">
            <div class="col">
                <br>
                <h1 class="text-center"> Edit User</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <?php
                        if(isset($_POST['Edit'])){
                                require_once "../". TEMPLATES_PATH . '/connection.php';
                                $worker = getWorker( $_POST["Edit"] );
                                echo "<table class='table'>";
                                    echo "<tr>";
                                        echo "<th>First Name  </th>";
                                        echo "<th>Last Name </th>";
                                        echo "<th>Title </th>";
                                        echo "<th>Department  </th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        global $worker;
                                        echo "<td>" . $worker->firstName . "</td>";
                                        echo "<td>" . $worker->lastName . "</td>";
                                        echo "<td>" . $worker->title . "</td>";
                                        echo "<td>" . $worker->department . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                ?>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form action="../resources/templates/updateRequest.php" method="POST">
                    First name: <input type="text" name="FirstName" class="form-control" value="<?php echo("". $worker->firstName ."")?>"><br>
                    Last name: <input type="text" name="LastName" class="form-control"  value="<?php echo("". $worker->lastName ."")?>" ><br>
                    Title: <input type="text" name="Title" class="form-control"  value="<?php echo("". $worker->title ."")?>" ><br>
                    Department:<div class="dropdown">
                        <?php
                        $departmetsArray = getDepartments();
                        echo "<select name='dropdown'>";
                        foreach ( $departmetsArray as $row){
                            if ( $row[0] == $worker->department) {
                                echo "  <option selected=\"selected\" value=\""  . $row[0] ."\">". $row[1] ." </option>";
                            } else {
                                echo "  <option value=\""  .$row[0]."\">". $row[1] ." </option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <br>
                    <input name="Id" type="hidden" value="<?php echo $worker->id ?>">
                    <input type="button" onclick="window.location.href='index.php'" value="Back" name="back" class="btn">
                    <input type="submit" value="Sumbit" name="submit" class="btn btn-primary">
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>


