<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $properties = $_POST['properties'];

    $sql = "INSERT INTO items (name, category_id, quantity, properties) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdis", $name, $category_id, $quantity, $properties);
    $stmt->execute();
}

$categories = $conn->query("SELECT * FROM categories");
$items = $conn->query("SELECT items.*, categories.name AS category_name FROM items JOIN categories ON items.category_id = categories.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Items</title>
</head>
<body>
    <h2>Manage Items</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Category:</label>
        <select name="category_id">
            <?php while ($category = $categories->fetch_assoc()) { ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <br>
        <label>Properties:</label>
        <textarea name="properties"></textarea>
        <br>
        <button type="submit">Add Item</button>
    </form>
    <h3>Existing Items</h3>
    <ul>
        <?php while ($item = $items->fetch_assoc()) { ?>
            <li><?php echo $item['name'] . ' (' . $item['category_name'] . ') - Quantity: ' . $item['quantity']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
