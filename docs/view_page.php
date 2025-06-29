<?php
require 'db_connect.php';

$pg_id = $_GET['id'];
$page = $conn->query("SELECT * FROM pages_table WHERE pg_id = $pg_id")->fetch_assoc();

$category = $page['pg_categ_id'];

if ($category == "VCO-unit") {
    require 'templates/vco_template.php';
}
 elseif ($category == "Directorates" ||$category == "directorate" ) {
    //require 'templates/directorate_template.php';
    require 'directorate-main.php';
}
elseif ($category == "School" ||$category == "school" ){
        require 'school.php';
}
else {
    require 'templates/default_template.php';
}
?>
