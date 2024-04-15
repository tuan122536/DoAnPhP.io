<?php
session_start();
include 'database_operations1.php';
//include 'config.php';  // Đảm bảo bạn đã kết nối CSDL và có biến $conn

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['userID']; // Giả sử bạn đã lưu userID vào session khi đăng nhập

    if (addCartItem($userId, $productId, $quantity)) {
        header("Location: cart.php?status=success");
        echo "Sản phẩm đã được thêm vào giỏ hàng.";
    } else {
        echo "Không thể thêm sản phẩm vào giỏ hàng.";
    }
}

function addCartItem($userId, $productId, $quantity) {
    $conn = connectDB();
    if (!$conn) {
        return false; // Xử lý lỗi kết nối
    }

    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $sql = "SELECT quantity FROM cart_items WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Cập nhật số lượng nếu sản phẩm đã tồn tại
        $newQuantity = $row['quantity'] + $quantity;
        $sqlUpdate = "UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("iii", $newQuantity, $userId, $productId);
        $updateResult = $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // Thêm mới sản phẩm vào giỏ hàng
        $sqlInsert = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("iii", $userId, $productId, $quantity);
        $updateResult = $stmtInsert->execute();
        $stmtInsert->close();
    }
    $conn->close();
    return $updateResult;
}
?>
