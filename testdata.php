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
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
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