<?php
// This page processes the order and redirects
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}

// MODIFIED: Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_SESSION['userID'];
    $productID = $_POST['productID'];
    $quantity = $_POST['OrderQuantity'];
    $paymentMethod = $_POST['PaymentMethod']; // NEW: Get Payment Method
    
    $orderDate = date('Y-m-d'); // Current date
    $orderStatus = 'Pending'; // Default status

    // Simple validation
    if (empty($productID) || empty($quantity) || $quantity < 1 || empty($paymentMethod)) { // NEW
        echo "Invalid order data. Please fill out all fields.";
        exit;
    }

    // INSECURE SQL query to insert the order (with PaymentMethod)
    $sql = "INSERT INTO orders (userID, productID, OrderQuantity, OrderDate, PaymentMethod, OrderStatus)
            VALUES ($userID, $productID, $quantity, '$orderDate', '$paymentMethod', '$orderStatus')";

    if ($conn->query($sql) === TRUE) {
        // Order placed successfully, redirect to "My Orders" page
        header('Location: my_orders.php');
        exit;
    } else {
        echo "Error placing order: " . $conn->error;
    }
} else {
    // No form data posted
    header('Location: index.php');
}

$conn->close();
?>