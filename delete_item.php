<?php
session_start();
require 'database_operations1.php';  

if (isset($_POST['delete']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['userID'];  


    if (deleteCartItem($userId, $productId)) {
        header("Location: cart.php?status=success");  
    } else {
        header("Location: cart.php?status=error"); 
    }
    exit;
}
?>
