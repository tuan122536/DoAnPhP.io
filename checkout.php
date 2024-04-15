<?php
session_start(); // Khởi động session

// Kiểm tra xem đã có dữ liệu giỏ hàng trong session chưa
if (!isset($_SESSION['total_items']) || !isset($_SESSION['total_price'])) {
    echo "Không tìm thấy thông tin giỏ hàng. Vui lòng thử lại.";
    exit;
}

$totalItems = $_SESSION['total_items'];
$totalPrice = $_SESSION['total_price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Thanh toán</h1>
        <form action="place_order.php" method="post">
            <p>Số mặt hàng: <?= $totalItems ?></p>
            <p>Tổng tiền: $<?= $totalPrice ?></p>
            
            <label for="address">Địa chỉ giao hàng:</label>
            <input type="text" id="address" name="address" required>

            <label for="payment-method">Phương thức thanh toán:</label>
            <select id="payment-method" name="payment_method" required>
                <option value="cash">Tiền mặt</option>
                <option value="credit_card">Thẻ tín dụng</option>
                <option value="paypal">PayPal</option>
            </select>

            <button type="submit">Đặt hàng</button>
        </form>
    </div>
</body>
</html>
