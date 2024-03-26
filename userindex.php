<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h1>Danh sách nhân viên</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu và lấy danh sách nhân viên
    include 'database_operations1.php';
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
    // Kiểm tra xem có dữ liệu nhân viên hay không
    if (count($employees) > 0) {
        echo '<table>';
        echo '<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Giới tính</th><th>Nơi sinh</th><th>Mã phòng</th><th>Lương</th></tr>';
        foreach ($employees as $employee) {
            echo '<tr>';
            echo '<td>' . $employee['MaNhanVien'] . '</td>';
            echo '<td>' . $employee['TenNhanVien'] . '</td>';
            echo '<td><img src="' . getGenderImage($employee['GioiTinh']) . '" alt="' . $employee['GioiTinh'] . '"></td>';
            echo '<td>' . $employee['NoiSinh'] . '</td>';
            echo '<td>' . $employee['MaPhong'] . '</td>';
            echo '<td>' . $employee['Luong'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p style="text-align: center; margin-top: 20px;">Không có nhân viên nào.</p>';
    }
    ?>
</body>
</html>
