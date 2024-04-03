<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AORUS Shop</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link tới file CSS -->
</head>
<?php
include_once 'database_operations1.php'; // Bao gồm file chứa hàm kiểm tra đăng nhập

session_start(); // Bắt đầu phiên đăng nhập

?>
<body>
    <header>
        <h1>AORUS Shop</h1>
        <nav>
            <a href="#">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Products</button>
                <div class="dropdown-content">
                    <a href="#" class="product-link">
                        <div class="image-container">
                            <img src="images/PC_logo.png" alt="PC">
                        </div>
                        <span class="product-text">PC</span>
                    </a>
                    
                    <a href="#" class="product-link">
                        <div class="image-container">
                            <img src="images/product2.jpg" alt="Keyboard">
                        </div>
                        <span class="product-text">Keyboard</span>
                    </a>
                    <a href="#" class="product-link">
                        <div class="image-container">
                            <img src="images/product2.jpg" alt="Keyboard">
                        </div>
                        <span class="product-text">Laptop</span>
                    </a>
                    <a href="#" class="product-link">
                        <div class="image-container">
                            <img src="images/product2.jpg" alt="Keyboard">
                        </div>
                        <span class="product-text">CPU</span>
                    </a>
                    <a href="#" class="product-link">
                        <div class="image-container">
                            <img src="images/product2.jpg" alt="Keyboard">
                        </div>
                        <span class="product-text">VGA</span>
                    </a>
                    <!-- Thêm các sản phẩm khác vào đây -->
                </div>
            </div>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <!-- <button class="login-btn">Login</button> -->
        </nav>
        <div class="user-actions logout-actions">
        <form action="homecustomer.php" method="post" class="logout-form">
            <button type="submit">Đăng xuất</button>
        </form>
    <a href="cart.php" class="cart-icon-btn">Cart</a>
</div>

</form>
    </header>
    <div class="container">
    <div class="product">
    <?php
// Include file chứa hàm từ database_operations1.php
include_once 'database_operations1.php';

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$products = getProducts();

// Kiểm tra nếu không có sản phẩm
if (empty($products)) {
    echo "<p>Không có sản phẩm nào được tìm thấy.</p>";
} else {
    // Hiển thị sản phẩm trong HTML
    foreach ($products as $product) {
        echo '<div class="product">';
        // Kiểm tra xem ảnh có tồn tại không trước khi hiển thị
        if (!empty($product['Image'])) {
            // Đường dẫn tới hình ảnh
            $imageSrc = 'data:image;base64,' . $product['Image'];
            echo '<img src="' . $imageSrc . '" alt="' . $product['Name'] . '">';
        } else {
            // Sử dụng ảnh mặc định nếu không có ảnh
            echo '<img src="images/product_card_aorus.png" alt="' . $product['Name'] . '">';
        }
        echo '<h2>' . $product['Name'] . '</h2>';
        echo '<p>Price: $' . $product['Price'] . '</p>';
        echo '<p>Description: ' . $product['Description'] . '</p>';
        echo '<button>Add to Cart</button>';
        echo '</div>';
    }
}
?>
</div>

        <div class="product">
            <img src="images/keyboard_k7.png" alt="Keyboard AORUS K7">
            <h2>Keyboard AORUS K7</h2>
            <p>Price: $149</p>
            <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <button>Add to Cart</button>
        </div>
        <!-- Repeat the product divs for other products -->
    </div>
    <footer>
        <p>&copy; 2024 AORUS Shop. All rights reserved.</p>
    </footer>
    <script src="script.js"></script> <!-- Link tới file JavaScript -->
</body>
</html>
