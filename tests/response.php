<?php

$limit = 10;
$next_page = $_POST["page"];
$page = $next_page;

if( $_POST["id"] == "+1" )
{
    $next_page += 1;//2
} else if ( $_POST["id"] == "-1" )
{
    $next_page -=1;
}

$page_right = $next_page*$limit;
$page_left = $page_right - $limit; // starting point for query

if  ($next_page <= 0 ){
        $page_left = 0;
        $next_page = 1;
}

$conn = mysqli_connect("127.0.0.1", "root", "", "test_db");
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$sql = $conn->prepare("SELECT COUNT(Id) FROM workers ;");
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_array(MYSQLI_NUM);

$max_page = ceil($row[0] / $limit); // max page count

if  ( $next_page > $max_page )  //check if page reaches limit
{
        $next_page -= 1;
        $page_left = ($next_page*$limit) - $limit;
}

if ( $page > $max_page )
{
    $next_page = $max_page;
    $page_left = ($next_page*$limit) - $limit;
}

echo "<script> localStorage.setItem('page', ". json_encode($next_page) ."); </script>";

$sql = $conn->prepare("SELECT Id, FirstName , LastName  , Title , DepartmentId
                              FROM workers 
                              ORDER BY Id
                              LIMIT ?, ?
                              ;");

$sql->bind_param("ii", $page_left , $limit );
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
$stringg = "[";

while ($row = $result->fetch_assoc())
{   $json_response = json_encode($row);
    //$array[$i] = $json_response;
    $json_response .= ',';
    $stringg = $stringg . $json_response ;
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
$stringg = substr($stringg , 0, -1);
$stringg .= ']';

echo "</tr>";
echo "</table>";
//echo "<script> localStorage.setItem('response', ". json_encode($stringg) ."); </script>"

?>