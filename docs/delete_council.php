<?php
include "auth_session.php";
include "db_connect.php";

if ($_SESSION['admin_role'] !== 'superadmin') {
    die("Access denied.");
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Invalid request.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM governing_council WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: managecouncil.php?alert=Council member deleted");
exit;
