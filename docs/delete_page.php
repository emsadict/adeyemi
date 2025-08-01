<?php
include('db_connect.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $pg_id = intval($_GET['id']);
    $message = "";

    try {
        $stmt1 = $conn->prepare("DELETE FROM pages_table WHERE pg_id = ?");
        $stmt1->bind_param("i", $pg_id);
        $stmt1->execute();

        $stmt2 = $conn->prepare("DELETE FROM page_details WHERE pg_id = ?");
        $stmt2->bind_param("i", $pg_id);
        $stmt2->execute();

        if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0) {
            $message = "Page with ID {$pg_id} deleted successfully.";
        } else {
            $message = "Page with ID {$pg_id} not found or already deleted.";
        }

        $stmt1->close();
        $stmt2->close();
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }

    $conn->close();
    header("Location: manage_page.php?alert=" . urlencode($message));
    exit();
} else {
    header("Location: manage_page.php?alert=" . urlencode("pg_id not provided."));
    exit();
}
?>
