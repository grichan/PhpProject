<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

<html>

<head>
    <title>Paging Using PHP</title>
</head>

<body>



<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "test_db");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


    
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

<form id="page_btns" method="post"  >
    <button id="button" value="-1" name="but1">Previous</button>
    <button id="button" value="+1" name="but2">Next</button>

    
    <input id="page" type="hidden" value="1" name="page" >
</form>

<script> localStorage.setItem('page', 1); </script>

<script>

    $(document).ready(function(){

        $("button").click(function(e) {
            e.preventDefault();
            // show that something is loading
            var page_number = localStorage.getItem('page');
            // var bla = $('#page').val();
           // alert(bla);

            /*
             * 'post_receiver.php' - where you will pass the form data
             * $(this).serialize() - to easily read form data
             * function(data){... - data contains the response from post_receiver.php
             */
            $.ajax({
                type: 'POST',
                url: 'response.php',
                //data: { id: $(this).val()                 // < note use of 'this' here
                data:{
                    'id':  $(this).val(),
                    'page': page_number // <-- the $ sign in the parameter name seems unusual, I would avoid it
                },

                    })
                .done(function(data){
                            // show the response
                            $('#response').html(data);
                            //alert(data[0]);
                        $('input[name=page]').val(data[0]);
                            var pg = localStorage.getItem('page');
                            var str = localStorage.getItem('response');

                            //var obj1 = [];
                            //var obj1 = localStorage.getItem("response");
                            //obj1 = (obj1) ? JSON.parse(obj1) : []; // check if localstorage obj contains an array called obj.
                            // if it does it will parse the string and return cars array if it does not it will set cars
                            // array to a new empty array
                            //alert(str);
                            var obj = JSON.parse(str);
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