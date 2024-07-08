<!-- add_property.php -->
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_name = $_POST['property_name'];

    $sql = "INSERT INTO properties (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $property_name);
    $stmt->execute();
    
    header("Location: manage_items.php");
    exit();
}
?>
