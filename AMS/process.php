<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "t";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging statements
var_dump($_POST);

// Receive data from the form
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Debugging statements
var_dump($username, $email);

// Validate and sanitize inputs
$username = filter_var($username, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
}

// Check if username and email are not empty
if (empty($username) || empty($email)) {
    die("Username and email are required");
}

// SQL query to insert data into the user table using prepared statement
$sql = "INSERT INTO `user` (`username`, `email`) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);

if ($stmt->execute()) {
    // Display success message
    echo '<script>alert("تم تسجيل المستخدم بنجاح");</script>';
} else {
    // Display error message
    echo "خطأ في التسجيل: " . $conn->error;
}
if(isset($_POST['redirect'])) {
    $redirectPage = $_POST['redirect'];
    header("Location: $redirectPage");
    exit;
}
// Close the database connection
$stmt->close();
$conn->close();
?>
