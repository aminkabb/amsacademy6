<?php
// تفاصيل الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = ""; // يمكنك وضع كلمة المرور هنا إذا كانت موجودة
$dbname = "t";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$university = $_POST['university'];
$city = $_POST['city'];
$role = $_POST['role'];
$specialization = $_POST['specialization'];

// إدخال البيانات في جدول "form"
$sql = "INSERT INTO form (name, email, phone, age, university, city, role, specialization)
        VALUES ('$name', '$email', '$phone', '$age', '$university', '$city', '$role', '$specialization')";

if ($conn->query($sql) === TRUE) {
    echo "تم تسجيل البيانات بنجاح";
} else {
    echo "خطأ في تسجيل البيانات: " . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
