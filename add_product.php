<?php
include 'header.php';

// Ensure admin is logged in
if (!isset($_SESSION['adminID'])) {
    header('Location: admin_login.php');
    exit;
}

$error = '';
$success = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // GET DATA (INSECURELY)
    $model = $_POST['productModel'];
    $brand = $_POST['BrandName'];
    $price = $_POST['Price']; // NEW
    $desc = $_POST['productDescription'];
    $image = $_POST['productimage'];

    if (empty($model) || empty($brand) || empty($image) || empty($price)) {
        $error = "Model, Brand, Price, and Image Filename are required.";
    } else {
        // INSECURE SQL query with Price
        $sql = "INSERT INTO products (productModel, BrandName, Price, productDescription, productimage) 
                VALUES ('$model', '$brand', $price, '$desc', '$image')";

        if ($conn->query($sql) === TRUE) {
            $success = "Product added successfully! <a href='admin_panel.php'>Return to Admin Panel</a>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<div class="container">
    <div class="form-container">
        <h2>Add New Product</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green; background: #e0ffe0; padding: 10px; border: 1px solid green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <?php if (!$success): ?>
        <form action="add_product.php" method="POST">
            <div class="form-group">
                <label for="BrandName">Brand Name</label>
                <input type="text" name="BrandName" id="BrandName" required>
            </div>
            <div class="form-group">
                <label for="productModel">Product Model</label>
                <input type="text" name="productModel" id="productModel" required>
            </div>
            <!-- NEW: Price Field -->
            <div class="form-group">
                <label for="Price">Price (in PHP, numbers only)</label>
                <input type="number" step="0.01" name="Price" id="Price" required>
            </div>
             <div class="form-group">
                <label for="productimage">Image Filename (e.g., Kz1000r.webp)</label>
                <input type="text" name="productimage" id="productimage" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea name="productDescription" id="productDescription" rows="5" style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            </div>
            <button type="submit" class="form-btn">Add Product</button>
        </form>
        <?php endif; ?>
    </div>
</div>

<?php
$conn->close();
include 'footer.php';
?>