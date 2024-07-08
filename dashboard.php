<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <a href="logout.php">Logout</a>
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <h3>Admin Menu</h3>
        <ul>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_items.php">Manage Items</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    <?php } else { ?>
        <h3>Employee Menu</h3>
        <ul>
            <li><a href="manage_items.php">Manage Items</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    <?php } ?>
</body>
</html>
