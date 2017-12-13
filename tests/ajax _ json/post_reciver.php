<?php






$limit = 10;

$next_page = $_POST["page"];
$page = $next_page;


if( $_POST["id"] == "+1" )
{
    $next_page += 1;
} else if ( $_POST["id"] == "-1" )
{
    $next_page -=1;
}

$page_right = $next_page*$limit;
$page_left = $page_right - $limit;




 if ( $next_page < 0)
{
    echo "error";

}
if ( $next_page == 0){
    $page_left = 0;
    $page_right = $limit;

}


include '../../db_connnection.php';
$conn = OpenCon();
if($conn === false){
    die("ERROR: Could not connect. " );
}

$name = mysqli_real_escape_string($conn, $page_left);
$name = mysqli_real_escape_string($conn, $page_right);

$sql = $conn->prepare("SELECT Id, FirstName , LastName  , Title , DepartmentId
                              FROM workers 
                              ORDER BY Id
                              LIMIT ?, ?
                              ;");

$sql->bind_param("ii", $page_left , $page_right );
$sql->execute();
$result = $sql->get_result();


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

echo "<script> 
        $(function () {
          $('#page').val(\"". $next_page ."\");
        });
    </script>
    ";
/*
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>Id </th>";
        echo "<th>First Name  </th>";
        echo "<th>Last Name </th>";
        echo "<th>Title </th>";
        echo "<th>Depart </th>";
        echo "</tr>";
        $i=0;
        while(($row = mysqli_fetch_array($result)) &&  ($i < 1) ){

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['DepartmentId'] . "</td>";
            echo "<td>
                <form action=\"edit.php\" method=\"post\">
                    <button name=\"Edit\" value=\"". $row['id'] ."\" class='btn'>Edit</button>
               </form>
                </td>";
            echo "<td>
                <form action=\"delete.php\" method=\"post\">
                    <button name=\"Delete\" value=\"". $row['id'] ."\" class='btn btn-danger'>Delete</button>
               </form>
                </td>";
            echo "</tr>";

            $i++;

        }
        echo "</table>";*/
        // Free result set
/*        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not  execute $sql.";
}*/

// Close connection

CloseCon($conn); // SELECT workers, COUNT(*) FROM Id;

?>
