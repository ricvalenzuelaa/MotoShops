<?php
include 'header.php';

// Ensure admin is logged in
if (!isset($_SESSION['adminID'])) {
    header('Location: admin_login.php');
    exit;
}

$error = '';
$success = '';

// Check if product_id is provided
if (!isset($_GET['product_id'])) {
    header('Location: admin_panel.php');
    exit;
}
$productID = $_GET['product_id'];


// Check if form is submitted (for updating)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // GET DATA (INSECURELY)
    $model = $_POST['productModel'];
    $brand = $_POST['BrandName'];
    $price = $_POST['Price']; // NEW
    $desc = $_POST['productDescription'];
    $image = $_POST['productimage'];
    $pid = $_POST['productID'];

    if (empty($model) || empty($brand) || empty($image) || empty($price)) {
        $error = "Model, Brand, Price, and Image Filename are required.";
    } else {
        // INSECURE SQL query with Price
        $sql = "UPDATE products SET
                    productModel = '$model',
                    BrandName = '$brand',
                    Price = $price,
                    productDescription = '$desc',
                    productimage = '$image'
                WHERE productID = $pid";

        if ($conn->query($sql) === TRUE) {
            $success = "Product updated successfully! <a href='admin_panel.php'>Return to Admin Panel</a>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}


// Fetch product details to pre-fill the form
$sql_fetch = "SELECT * FROM products WHERE productID = $productID";
$result = $conn->query($sql_fetch);

if ($result->num_rows == 0) {
    echo "<div class='container'><p class='error'>Product not found.</p></div>";
    include 'footer.php';
    exit;
}
$product = $result->fetch_assoc();

?>

<div class="container">
    <div class="form-container">
        <h2>Edit Product (ID: <?php echo $product['productID']; ?>)</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green; background: #e0ffe0; padding: 10px; border: 1px solid green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="edit_product.php?product_id=<?php echo $product['productID']; ?>" method="POST">
            <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
            
            <div class="form-group">
                <label for="BrandName">Brand Name</label>
                <input type="text" name="BrandName" id="BrandName" value="<?php echo $product['BrandName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productModel">Product Model</label>
                <input type="text" name="productModel" id="productModel" value="<?php echo $product['productModel']; ?>" required>
            </div>
            <!-- NEW: Price Field -->
            <div class="form-group">
                <label for="Price">Price (in PHP, numbers only)</label>
                <input type="number" step="0.01" name="Price" id="Price" value="<?php echo $product['Price']; ?>" required>
            </div>
             <div class="form-group">
                <label for="productimage">Image Filename (e.g., Kz1000r.webp)</label>
                <input type="text" name="productimage" id="productimage" value="<?php echo $product['productimage']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea name="productDescription" id="productDescription" rows="5" style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"><?php echo $product['productDescription']; ?></textarea>
            </div>
            <button type="submit" class="form-btn">Update Product</button>
        </form>
    </div>
</div>

<?php
$conn->close();
include 'footer.php';
?>