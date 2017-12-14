
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div class="container">
    <?php
    if(isset($_POST['submit'])){
        if(isset($_GET['go'])){
            if(preg_match("/^[a-zA-Z0-9_.-]+/", $_POST['name'])){ //regular expression
                $name=$_POST['name'];

                include 'db_connnection.php';
                $conn = OpenCon();
                $name = mysqli_real_escape_string($conn, $name);


                $sql="SELECT  Id, FirstName, LastName, Title FROM workers WHERE FirstName LIKE '%" . $name .  "%' OR LastName LIKE '%" . $name ."%' OR Title LIKE '%" . $name ."%' OR Id LIKE '%" . $name ."%'";
                $result = mysqli_query($conn, $sql);
                //-create  while loop and loop through result set
                if(mysqli_num_rows($result) > 0){
                    echo "<table class='table'>";
                    echo "<tr>";
                    echo "<th>Id </th>";
                    echo "<th>First Name  </th>";
                    echo "<th>Last Name </th>";
                    echo "<th>Title </th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['Id'] . "</td>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['Title'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "<h2 class='text-center'>No records matching your query were found.</h2>";
                }
                CloseCon($conn);


                //  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$FirstName . " " . $LastName .  "</a></li>\n";
                //  echo "</ul>";

            }
            else{
                echo  "<h2 class='text-center'>Please enter a search query</h2>";
            }
        }
    }
    ?>
</div>
