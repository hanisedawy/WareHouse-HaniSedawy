<!-- manage_items.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items - Warehouse Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="header">
        <h1>Warehouse Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="manage_items.php">Manage Items</a>
            <a href="help.php">Help</a>
        </nav>
    </div>
    <div class="container">
        <h2>Manage Items</h2>
        <form method="POST" action="add_property.php">
            <label>Property Name:</label>
            <input type="text" name="property_name" required>
            <br>
            <button type="submit">Add Property</button>
        </form>
        <hr>
        <form method="POST" action="add_item.php">
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
    </div>
    <div class="footer">
        <p>&copy; 2024 Warehouse Management System</p>
    </div>
</body>
</html>
