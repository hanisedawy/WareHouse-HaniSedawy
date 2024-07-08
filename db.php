<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

// ÅäÔÇÁ ÇáÇÊÕÇá
$conn = new mysqli($servername, $username, $password, $dbname);

// ÇáÊÍÞÞ ãä ÇáÇÊÕÇá
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
