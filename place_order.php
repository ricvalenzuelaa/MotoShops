<?php
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}

// Check if product_id is provided
if (!isset($_GET['product_id'])) {
    echo "<div class='container'><p class='error'>No product selected.</p></div>";
    include 'footer.php';
    exit;
}

$productID = $_GET['product_id'];

// Fetch product details, including Price
$sql = "SELECT productModel, BrandName, Price FROM products WHERE productID = $productID";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<div class='container'><p class='error'>Product not found.</p></div>";
    include 'footer.php';
    exit;
}

$product = $result->fetch_assoc();
?>

<div class="container">
    <div class="form-container">
        <h2>Place Your Order</h2>
        
        <h3>Product: <?php echo $product['BrandName'] . " " . $product['productModel']; ?></h3>
        <h4 style="color: #0056b3; margin-bottom: 20px;">
            Price: <?php echo "₱ " . number_format($product['Price'], 2); ?>
        </h4>
        
        <form action="order.php" method="POST">
            <input type="hidden" name="productID" value="<?php echo $productID; ?>">
            
            <div class="form-group">
                <label for="OrderQuantity">Quantity</label>
                <input type="number" name="OrderQuantity" id="OrderQuantity" value="1" min="1" required>
            </div>

            <div class="form-group">
                <label for="PaymentMethod">Payment Method</label>
                <select name="PaymentMethod" id="PaymentMethod" required>
                    <option value="">-- Select a Payment Method --</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Credit Card or Debit Card">Credit Card or Debit Card</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Other Online Banking">Other Online Banking</option>
                </select>
            </div>
            
            <button type="submit" class="form-btn">Submit Order</button>
        </form>
    </div>
</div>

<?php
$conn->close();
include 'footer.php';
?>