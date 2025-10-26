<?php
include 'db.php';

// Ensure admin is logged in
if (!isset($_SESSION['adminID'])) {
    header('Location: admin_login.php');
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // GET DATA (INSECURELY)
    $orderID = $_POST['OrderID'];
    $newStatus = $_POST['OrderStatus'];

    // List of allowed statuses
    $allowed_statuses = ['Pending', 'Processing', 'On Delivery', 'Delivered'];

    // Check if all data is present and status is valid
    if (!empty($orderID) && in_array($newStatus, $allowed_statuses)) {
        
        // INSECURE SQL query to update the status
        $sql = "UPDATE orders SET OrderStatus = '$newStatus' WHERE OrderID = $orderID";

        if ($conn->query($sql) === TRUE) {
            // Success! Redirect back to admin panel with a success message
            header('Location: admin_panel.php?status_success=1');
            exit;
        } else {
            // DB error
            echo "Error updating status: " . $conn->error;
        }
    } else {
        // Invalid data
        echo "Invalid data provided.";
    }
} else {
    // Redirect if not a POST request
    header('Location: admin_panel.php');
    exit;
}

$conn->close();
?>