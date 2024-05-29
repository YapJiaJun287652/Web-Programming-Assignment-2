
<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header('Location: dashboard.php');
            exit();
        } else {
            echo 'Incorrect password.';
        }
    } else {
        echo 'No user found with that email.';
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clinic Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Clinic</h1>
        <div class="login-form">
            <h2>Login</h2>
            <form id="loginForm" action="login.php" method="POST" onsubmit="return validateLoginForm()">
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="email" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p id="loginMessage"></p>
            <p>Don't have an account? <a href="register.php">Register now!</a></p>
        </div>
    </div>
</body>
</html>
