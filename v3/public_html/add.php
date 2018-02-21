
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<body>
<?php
require_once("../resources/config.php");
require_once( "../" . TEMPLATES_PATH . "/header.php");
include "../resources/classes/Worker.php";

?>
<div class="container">
    <br>
    <h2 class="text-center">Add new user</h2>
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <form action="" method="POST" class="form-group">
                First name: <input required  id="FirstName" type="text" name="FirstName" value="" class="form-control" required><br>
                Last name: <input required type="text" name="LastName"  value="" class="form-control" required><br>
                Title: <input required type="text" name="Title"  value="" class="form-control" required><br>
                Department:
                <div required class="dropdown" required>
                    <?php
                    include "../" . TEMPLATES_PATH . "/connection.php";
                    $data = getDepartments();
                    echo "<select name='dropdown' class='form-control'>";
                    foreach ( $data as $row){
                        echo "  <option value=\""  . $row[0] ."\">". $row[1] ."</option>";
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

                    $message = addWorker( $_POST['FirstName'], $_POST['LastName'], $_POST['dropdown'], $_POST['Title'] );
                    if ( (string)$message == "Success"){
                        echo " <div id='alert1' class='alert alert-success'>
                            <strong>Success!</strong>
                       </div> ";
                    }
                }
                ?>
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="row">
    <div class="col"></div>
</div>
<script>
    $(document).ready( function() {
        $('#alert1').animate({top:0}, 1000).fadeOut();
    });
</script>
</body>





