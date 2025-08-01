<?php
include "db_connect.php";
$title = $_POST['title'];

$sql = "SELECT dept_name FROM dept_table WHERE dept_school = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();

$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = $row['dept_name'];
}
echo json_encode($departments);
?>