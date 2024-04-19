<?php
include 'database_operations1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Đặt lệnh này ngay đầu để đảm bảo khởi tạo session trước khi gửi headers

    $username = $_POST["login-username"];
    $password = $_POST["login-password"];

    $conn = connectDB();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sử dụng Prepared Statement để tránh SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $loaiTaiKhoan = $row['UserType'];
        $userID = $row['UserID']; // Giả sử cột UserID tồn tại trong bảng users
        $_SESSION["username"] = $username;
        $_SESSION["userID"] = $userID; // Lưu UserID vào session

        if ($loaiTaiKhoan == 'admin') {
            header("Location: home.php");
        } else if ($loaiTaiKhoan == 'customer') {
            header("Location: userindex.php");
        }
        exit();
    } else {
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }

    $stmt->close();
    $conn->close();
}
?>
