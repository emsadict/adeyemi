<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "website_management";




//$servername = "localhost";
//$username = "afued2025_root"; // Change if necessary
//$password = "afuedfetech2025@@"; // Change if necessary
//$dbname = "afuededu2025_website_management";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
