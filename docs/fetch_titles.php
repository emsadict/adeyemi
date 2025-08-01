
<?php
include "db_connect.php";
$category = $_POST['category'];

$sql = "SELECT pg_title FROM pages_table WHERE pg_category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$titles = [];
while ($row = $result->fetch_assoc()) {
    $titles[] = $row['pg_title'];
}
echo json_encode($titles);
?>