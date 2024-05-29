<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare('INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $name, $email, $password, $phone, $address);

    if ($stmt->execute()) {
        header('Location: login.php'); 
        exit(); 
    } else {
        if ($stmt->errno == 1062) {
            header('Location: register.php?message=email_taken');
        } else {
            header('Location: register.php?message=error');
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clinic Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1 class="title">Clinic</h1>
        <div class="registration-form">
            <form id="registrationForm" action="register.php" method="POST" onsubmit="return validateRegistrationForm()">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <button type="submit">Register</button>
            </form>
            <p id="registrationMessage"></p>
            <p>Already have an account? <a href="login.php">Login now!</a></p>
        </div>
    </div>
</body>
</html>


