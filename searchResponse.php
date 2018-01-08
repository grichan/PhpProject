<?php



$conn = mysqli_connect("127.0.0.1", "root", "", "workersDb");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$search = $_POST['name'];
echo "<h1>". $search ."</h1>";

$sql = $conn->prepare("SELECT  Id, FirstName, LastName, DepartmentId, Title FROM workers WHERE FirstName LIKE '%" . $search .  "%' OR LastName LIKE '%" . $search ."%' OR Title LIKE '%" . $search ."%' OR Id LIKE '%" . $search ."%'");
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
{   $json_response = json_encode($row);
    echo "<tr>";
    echo "<td>" . $row['Id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Title'] . "</td>";
    echo "<td>" . $row['DepartmentId'] . "</td>";
    echo "<td>
                <form action=\"edit.php\" method=\"post\">
                    <button name=\"Edit\" value=\"". $row['Id'] ."\" class='btn'>Edit</button>
               </form>
                </td>";
    echo "<td>
                <form action=\"delete.php\" method=\"post\">
                    <button name=\"Delete\" value=\"". $row['Id'] ."\" class='btn btn-danger'>Delete</button>
               </form>
                </td>
                <script>
                         localStorage.setItem('SearchType', 1);                
                </script>
                ";
}

echo "</tr>";
echo "</table>";
?>