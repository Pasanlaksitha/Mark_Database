<?php
//require './includes/visitor.php';
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_mark_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $encrypted_password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Compare the encrypted passwords
        if ($encrypted_password === $stored_password) {
            // Authentication successful
            $_SESSION['username'] = $username;
            header('Location: pages/dashboard.php');
            exit;
        } else {
            $error_message = "Wrong password";
        }
    } else {
        $error_message = "User not found";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <script src="js/login.js"></script>
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="checkbox" onclick="showPassword()">Show Password<br><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>
