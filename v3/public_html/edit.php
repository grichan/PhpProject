
<head>
<title>Eddit Name</title>
<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css" >
<script src="css/bootstrap.min.js"></script>
<script src="css/popper.min.js"></script>
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
                                $worker = dbGetWorker( $_POST["Edit"] );
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
                        $departmetsArray = dbGetDepartments();
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


