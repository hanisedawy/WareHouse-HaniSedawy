<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO transactions (item_id, user_id, type, quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $item_id, $_SESSION['user_id'], $type, $quantity);
    $stmt->execute();

    // Update item quantity
    if ($type == 'add') {
        $sql = "UPDATE items SET quantity = quantity + ? WHERE id = ?";
    } elseif ($type == 'subtract') {
        $sql = "UPDATE items SET quantity = quantity - ? WHERE id = ?";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $item_id);
    $stmt->execute();
}

$items = $conn->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Transactions</title>
</head>
<body>
    <h2>Manage Transactions</h2>
    <form method="POST">
        <label>Item:</label>
        <select name="item_id">
            <?php while ($item = $items->fetch_assoc()) { ?>
                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Type:</label>
        <select name="type">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="inventory">Inventory</option>
        </select>
        <br>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
