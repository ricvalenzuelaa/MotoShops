<?php
include 'header.php'; // New header

// Redirect if already logged in
if (isset($_SESSION['userID']) || isset($_SESSION['adminID'])) {
    header('Location: index.php');
    exit;
}
?>

<div class="form-container-boxed">
    <h2>Login As</h2>
    <p style="text-align: center; margin-bottom: 30px;">Please select your login type.</p>

    <a href="login.php" class="form-btn">User Login</a>
    <a href="admin_login.php" class="form-btn">Admin Login</a>
    
    <a href="register.php" class="form-link">Don't have an account? Sign up</a>
</div>

<?php
include 'footer.php'; // New footer
?>