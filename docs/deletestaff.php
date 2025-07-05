<?php
include "db_connect.php";

$id = $_GET['id'] ?? 0;

if ($id) {
    $conn->query("DELETE FROM staff_table WHERE id=$id");
    header("Location: managestaff.php");
    exit;
} else {
    echo "❌ Invalid staff ID.";
}
?>