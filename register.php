<?php
include 'database_operations1.php';

// Khởi tạo biến thông báo lỗi
$usernameExistsMessage = "";
$emailExistsMessage = "";

// Kiểm tra khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['register-username'];
    $password = $_POST['register-password'];
    $email = $_POST['register-email'];

    // Kiểm tra xem tên người dùng và email đã tồn tại trong cơ sở dữ liệu chưa
    if (isUsernameExists($username)) {
        $usernameExistsMessage = "Tên người dùng đã tồn tại. Vui lòng chọn tên người dùng khác!";
    }
    if (isEmailExists($email)) {
        $emailExistsMessage = "Email đã được sử dụng. Vui lòng sử dụng email khác!";
    }

    // Nếu không có lỗi, tạo tài khoản mới và hiển thị thông báo thành công
    if (empty($usernameExistsMessage) && empty($emailExistsMessage)) {
        createAccount($username, $password, $email);
        // Hiển thị thông báo tài khoản đã được tạo thành công
        echo "Tài khoản đã được tạo thành công!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #20121a;
            margin: 0;
            padding: 0;
            background-image: url('images/background_phongstream.jpg'); /* Đường dẫn đến hình nền */
            background-size: cover; /* Chỉnh kích thước background */
            background-position: center; /* Căn giữa */
            background-repeat: no-repeat; /* Không lặp lại */
        }
        header {
            background-color: rgba(0, 0, 0, 0.5); /* Màu đen với độ trong suốt 0.5 */
            color: white;
            padding: 20px;
            text-align: center;
        }
        form {
        background-color: rgba(255, 255, 255, 0.8); /* Màu trắng với độ trong suốt 0.8 */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
        max-width: 400px; /* Độ rộng tối đa của form */
        width: 100%; /* Chiều rộng của form */
        margin: 0 auto; /* Căn giữa theo chiều ngang */
        }   

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type = "email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>
<header>
        <h1>Welcom, InfinityShop !</h1>
    </header>
    
    <!-- Form đăng ký -->
    <form id="register-form" action="register.php" method="post">
        <label for="register-username">Tên người dùng:</label>
        <input type="text" id="register-username" name="register-username" required><br>
        <?php if (!empty($usernameExistsMessage)) { ?>
            <span style="color: red;"><?php echo $usernameExistsMessage; ?></span><br>
        <?php } ?>
        <label for="register-password">Mật khẩu:</label>
        <input type="password" id="register-password" name="register-password" required><br>
        <label for="register-email">Email:</label>
        <input type="email" id="register-email" name="register-email" required><br>
        <?php if (!empty($emailExistsMessage)) { ?>
            <span style="color: red;"><?php echo $emailExistsMessage; ?></span><br>
        <?php } ?>
        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
