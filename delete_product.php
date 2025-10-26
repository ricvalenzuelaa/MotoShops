<?php
include 'db.php';

// Ensure admin is logged in
if (!isset($_SESSION['adminID'])) {
    header('Location: admin_login.php');
    exit;
}

// Check if product_id is provided
if (!isset($_GET['product_id'])) {
    header('Location: admin_panel.php');
    exit;
}

$productID = $_GET['product_id'];

// 1. Delete associated orders first (to satisfy foreign key constraint)
// This is destructive! In a real app, you might archive or disallow this.
$sql_delete_orders = "DELETE FROM orders WHERE productID = $productID";
if ($conn->query($sql_delete_orders) === FALSE) {
    echo "Error deleting associated orders: " . $conn->error;
    exit;
}

// 2. Delete the product
$sql_delete_product = "DELETE FROM products WHERE productID = $productID";
if ($conn->query($sql_delete_product) === TRUE) {
    // Success, redirect back to admin panel
    header('Location: admin_panel.php');
    exit;
} else {
    echo "Error deleting product: " . $conn->error;
}

$conn->close();
?>