<?php
include 'header.php';
$error = '';

// Redirect if already logged in as admin
if (isset($_SESSION['adminID'])) {
    header('Location: admin_panel.php');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminID = $_POST['adminID'];
    $pass = $_POST['password']; // Checking plain text password

    // INSECURE SQL query
    $sql = "SELECT * FROM admins WHERE adminID = '$adminID' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Admin found
        $admin = $result->fetch_assoc();

        // Set session variable
        $_SESSION['adminID'] = $admin['adminID'];

        // Redirect to admin panel
        header('Location: admin_panel.php');
        exit;
    } else {
        // Admin not found
        $error = "Invalid Admin ID or Password.";
    }
    $conn->close();
}
?>

<div class="container">
    <div class="form-container">
        <h2>Admin Login</h2>
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="admin_login.php" method="POST">
            <div class="form-group">
                <label for="adminID">Admin ID</label>
                <input type="text" name="adminID" id="adminID" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="form-btn">Admin Login</button>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>