<?php
include 'header.php'; // New header

// Ensure user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}
$userID = $_SESSION['userID'];
?>

<div class="container">
    <h2 class="section-title">My Orders</h2>
    
    <div class="table-responsive">
        <table class="order-table"> <thead>
                <tr>
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Order Date</th>
                    <th>Quantity</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.productModel, p.BrandName, o.OrderDate, o.OrderQuantity, o.PaymentMethod, o.OrderStatus
                        FROM orders o
                        JOIN products p ON o.productID = p.productID
                        WHERE o.userID = $userID
                        ORDER BY o.OrderDate DESC";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['productModel']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['BrandName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['OrderDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['OrderQuantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PaymentMethod']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['OrderStatus']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>You have not placed any orders yet.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'footer.php'; // New footer
?>