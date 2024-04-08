<?php
// Bao gồm tệp database-operation.php
include_once 'database_operations1.php';

// Gọi hàm để lấy dữ liệu sản phẩm từ cơ sở dữ liệu
$products = getProductsToAjax();

// Trả về dữ liệu dưới dạng JSON
echo json_encode($products);
?>
