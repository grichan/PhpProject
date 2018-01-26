<?php
session_start();
include '../config.php';

$login_status = false;
if ( $_SESSION && $_SESSION["logged_in"] == true){
    $login_status = true;
    $username = $_SESSION["name"];
}

$limit = 6;

$next_page = $_POST["page"];
$page = $next_page;

if( $_POST["type"] == "Search"  ) //calculate next page
{

    $page_left = 0;
    $next_page = 1;
} else if( $_POST["type"] == "next" )
{

    $next_page += 1;// increment the page number

} else if ( $_POST["type"] == "prev" )
{

    $next_page -=1;
} else if( is_int((int)$_POST["type"]))
{
    $next_page = $_POST["type"];
}

$page_right = $next_page*$limit;
$page_left = $page_right - $limit; // starting point for query

if  ($next_page <= 0 ){ // if nextpage less than 0
    $page_left = 0;
    $next_page = 1;
}

$conn = mysqli_connect("127.0.0.1", "root", "", "workersDb");

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$search = $_POST['search']; // gets the search string
echo "<h1> Searched for: ". $search ."</h1>";

$sql = $conn->prepare(" SELECT  * FROM workers WHERE FirstName LIKE '%" . $search .  "%' OR LastName LIKE '%" . $search ."%' OR Title LIKE '%" . $search ."%' OR Id LIKE '%" . $search ."%'");
$sql->execute();

$result = $sql->get_result();
$totalRows = $result->num_rows;

$sql = $conn->prepare(" SELECT  Id, FirstName, LastName, DepartmentId, Title FROM workers WHERE FirstName LIKE '%" . $search .  "%' OR LastName LIKE '%" . $search ."%' OR Title LIKE '%" . $search ."%' OR Id LIKE '%" . $search ."%' LIMIT $limit OFFSET $page_left " );
$sql->execute();
$result = $sql->get_result();

echo "<h5>Results: $totalRows</h5>";

echo "<table class='table'>";
echo "<tr>";
echo "<th>Id </th>";
echo "<th>First Name  </th>";
echo "<th>Last Name </th>";
echo "<th>Title </th>";
echo "<th>Depart </th>";
echo "</tr>";

while ($row = $result->fetch_assoc()) {
    $json_response = json_encode($row);
    echo "<tr>";
    echo "<td>" . $row['Id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Title'] . "</td>";
    echo "<td>" . $row['DepartmentId'] . "</td>";

    if ( $login_status){
        echo '<td>
                <form action="edit.php" method="post">
                    <button name="Edit" value=" ' . $row['Id'] . ' " class="btn">Edit</button>
               </form>
                </td>
                ';
    }
    if ( $login_status){
        echo "<td>
                <form action=\"../" . TEMPLATES_PATH . "/delete.php \" method=\"post\">
                    <button name=\"Delete\" value=\"". $row['Id'] ."\" class='btn btn-danger'>Delete</button>
               </form>
                </td>
                ";
    }

}
    echo "</tr>";
    echo "</table>";
    $max_page = ceil($totalRows / $limit); // max page count

if ( $totalRows != 0 )
{

    echo("

        
        <form id=\"page_btns\" method=\"post\"  >
            <nav aria-label=\"Page navigation example\">
                <ul class=\"pagination\">         
    ");
    if($next_page > 3) // print previous
    {
        echo (" <li id=\"1\" class=\"page-item\"><a class=\"page-link\" href=\"#\">First</a></li> ");
    }
    for( $i =1; $i <= $max_page; $i++ )
    {


         if ( $i == $next_page-1 ) // print before current page
        {
            echo ("  <li id=\"$i\" class=\"page-item \"><a class=\"page-link\" href=\"#\">$i</a></li> ");
        }else if( $i == $next_page-2) // print as active current page
         {
             echo ("  <li id=\"$i\" class=\"page-item \"><a class=\"page-link\" href=\"#\">$i</a></li> ");
         }
        else if( $i == $next_page) // print as active current page
        {
            echo ("  <li id=\"$i\" class=\"page-item active\"><a class=\"page-link\" href=\"#\">$i</a></li> ");
        }
        else if ( $i == $next_page+1 ) // print active after page
        {
            echo ("  <li id=\"$i\" class=\"page-item\"><a class=\"page-link\" href=\"#\">$i</a></li> ");
        }else if ( $i == $next_page+2 ) // print active after page
        {
            echo ("  <li id=\"$i\" class=\"page-item\"><a class=\"page-link\" href=\"#\">$i</a></li> ");
        }
    }
     if ( $next_page < $max_page-2 ) // print before current page
    {
        echo ("  <li id=\"$max_page\" class=\"page-item \"><a class=\"page-link\" href=\"#\">Last</a></li> ");
    }
    echo (" 
                </ul>
            </nav>
        </form>
        
        <script>
            localStorage.setItem(\"page\", \"$next_page\");
            $(document).ready(onDocumentReady);
        </script>
 
     ");
}
?>