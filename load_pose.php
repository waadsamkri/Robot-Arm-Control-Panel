<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "robot_arm");

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التأكد من وجود id في الرابط
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // جلب بيانات الوضعية
    $sql = "SELECT * FROM poses WHERE id = $id AND status = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $pose = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($pose);
    } else {
        echo json_encode(["error" => "Pose not found"]);
    }
} else {
    echo json_encode(["error" => "ID not provided"]);
}

$conn->close();
?>
