<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>


<html>

<head>
    <title>Paging Using PHP</title>
</head>

<body>



<?php

include '../../db_connnection.php';
$conn = OpenCon();
if($conn === false){
die("ERROR: Could not connect. " );
}



$sql = $conn->prepare("SELECT Id, FirstName , LastName  , Title , DepartmentId
FROM workers
ORDER BY Id
LIMIT 0, 10
;");


$sql->execute();
$result = $sql->get_result();

echo "<div id='response'>";

echo "<table class='table'>";
    echo "<tr>";
        echo "<th>Id </th>";
        echo "<th>First Name  </th>";
        echo "<th>Last Name </th>";
        echo "<th>Title </th>";
        echo "<th>Depart </th>";
        echo "</tr>";

    while ($row = $result->fetch_assoc())
    {
    echo "<tr>";
        echo "<td>" . $row['Id'] . "</td>";
        echo "<td>" . $row['FirstName'] . "</td>";
        echo "<td>" . $row['LastName'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['DepartmentId'] . "</td>";
        echo "<td>
            <form action=\"../edit.php\" method=\"post\">
                <button name=\"Edit\" value=\"". $row['Id'] ."\" class='btn'>Edit</button>
            </form>
        </td>";
        echo "<td>
            <form action=\"../delete.php\" method=\"post\">
                <button name=\"Delete\" value=\"". $row['Id'] ."\" class='btn btn-danger'>Delete</button>
            </form>
        </td>";

        }
        echo "</tr>";
    echo "</table>";
echo "</div>";
    ?>


<form id="page_btns" method="post" onload="load()" >
    <button id="button_1" value="-1" name="but1">Previous</button>
    <button id="button_2" value="+1" name="but2">Next</button>
    <input id="page" type="hidden" value="1" name="page" >
</form>

<!-- where the response will be displayed -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
<script >

</script>
<script>
    console.log("ASD");


    $(document).ready(function(){




        $("button").click(function(e) {
            e.preventDefault();


            /*
             * 'post_receiver.php' - where you will pass the form data
             * $(this).serialize() - to easily read form data
             * function(data){... - data contains the response from post_receiver.php
             */
            $.ajax({
                type: 'POST',
                url: 'post_reciver.php',
                //data: { id: $(this).val()                 // < note use of 'this' here
                <?php $page_number = $_POST["page"] ?>
                data:{
                    'id':  $(this).val(),
                    'page': '<?php echo $page_number ?>'// <-- the $ sign in the parameter name seems unusual, I would avoid it
                },


            })
                .done(function(data){
                    // show the response
                    $('#response').html(data);
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert( "Posting failed." );
                });
            // to prevent refreshing the whole page page
            return false;

        });
    });

</script>
</body>
</html>