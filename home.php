<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AORUS Shop</title>
    <link rel="stylesheet" href="styles.css">
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
    <a href="cart.html" class="cart-icon-btn">Cart</a>
</div>
</form>
    </header>
    <div class="container">
    <div class="product-container">
    
</div>
</div>
    </div>
    <footer>
        <p>&copy; 2024 AORUS Shop. All rights reserved.</p>
    </footer>
    <script src="script.js"></script> <!-- Link tới file JavaScript -->
</body>
</html>
