<?php
// controller.php

include 'database_operations1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action == "add") {
            $MaNhanVien = $_POST["MaNhanVien"];
            $TenNhanVien = $_POST["TenNhanVien"];
            $GioiTinh = $_POST["GioiTinh"];
            $NoiSinh = $_POST["NoiSinh"];
            $MaPhong = $_POST["MaPhong"];
            $Luong = $_POST["Luong"];
            $result = addEmployee($MaNhanVien, $TenNhanVien, $GioiTinh, $NoiSinh, $MaPhong, $Luong);
            if ($result) {
                echo "Thêm nhân viên thành công!";
            } else {
                echo "Thêm nhân viên thất bại!";
            }
        } elseif ($action == "update") {
            $MaNhanVien = $_POST["MaNhanVien"];
            $TenNhanVien = $_POST["TenNhanVien"];
            $GioiTinh = $_POST["GioiTinh"];
            $NoiSinh = $_POST["NoiSinh"];
            $MaPhong = $_POST["MaPhong"];
            $Luong = $_POST["Luong"];
            $result = updateEmployee($MaNhanVien, $TenNhanVien, $GioiTinh, $NoiSinh, $MaPhong, $Luong);
            if ($result) {
                echo "Cập nhật thông tin nhân viên thành công!";
            } else {
                echo "Cập nhật thông tin nhân viên thất bại!";
            }
        } elseif ($action == "delete") {
            $MaNhanVien = $_POST["MaNhanVien"];
            $result = deleteEmployee($MaNhanVien);
            if ($result) {
                echo "Xóa nhân viên thành công!";
            } else {
                echo "Xóa nhân viên thất bại!";
            }
        } elseif ($action == "getEmployees") {
            // Lấy danh sách nhân viên
            $employees = getAllEmployees();
            
            // In danh sách nhân viên
            foreach ($employees as $employee) {
                echo "Mã nhân viên: " . $employee['MaNhanVien'] . "<br>";
                echo "Tên nhân viên: " . $employee['TenNhanVien'] . "<br>";
                echo "Giới tính: " . $employee['GioiTinh'] . "<br>";
                echo "Nơi sinh: " . $employee['NoiSinh'] . "<br>";
                echo "Mã phòng: " . $employee['MaPhong'] . "<br>";
                echo "Lương: " . $employee['Luong'] . "<br><br>";
            }
        }
    }
}
function getGenderImage($gender) {
    if ($gender == 'Nam') {
        return 'images/nam_logo.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính nam
    } elseif ($gender == 'Nu') {
        return 'images/nu_logo.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính nữ
    } else {
        return 'other.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính khác
    }
}
?>

