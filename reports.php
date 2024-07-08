<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$transactions = $conn->query("SELECT transactions.*, items.name AS item_name, users.username AS user_name FROM transactions JOIN items ON transactions.item_id = items.id JOIN users ON transactions.user_id = users.id ORDER BY transactions.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>
    <h2>Reports</h2>
    <table border="1">
        <tr>
            <th>Item</th>
            <th>User</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Timestamp</th>
        </tr>
        <?php while ($transaction = $transactions->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $transaction['item_name']; ?></td>
                <td><?php echo $transaction['user_name']; ?></td>
                <td><?php echo $transaction['type']; ?></td>
                <td><?php echo $transaction['quantity']; ?></td>
                <td><?php echo $transaction['timestamp']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
