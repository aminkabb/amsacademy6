<?php
// Database connection details
$servername = "localhost";
$username = "root"; // اسم المستخدم الخاص بقاعدة البيانات
$password = ""; // كلمة مرور قاعدة البيانات
$dbname = "t"; // اسم قاعدة البيانات

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $complaint = $_POST['complaint'];

    // Sanitize inputs
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $complaint = filter_var($complaint, FILTER_SANITIZE_STRING);

    // SQL query to insert data into the conn table
    $sql = "INSERT INTO `conn` (name, email, complaint) VALUES ('$name', '$email', '$complaint')";

    if ($conn->query($sql) === TRUE) {
        // Display success message
        echo '<script>alert("تم إرسال الشكوى بنجاح");</script>';
    } else {
        // Display error message
        echo "خطأ في إرسال الشكوى: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
