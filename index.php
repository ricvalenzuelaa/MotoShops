<?php
include 'header.php'; // Includes new header

// --- Sorting Logic ---
$sort_option = "BrandName ASC"; // Default sort
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'brand_asc':
            $sort_option = "BrandName ASC";
            break;
        case 'price_asc':
            $sort_option = "Price ASC";
            break;
        case 'price_desc':
            $sort_option = "Price DESC";
            break;
        default:
            $sort_option = "BrandName ASC";
    }
}

// --- NEW: Brand Filter Logic ---
$where_clause = ""; // This will be empty if "All Brands" is selected
$selected_brand = "all"; // Default
if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand']) && $_GET['filter_brand'] != 'all') {
    $selected_brand = $_GET['filter_brand'];
    // NO SECURITY per your request
    $where_clause = " WHERE BrandName = '$selected_brand'";
}

// --- NEW: Fetch all distinct brands for the filter dropdown ---
$brands_sql = "SELECT DISTINCT BrandName FROM products ORDER BY BrandName ASC";
$brands_result = $conn->query($brands_sql);

?>

<section class="hero">
    <div class="hero-content">
        <h1>Ride the Future of Motorcycles</h1>
        <p>Explore our exclusive lineup. Power. Style. Freedom.</p>
        <a href="#products" class="btn-primary">Browse Models</a>
    </div>
</section>

<section id="products" class="container">
    <h2 class="section-title">Our Products</h2>

    <form action="index.php#products" method="GET" class="sort-form">
        
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="brand_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'brand_asc') ? 'selected' : ''; ?>>Brand (A-Z)</option>
            <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Price (Low to High)</option>
            <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Price (High to Low)</option>
        </select>
        
        <label for="filter_brand">Filter by Brand:</label>
        <select name="filter_brand" id="filter_brand">
            <option value="all">All Brands</option>
            <?php
            // Loop through the brands fetched from the database
            if ($brands_result->num_rows > 0) {
                while ($brand_row = $brands_result->fetch_assoc()) {
                    $brand_name = htmlspecialchars($brand_row['BrandName']);
                    // Keep the brand selected after form submission
                    $is_selected = ($selected_brand == $brand_name) ? 'selected' : '';
                    echo "<option value=\"$brand_name\" $is_selected>$brand_name</option>";
                }
            }
            ?>
        </select>

        <button type="submit">Apply</button>
    </form>

    <div class="cards">
        <?php
        // MODIFIED: Main product query now includes the WHERE clause
        $sql = "SELECT * FROM products" . $where_clause . " ORDER BY $sort_option";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="card">
                    <img src="images/<?php echo htmlspecialchars($row['productimage']); ?>" alt="<?php echo htmlspecialchars($row['productModel']); ?>">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($row['BrandName']); ?></h3>
                        <h2><?php echo htmlspecialchars($row['productModel']); ?></h2>
                        <h4><?php echo "₱ " . number_format($row['Price'], 2); ?></h4>
                        <p><?php echo htmlspecialchars($row['productDescription']); ?></p>
                        
                        <?php if (isset($_SESSION['userID'])): ?>
                            <a href="place_order.php?product_id=<?php echo $row['productID']; ?>" class="btn-primary">Order Now</a>
                        <?php else: ?>
                            <a href="login_choice.php" class="btn-primary">Login to Order</a>
                        <?php endif; ?>
                    </div>
                </div>
        <?php
            }
        } else {
            // Show a message if no products match the filter
            echo "<p>No products found matching your selection.</p>";
        }
        // Moved $conn->close() to the footer
        ?>
    </div>
</section>

<?php
$conn->close(); // Close connection here
include 'footer.php'; // Includes new footer
?>