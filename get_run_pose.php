<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "robot_arm");

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// سحب الوضعيات النشطة فقط (status = 1)
$sql = "SELECT * FROM poses WHERE status = 1 ORDER BY id DESC";
$result = $conn->query($sql);

$poses = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $poses[] = $row;
    }
}

// إرسال النتيجة على شكل JSON
header('Content-Type: application/json');
echo json_encode($poses);

$conn->close();
?>
