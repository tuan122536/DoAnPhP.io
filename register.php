<?php
    // Include file chứa hàm tạo tài khoản
    include 'database_operations1.php';

    // Kiểm tra khi người dùng gửi form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Gọi hàm tạo tài khoản mới
        createAccount($username, $password, $email);
    }
    ?>