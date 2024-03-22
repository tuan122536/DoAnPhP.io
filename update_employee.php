<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #4CAF50;
        }
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Kết nối đến cơ sở dữ liệu và truy vấn dữ liệu của nhân viên dựa trên Mã nhân viên
include 'database_operations1.php';
if(isset($_GET['MaNhanVien'])) {
    $MaNhanVien = $_GET['MaNhanVien'];
    $employee = getEmployeeByMaNhanVien($MaNhanVien);
}
?>

<h2>Cập nhật thông tin nhân viên</h2>

<form action="controller.php" method="post">
    <input type="hidden" name="action" value="update">
    <label for="MaNhanVien">Mã nhân viên:</label>
    <input type="text" id="MaNhanVien" name="MaNhanVien" value="<?php echo isset($employee) ? $employee['MaNhanVien'] : ''; ?>" required><br>
    <label for="TenNhanVien">Tên nhân viên:</label>
    <input type="text" id="TenNhanVien" name="TenNhanVien" value="<?php echo isset($employee) ? $employee['TenNhanVien'] : ''; ?>"><br>
    <label for="GioiTinh">Giới tính:</label>
    <input type="text" id="GioiTinh" name="GioiTinh" value="<?php echo isset($employee) ? $employee['GioiTinh'] : ''; ?>"><br>
    <label for="NoiSinh">Nơi sinh:</label>
    <input type="text" id="NoiSinh" name="NoiSinh" value="<?php echo isset($employee) ? $employee['NoiSinh'] : ''; ?>"><br>
    <label for="MaPhong">Mã phòng:</label>
    <input type="text" id="MaPhong" name="MaPhong" value="<?php echo isset($employee) ? $employee['MaPhong'] : ''; ?>"><br>
    <label for="Luong">Lương:</label>
    <input type="number" id="Luong" name="Luong" value="<?php echo isset($employee) ? $employee['Luong'] : ''; ?>"><br>
    <button type="submit">Cập nhật nhân viên</button>
</form>

</body>
</html>

