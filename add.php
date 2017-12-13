<?php
    ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<body>
<div class="container">
    <br>
    <h2 class="text-center">Add new user</h2>
    <div class="row">
        <div class="col">

        </div>
        <div class="col-6">
            <form action="" method="POST" class="form-group" onsubmit="return validateForm();">
                First name: <input id="FirstName" type="text" name="FirstName" value="" class="form-control" required><br>
                Last name: <input type="text" name="LastName"  value="" class="form-control" required><br>
                Title: <input type="text" name="Title"  value="" class="form-control" required><br>

                Department:
                <div class="dropdown" required>
                    <?php
                    include 'db_connnection.php';
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
                <input type="submit" value="Submit" name="submit" class="btn">

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

                    echo "<div class=\"alert alert-success\" role=\"alert\">Success</div> ";
                    header( "refresh:1;url=index.php" );
                   // CloseCon($conn);
                } else {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">One or more fields are empty </div> ";
                }
                ?>



        </div>
        <div class="col">

            <script>
                var createAllErrors = function() {
                    var form = $( this ),
                        errorList = $( ".form-group", form );

                    var showAllErrorMessages = function() {
                        errorList.empty();

                        // Find all invalid fields within the form.
                        var invalidFields = form.find( ":invalid" ).each( function( index, node ) {

                            // Find the field's corresponding label
                            var label = $( "label[for=" + node.id + "] "),
                                // Opera incorrectly does not fill the validationMessage property.
                                message = node.validationMessage || 'Invalid value.';

                            errorList
                                .show()
                                .append( "<li><span>" + label.html() + "</span> " + message + "</li>" );
                        });
                    };

                    // Support Safari
                    form.on( "submit", function( event ) {
                        if ( this.checkValidity && !this.checkValidity() ) {
                            $( this ).find( ":invalid" ).first().focus();
                            event.preventDefault();
                        }
                    });

                    $( "input[type=submit], button:not([type=button])", form )
                        .on( "click", showAllErrorMessages);

                    $( "input", form ).on( "keypress", function( event ) {
                        var type = $( this ).attr( "type" );
                        if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
                            && event.keyCode == 13 ) {
                            showAllErrorMessages();
                        }
                    });
                };

                $( "form" ).each( createAllErrors );
            </script>
        </div>
    </div>
</div>

</body>





