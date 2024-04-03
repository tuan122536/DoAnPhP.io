<?php
// database_operations1.php

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
    $sql = "INSERT INTO users (Username, Password, Email, UserType) VALUES ('$username', '$password', '$email', 'customer')";

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
function isUsernameExists($username) {
    // Kết nối đến cơ sở dữ liệu
    $conn = connectDB();

    // Truy vấn SQL kiểm tra username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra số lượng bản ghi trả về
    $count = mysqli_num_rows($result);

    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($conn);

    // Nếu tồn tại ít nhất một bản ghi, username đã tồn tại
    return $count > 0;
}

// Hàm kiểm tra xem email đã tồn tại hay chưa
function isEmailExists($email) {
    // Kết nối đến cơ sở dữ liệu
    $conn = connectDB();

    // Truy vấn SQL kiểm tra email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra số lượng bản ghi trả về
    $count = mysqli_num_rows($result);

    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($conn);

    // Nếu tồn tại ít nhất một bản ghi, email đã tồn tại
    return $count > 0;
}
function getProducts() {
    // Kết nối tới cơ sở dữ liệu
    $conn = connectDB();

    // Truy vấn để lấy danh sách sản phẩm
    $sql = "SELECT * FROM Products";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra xem có sản phẩm nào được tìm thấy không
    if ($result && mysqli_num_rows($result) > 0) {
        $products = array();
        // Lấy danh sách sản phẩm từ kết quả truy vấn
        while ($row = mysqli_fetch_assoc($result)) {
            // Kiểm tra nếu cột Image không trống
            // if (!empty($row['Image'])) {
            //     // Chuyển dữ liệu ảnh sang chuỗi base64
            //     $imageData = base64_encode($row['Image']);
            // } else {
            //     // Gán cho imageData là chuỗi rỗng nếu cột Image trống
            //     $imageData = '';
            // }
            // Thêm thông tin sản phẩm vào mảng products bao gồm ảnh mã hóa base64
            $products[] = array(
                'ProductID' => $row['ProductID'],
                'Name' => $row['Name'],
                'Description' => $row['Description'],
                'Price' => $row['Price'],
                'Quantity' => $row['Quantity'],
                'Image' => $row['Image'], // Lưu dữ liệu ảnh dưới dạng base64 hoặc chuỗi rỗng
                'CategoryID' => $row['CategoryID']
            );
        }
        // Đóng kết nối
        mysqli_close($conn);
        return $products;
    } else {
        // Đóng kết nối
        mysqli_close($conn);
        return array(); // Trả về một mảng rỗng nếu không tìm thấy sản phẩm hoặc có lỗi xảy ra
    }
}
?>
