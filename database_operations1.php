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
?>
