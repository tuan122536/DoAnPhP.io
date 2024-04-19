<?php
session_start();
include 'database_operations1.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['userID'])) {
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['userID']; 
$cartItems = getCartItems($userId);
$totalPrice = 0;
$totalItems = 0;

if (!empty($cartItems)) {
    foreach ($cartItems as $item) {
        $totalItems += $item['quantity'];
        $totalPrice += $item['quantity'] * $item['price'];
    }
} else {
    $emptyCart = true; 
}


if (isset($_POST['delete'])) {
    if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        $deleteSuccess = deleteCartItem($userId, $productId); // Gọi hàm xóa
        if ($deleteSuccess) {
            echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng.');</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi xóa sản phẩm.');</script>";
        }
    } else {
        echo "<script>alert('ID sản phẩm không hợp lệ.');</script>";
    }
}

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

$cartItems = getCartItems($userId);
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<style>
    header {
    background-color: rgba(0, 0, 0, 0.6); /* Màu nền đen với độ trong suốt 0.6 */
    color: #fff; /* Màu chữ trắng */
    padding: 10px; /* Khoảng cách giữa nội dung và viền */
    text-align: center; /* Căn giữa nội dung */
    background-size: cover; /* Chỉnh kích thước background */
    background-position: top; /* Vị trí của background */
    background-repeat: no-repeat; /* Không lặp lại background */
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-size: cover;
    background-position: top;
    background-repeat: no-repeat;
    transition: background-image 1s ease; /* Thêm hiệu ứng trượt mượt */
}
</style>
<header>
    <h1>AORUS Shop</h1>
    <nav>
        <h2><a href="home.php" style="text-decoration: none; color: inherit;">Home</a></h2>
        <span>Welcome, <?php echo htmlspecialchars($userName); ?> !</span>
    </nav>
</header>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
            background-image: url('images/background_amd.jpg');
        }

        .cart-container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Make background semi-transparent */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); /* Apply blur effect to the background behind the container */
            -webkit-backdrop-filter: blur(10px); /* For Safari compatibility */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            background-color: rgba(255, 255, 255, 0.8);
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .cart-summary {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #clear-cart-btn {
            background-color: #dc3545;
        }

        #clear-cart-btn:hover {
            background-color: #c82333;
        }
</style>
<body>
    <div class="cart-container">
        <h1>Giỏ hàng</h1>
        <table>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
            <?php
            if (empty($cartItems)) {
                // Hiển thị thông báo nếu giỏ hàng trống
                echo "<tr><td colspan='4'>Giỏ hàng trống</td></tr>";
            } else {
                // Lặp qua từng mục trong giỏ hàng và hiển thị
                foreach ($cartItems as $item) {
                    echo "<tr>";
                    echo "<td>{$item['productName']}</td>";
                    echo "<td>{$item['quantity']}</td>";
                    echo "<td>\${$item['price']}</td>";
                    echo "<td>";
                    echo "<form method='post' action='delete_item.php'>";
                    echo "<input type='hidden' name='product_id' value='{$item['productId']}' />";
                    echo "<button type='submit' name='delete'>Xóa</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                
            }
        ?>
        </table>

        <div class="cart-summary">
            <h2>Tổng kết</h2>
            <p>Tổng sản phẩm: <?php echo $totalItems; ?></p>
            <p>Tổng tiền: $<?php echo number_format($totalPrice, 2); ?></p>
            <button id="clear-cart-btn">Xóa toàn bộ</button>
            <button id="checkout-btn">Thanh toán</button>
        </div>
    </div>
</body>
</html>
