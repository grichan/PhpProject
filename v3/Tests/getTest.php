<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<form action="getTest.php" method="get">
    <input type="text" name="search">
    <input type="number" name="page_number">
    <input type="submit" value="Click" >
</form>
<?php
include '../resources/templates/connection.php';
include "../resources/classes/Worker.php";

if ( isset($_GET["search"]) && isset($_GET["page_number"])){
    $search = $_GET["search"];
    $page_number = $_GET["page_number"];

    if ( $_GET["page_number"] == "" | $_GET["page_number"] <= 0  ){
        $page_number = 1;
    }
    $rows_per_page = 10;
    $max_page_rows = $page_number*$rows_per_page;
    $starting_page_rows = $max_page_rows - $rows_per_page;

    echo $search;
    echo $page_number;
    $workers_array = dbSearchWorkers($search, $starting_page_rows , 10);
    foreach ($workers_array as $row) {
        echo "<br>" . $row->id . " " . $row->firstName . " " . $row->lastName . " " . $row->department  . " " . $row->title . " " . "</br>";
        echo '
                <form action="edit.php" method="post">
                    <button name="Edit" value=" ' . $row->id . ' " class="btn">Edit</button>
               </form>
            
                ';
        echo "
                <form action=\"../" . TEMPLATES_PATH . "/delete.php \" method=\"post\">
                    <button name=\"Delete\" value=\"" . $row->id . "\" class='btn btn-danger'>Delete</button>
               </form>
               
                ";

    }
    $total_rows = 15;
    if ($page_number < 1){
        echo "1";
    }
    // 
    echo "1 " . " " . ceil((($page_number-1)/2)+1) . " " . ($page_number-1) . " |" . $page_number . "| " . ( $page_number+1) . " " . ceil($total_rows-(($total_rows-$page_number)/2)) . " " . $total_rows;
}
?>
<script>

</script>
