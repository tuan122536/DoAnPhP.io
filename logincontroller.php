<?php
// login.php

include 'database_operations1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["login-username"];
    $password = $_POST["login-password"];

    // Truy vấn kiểm tra thông tin đăng nhập
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Lấy loại tài khoản của người dùng
        $row = $result->fetch_assoc();
        $loaiTaiKhoan = $row['UserType'];

        // Đăng nhập thành công
        session_start();
        $_SESSION["username"] = $username;

        // Chuyển hướng dựa trên loại tài khoản
        if ($loaiTaiKhoan == 'admin') {
            header("Location: home.php"); // Chuyển hướng đến trang chính cho admin
        } else if ($loaiTaiKhoan == 'customer') {
            header("Location: userindex.php"); // Chuyển hướng đến trang chính cho người dùng
        }
        exit();
    } else {
        // Đăng nhập không thành công
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }
    $conn->close();
}
?>



