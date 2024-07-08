<!-- user_requests.php -->
<?php
include 'db.php';
session_start();

// التأكد من أن المستخدم هو المدير
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $sql = "UPDATE users SET is_active = 1 WHERE id = ?";
    } elseif ($action == 'reject') {
        $sql = "DELETE FROM users WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

$pending_users = $conn->query("SELECT * FROM users WHERE is_active = 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending User Requests - Warehouse Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="header">
        <h1>Warehouse Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="manage_items.php">Manage Items</a>
            <a href="help.php">Help</a>
            <a href="user_requests.php">User Requests</a>
        </nav>
    </div>
    <div class="container">
        <h2>Pending User Requests</h2>
        <table border="1">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php while ($user = $pending_users->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <form method="POST" action="user_requests.php">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                            <button type="submit" name="action" value="reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="footer">
        <p>&copy; 2024 Warehouse Management System</p>
    </div>
</body>
</html>
