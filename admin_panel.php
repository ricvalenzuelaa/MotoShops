<?php
include 'header.php';

// Ensure admin is logged in
if (!isset($_SESSION['adminID'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<style>
    body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #e6f0ff, #f9fcff);
    margin: 0;
    padding: 0;
    }

    .two-column-wrapper {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 20px;
    margin: 20px;
    align-items: start;
    }

    .sidebar {
    background: #0a1a2f;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    height: ;
    }

    .sidebar h3 {
    margin-bottom: 15px;
    text-align: center;
    font-size: 1.3rem;
    }

    .sidebar a {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    background: #1e3d70;
    text-align: center;
    transition: 0.3s;
    }

    .sidebar a:hover {
    background: #355fa8;
    }

.main-content {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 25px;
}

table, th, td {
  border: 1px solid #ccc;
}

th, td {
  padding: 10px;
  text-align: left;
}

th {
  background: #f1f1f1;
}

.status-Pending { color: orange; font-weight: bold; }
.status-Processing { color: blue; font-weight: bold; }
.status-On-Delivery { color: purple; font-weight: bold; }
.status-Delivered { color: green; font-weight: bold; }

.form-btn {
  background: #0a66c2;
  color: #fff;
  padding: 8px 15px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-block;
}

.form-btn:hover {
  background: #084a8b;
}

@media (max-width: 768px) {
  .two-column-wrapper {
    grid-template-columns: 1fr;
  }
}
</style>

<div class="two-column-wrapper">
  <!-- Sidebar -->
  <aside class="sidebar">
    <h3>Admin Menu</h3>
    <a href="admin_panel.php">Dashboard</a>
    <a href="#orders">Customer Orders</a>
    <a href="#products">Products</a>
    <a href="#logins">Login History</a>
    <a href="logout.php">Logout</a>
  </aside>

  <!-- Main Content -->
  <section class="main-content">
    <h2>Admin Panel</h2>

    <!-- Customer Orders -->
    <h3 id="orders">Customer Orders</h3>

    <?php if (isset($_GET['status_success'])): ?>
      <p style="color: green; background: #e0ffe0; padding: 10px; border: 1px solid green;">
        Order status updated successfully!
      </p>
    <?php endif; ?>

    <div style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Address</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Payment Method</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Update Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_orders = "
            SELECT o.OrderID, u.FirstName, u.LastName, u.Email, u.Address,
                   p.productModel, o.OrderQuantity, o.PaymentMethod, o.OrderDate, o.OrderStatus
            FROM orders o
            JOIN users u ON o.userID = u.userID
            JOIN products p ON o.productID = p.productID
            ORDER BY o.OrderDate DESC";

          $result_orders = $conn->query($sql_orders);

          if ($result_orders->num_rows > 0):
              while ($row = $result_orders->fetch_assoc()):
                  $status_class = "status-" . str_replace(' ', '-', $row['OrderStatus']);
          ?>
          <tr>
            <td><?= $row['OrderID'] ?></td>
            <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Address'] ?></td>
            <td><?= $row['productModel'] ?></td>
            <td><?= $row['OrderQuantity'] ?></td>
            <td><?= $row['PaymentMethod'] ?></td>
            <td><?= $row['OrderDate'] ?></td>
            <td class="<?= $status_class ?>"><?= $row['OrderStatus'] ?></td>
            <td>
              <form action="update_status.php" method="POST" class="status-form">
                <input type="hidden" name="OrderID" value="<?= $row['OrderID'] ?>">
                <select name="OrderStatus">
                  <option value="Pending" <?= $row['OrderStatus']=='Pending'?'selected':'' ?>>Pending</option>
                  <option value="Processing" <?= $row['OrderStatus']=='Processing'?'selected':'' ?>>Processing</option>
                  <option value="On Delivery" <?= $row['OrderStatus']=='On Delivery'?'selected':'' ?>>On Delivery</option>
                  <option value="Delivered" <?= $row['OrderStatus']=='Delivered'?'selected':'' ?>>Delivered</option>
                </select>
                <button type="submit">Save</button>
              </form>
            </td>
          </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="10">No orders found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <hr style="margin:30px 0;">

    <!-- Product Management -->
    <h3 id="products">Product Management</h3>
    <a href="add_product.php" class="form-btn">Add New Product</a>

    <div style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_products = "SELECT * FROM products ORDER BY productID ASC";
          $result_products = $conn->query($sql_products);

          if ($result_products->num_rows > 0):
              while ($row = $result_products->fetch_assoc()):
          ?>
          <tr>
            <td><?= $row['productID'] ?></td>
            <td><?= $row['productimage'] ?></td>
            <td><?= $row['BrandName'] ?></td>
            <td><?= $row['productModel'] ?></td>
            <td>₱ <?= number_format($row['Price'], 2) ?></td>
            <td><?= substr($row['productDescription'], 0, 50) ?>...</td>
            <td>
              <a href="edit_product.php?product_id=<?= $row['productID'] ?>" style="color:blue;">Edit</a> |
              <a href="delete_product.php?product_id=<?= $row['productID'] ?>" 
                 onclick="return confirm('Are you sure you want to delete this product AND all associated orders?');"
                 style="color:red;">Delete</a>
            </td>
          </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="7">No products found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <hr style="margin:30px 0;">

    <!-- Login History -->
    <h3 id="logins">User Login History</h3>
    <div style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th>Email</th>
            <th>Login Date</th>
            <th>Login Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_logins = "SELECT * FROM login ORDER BY loginDate DESC, loginTime DESC LIMIT 50";
          $result_logins = $conn->query($sql_logins);

          if ($result_logins->num_rows > 0):
              while ($row = $result_logins->fetch_assoc()):
          ?>
          <tr>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['loginDate'] ?></td>
            <td><?= $row['loginTime'] ?></td>
          </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="3">No login history found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
</div>

<?php
$conn->close();
include 'footer.php';
?>
