
<?php
require './includes/visitor.php';
session_start();

if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

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

if(isset($_POST['edit_marks'])) {
    $student_id = $_POST['student_id'];
    $week = $_POST['week'];
    $marks = $_POST['marks'];

    $sql = "UPDATE student SET $week='$marks' WHERE student_id='$student_id'";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Marks updated successfully";
    } else {
        $error_message = "Error updating marks: " . $conn->error;
    }
}

if(isset($_POST['add_student'])) {
    $student_id = $_POST['student_id'];

    $sql = "INSERT INTO student (student_id) VALUES ('$student_id')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "New student added successfully";
    } else {
        $error_message = "Error adding student: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/dashboard.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <a href="../logout.php">Logout</a>

    <h3>Edit Student Marks</h3>
    <?php if(isset($success_message)) { ?>
        <p><?php echo $success_message; ?></p>
    <?php } ?>
    <?php if(isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label for="student_id">Student ID:</label>
        <input type="number" id="student_id" name="student_id" required><br><br>
        <label for="week">Select Week:</label>
        <select id="week" name="week">
            <option value="week1">Week 1</option>
            <option value="week2">Week 2</option>
            <option value="week3">Week 3</option>
            <option value="week4">Week 4</option>
        </select><br><br>
        <label for="marks">Enter Marks:</label>
        <input type="text" id="marks" name="marks" required><br><br>
        <input type="submit" name="edit_marks" value="Edit Marks">
    </form>

    <h3>Add New Student</h3>
    <form method="post" action="">
        <label for="new_student_id">New Student ID:</label>
        <input type="number" id="new_student_id" name="student_id" required><br><br>
        <input type="submit" name="add_student" value="Add Student">
    </form>
</body>
</html>

