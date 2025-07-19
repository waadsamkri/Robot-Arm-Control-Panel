<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "robot_arm");

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات بصيغة JSON
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = (int)$data['id'];

    // تحديث الحالة إلى غير نشط
    $sql = "UPDATE poses SET status = 0 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Pose removed.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
