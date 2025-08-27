<?php
include "auth_session.php";
if ($_SESSION['admin_role'] !== 'superadmin') {
    die("Access denied.");
}

include "db_connect.php";
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM admin_users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: manage_admins.php");
exit;
?>
