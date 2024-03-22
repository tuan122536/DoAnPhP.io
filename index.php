<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 250px;
            padding: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        img {
            display: block;
            margin: auto;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Quản lý nhân viên</h1>

    <!-- Form thêm nhân viên -->
    <h2>Thêm nhân viên mới</h2>
    <form action="controller.php" method="post">
        <input type="hidden" name="action" value="add">
        <label for="MaNhanVien">Mã nhân viên:</label><br>
        <input type="text" id="MaNhanVien" name="MaNhanVien" required><br><br>
        
        <label for="TenNhanVien">Tên nhân viên:</label><br>
        <input type="text" id="TenNhanVien" name="TenNhanVien" required><br><br>
        
        <label for="GioiTinh">Giới tính:</label><br>
        <select id="GioiTinh" name="GioiTinh" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>
        
        <label for="NoiSinh">Nơi sinh:</label><br>
        <input type="text" id="NoiSinh" name="NoiSinh"><br><br>
        
        <label for="MaPhong">Mã phòng:</label><br>
        <input type="text" id="MaPhong" name="MaPhong"><br><br>
        
        <label for="Luong">Lương:</label><br>
        <input type="number" id="Luong" name="Luong" min="0" required><br><br>
        
        <button type="submit">Thêm nhân viên</button>
    </form>

    <h2>Danh sách nhân viên</h2>
    <?php
    // Include tệp xử lý cơ sở dữ liệu
    include 'database_operations1.php';

    // Lấy danh sách nhân viên từ cơ sở dữ liệu
    $employees = getAllEmployees();
    function getGenderImage($gender) {
        if ($gender == 'Nam') {
            return 'images/nam_logo.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính nam
        } elseif ($gender == 'Nu') {
            return 'images/nu_logo.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính nữ
        } else {
            return 'other.png'; // Đường dẫn tới hình ảnh biểu tượng giới tính khác
        }
    }
    // Kiểm tra nếu danh sách không trống
    if (count($employees) > 0) {
        echo '<table>';
        echo '<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Giới tính</th><th>Nơi sinh</th><th>Mã phòng</th><th>Lương</th><th>Thao tác</th></tr>';
        foreach ($employees as $employee) {
            echo '<tr>';
            echo '<td>' . $employee['MaNhanVien'] . '</td>';
            echo '<td>' . $employee['TenNhanVien'] . '</td>';
            echo '<td><img src="' . getGenderImage($employee['GioiTinh']) . '" alt="' . $employee['GioiTinh'] . '"></td>';
            echo '<td>' . $employee['NoiSinh'] . '</td>';
            echo '<td>' . $employee['MaPhong'] . '</td>';
            echo '<td>' . $employee['Luong'] . '</td>';
            echo '<td><a href="update_employee.php?MaNhanVien=' . $employee['MaNhanVien'] . '">Cập nhật</a> | <a href="delete_employee.php?MaNhanVien=' . $employee['MaNhanVien'] . '">Xóa</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Không có nhân viên nào.';
    }
    ?>
    <form action="logout.php" method="post">
        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>
