<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "robot_arm");

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات من JavaScript بصيغة JSON
$data = json_decode(file_get_contents("php://input"), true);

// التأكد من وجود كل القيم
if (isset($data['motor1'], $data['motor2'], $data['motor3'], $data['motor4'], $data['motor5'], $data['motor6'])) {
    $m1 = (int)$data['motor1'];
    $m2 = (int)$data['motor2'];
    $m3 = (int)$data['motor3'];
    $m4 = (int)$data['motor4'];
    $m5 = (int)$data['motor5'];
    $m6 = (int)$data['motor6'];

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO poses (motor1, motor2, motor3, motor4, motor5, motor6) VALUES ($m1, $m2, $m3, $m4, $m5, $m6)";
    
    if ($conn->query($sql) === TRUE) {
        echo "Pose saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid input.";
}

$conn->close();
?>
