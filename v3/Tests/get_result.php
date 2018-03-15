

<?php
if ( isset($_GET["search"]) && isset($_GET["page"]) ) {
    echo $_GET["search"];
    echo $_GET["page_number"];
}
?>