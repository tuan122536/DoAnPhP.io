<?php
session_start(); 

if (!isset($_SESSION['UserID'])) {
    
    header("Location: login.php");
    exit; // Dừng thực thi script hiện tại
}

?>
