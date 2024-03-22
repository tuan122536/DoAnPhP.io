<?php
    // Khởi đầu session
    session_start();
    
    // Xóa tất cả các biến session
    session_unset();

    // Hủy session
    session_destroy();

    // Chuyển hướng người dùng về trang login.php
    header("Location: login.html");
    exit; // Đảm bảo không có mã HTML nào được thực thi sau khi chuyển hướng
?>
