<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index</title>
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
        echo '<table border="1">';
        echo '<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Giới tính</th><th>Nơi sinh</th><th>Mã phòng</th><th>Lương</th></tr>';
        foreach ($employees as $employee) {
            echo '<tr>';
            //echo '<td>' . $employee['id'] . '</td>';
            echo '<td>' . $employee['MaNhanVien'] . '</td>';
            echo '<td>' . $employee['TenNhanVien'] . '</td>';
            echo '<td><img src="' . getGenderImage($employee['GioiTinh']) . '" alt="' . $employee['GioiTinh'] . '" width="50" height="50"></td>';
            echo '<td>' . $employee['NoiSinh'] . '</td>';
            echo '<td>' . $employee['MaPhong'] . '</td>';
            echo '<td>' . $employee['Luong'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Không có nhân viên nào.';
    }
    ?>
</body>
</html>