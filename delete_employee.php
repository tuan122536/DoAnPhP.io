<?php
// delete_employee.php

include 'database_operations1.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["MaNhanVien"])) {
    $MaNhanVien = $_GET["MaNhanVien"];

    // Gọi hàm xóa nhân viên
    $result = deleteEmployeeByMaNhanVien($MaNhanVien);

    if ($result) {
        echo "Xóa nhân viên thành công!";
    } else {
        echo "Xóa nhân viên thất bại!";
    }
} else {
    echo "Yêu cầu không hợp lệ!";
}
?>
