<?php
// database_operations.php

function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $database = "qlnhansu";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    return $conn;
}

function getAllEmployees() {
    $conn = connectDB();

    $sql = "SELECT * FROM nhanvien";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $conn->close();

    return $data;
}

function addEmployee($MaNhanVien, $TenNhanVien, $GioiTinh, $NoiSinh, $MaPhong, $Luong) {
    $conn = connectDB();

    $sql = "INSERT INTO nhanvien (MaNhanVien, TenNhanVien, GioiTinh, NoiSinh, MaPhong, Luong) VALUES ('$MaNhanVien', '$TenNhanVien', '$GioiTinh', '$NoiSinh', '$MaPhong', $Luong)";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function updateEmployee($MaNhanVien, $TenNhanVien, $GioiTinh, $NoiSinh, $MaPhong, $Luong) {
    $conn = connectDB();

    $sql = "UPDATE nhanvien SET TenNhanVien='$TenNhanVien', GioiTinh='$GioiTinh', NoiSinh='$NoiSinh', MaPhong='$MaPhong', Luong=$Luong WHERE MaNhanVien='$MaNhanVien'";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function deleteEmployee($MaNhanVien) {
    $conn = connectDB();

    $sql = "DELETE FROM nhanvien WHERE MaNhanVien='$MaNhanVien'";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}
function getEmployeeByMaNhanVien($MaNhanVien) {
    $conn = connectDB();

    $sql = "SELECT * FROM nhanvien WHERE MaNhanVien='$MaNhanVien'";
    $result = $conn->query($sql);

    $employee = null;
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    }

    $conn->close();

    return $employee;
}

// database_operations1.php

function deleteEmployeeByMaNhanVien($MaNhanVien) {
    $conn = connectDB();

    // Sử dụng Prepared Statement để tránh tấn công SQL Injection
    $sql = "DELETE FROM nhanvien WHERE MaNhanVien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaNhanVien); // Binds parameters to the SQL query

    $result = $stmt->execute(); // Executes the prepared statement

    $stmt->close();
    $conn->close();

    return $result; // Trả về true nếu xóa thành công, ngược lại trả về false
}
function isLoggedIn($username) {
    $conn = connectDB();

    $sql = "SELECT * FROM taikhoan WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}
function logoutUser() {
    // Bắt đầu phiên làm việc
    session_start();

    // Xóa tất cả các biến phiên
    $_SESSION = array();

    // Hủy phiên
    session_destroy();

    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
    header("Location: login.php");
    exit();
}
function createAccount($username, $password, $email) {
    // Khởi tạo kết nối đến cơ sở dữ liệu
    $conn = connectDB();

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng tài khoản
    $sql = "INSERT INTO taikhoan (Username, Password, Email, LoaiTaiKhoan) VALUES ('$username', '$password', '$email', 'customer')";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if ($conn->query($sql) === TRUE) {
        echo "Tạo tài khoản mới thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
}
// Model
// function registerUser($username, $password, $email) {
//         // Thực hiện thêm tài khoản mới vào cơ sở dữ liệu với loại tài khoản là 'customer'
//         $conn = connectDB();
//         $sql = "INSERT INTO taikhoan (username, password, LoaiTaiKhoan, email) VALUES (?, ?, 'customer', ?)";
//         $stmt = mysqli_prepare($conn, $sql);
//         mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
//         $result = mysqli_stmt_execute($stmt);
//         mysqli_stmt_close($stmt);
//         mysqli_close($conn);

//         return $result;
// }

?>
