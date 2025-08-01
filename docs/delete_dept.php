<?php
include 'db_connect.php'; // Your DB connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $message = "";

    // Fetch the dept_name using the ID
    $getNameStmt = $conn->prepare("SELECT dept_name FROM dept_table WHERE id = ?");
    $getNameStmt->bind_param("i", $id);
    $getNameStmt->execute();
    $getNameStmt->bind_result($dept_name);

    if ($getNameStmt->fetch()) {
        $getNameStmt->close();

        // Delete from dept_detail using dept_name
        $delDetailStmt = $conn->prepare("DELETE FROM dept_detail WHERE dept_name = ?");
        $delDetailStmt->bind_param("s", $dept_name);
        $delDetailStmt->execute();
        $delDetailStmt->close();

        // Delete from dept_table using id
        $delDeptStmt = $conn->prepare("DELETE FROM dept_table WHERE id = ?");
        $delDeptStmt->bind_param("i", $id);
        $delDeptStmt->execute();
        $delDeptStmt->close();

        $message = "✅ Department '{$dept_name}' deleted successfully.";
    } else {
        $message = "⚠️ No department found with ID {$id}.";
    }

    $conn->close();
    header("Location: manage_dept.php?alert=" . urlencode($message));
    exit;
} else {
    header("Location: manage_dept.php?alert=" . urlencode("🚫 No department ID provided."));
    exit;
}
?>
