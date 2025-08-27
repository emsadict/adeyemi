<?php
include "auth_session.php";
include "db_connect.php";

$id = $_GET['id'] ?? null;
if (!$id) { echo "Invalid ID"; exit; }

$stmt = $conn->prepare("DELETE FROM vice_chancellor WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: managevc.php?alert=VC profile deleted");
exit;
