
<script>
    function redirectToRegister() {
        window.location.href = "register.php"; // Chuyển hướng đến trang đăng ký
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập và Đăng ký</title>
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
        .form-switch {
            text-align: center;
            margin-top: 20px;
        }
        .form-switch a {
            color: #007bff;
            text-decoration: none;
        }
        #register-form {
            display: none;
        }
    /* CSS để đặt nút "Đăng ký" sát phải và trên cùng */
    /* CSS cho button */
        #register-button {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute; /* Thiết lập vị trí tuyệt đối */
            top: 20px; /* Đặt top là 20px từ phía trên */
            right: 20px; /* Đặt right là 20px từ phía phải */
        }

        /* Hover effect */
        button[type="submit"]:hover,
        #register-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcom, InfinityShop !</h1>
    </header>
    
   <!-- Form đăng nhập -->
   <form id="login-form" action="logincontroller.php" method="post">
    <label for="login-username">Tên người dùng:</label>
    <input type="text" id="login-username" name="login-username" required><br>
    <label for="login-password">Mật khẩu:</label>
    <input type="password" id="login-password" name="login-password" required><br>
    <button type="submit">Đăng nhập</button>
    </form>
    <button type="button" id="register-button" onclick="redirectToRegister()">Đăng ký</button>
</body>
</html>

