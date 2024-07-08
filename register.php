<!-- register.php -->
<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // تأكد من أن الحقول ليست فارغة
    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required.";
        exit();
    }

    // معالجة الأخطاء
    try {
        $sql = "INSERT INTO users (username, password, email, is_active, role) VALUES (?, ?, ?, 0, 'user')";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("sss", $username, $password, $email);
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        header("Location: login.php?registration=success");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warehouse Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="header">
        <h1>Warehouse Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </div>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <label>Username:</label>
            <input type="text" name="username" required>
            <br>
            <label>Password:</label>
            <input type="password" name="password" required>
            <br>
            <label>Email:</label>
            <input type="email" name="email" required>
            <br>
            <button type="submit">Register</button>
        </form>
    </div>
    <div class="footer">
        <p>&copy; 2024 Warehouse Management System</p>
    </div>
</body>
</html>
