<?php
include "db_connect.php";
$id = $_GET['id'];
$conn->query("DELETE FROM big_slider WHERE id=$id");
echo "Slide deleted.";
?>
