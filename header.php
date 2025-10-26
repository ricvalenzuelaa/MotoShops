<?php
// We include db.php here, which also starts the session
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoShop Corporation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <a href="index.php" class="brand-link">
            <span class="main">MotoShop</span>
            <span class="sub">Corporation</span>
        </a>

        <nav class="main-nav">
            <ul class="nav-list">
                <?php if (isset($_SESSION['adminID'])): ?>
                    <li><span class="nav-link-welcome">Welcome, Admin</span></li>
                    <li><a href="admin_panel.php" class="nav-link">Admin Panel</a></li>
                    <li><a href="index.php" class="nav-link">View Site</a></li>
                    <li><a href="logout.php" class="nav-link signin">Logout</a></li>

                <?php elseif (isset($_SESSION['userID'])): ?>
                    <li><span class="nav-link-welcome">Welcome, <?php echo htmlspecialchars($_SESSION['FirstName']); ?></span></li>
                    <li><a href="index.php" class="nav-link">Products</a></li>
                    <li><a href="my_orders.php" class="nav-link">My Orders</a></li>
                    <li><a href="user_settings.php" class="nav-link">Settings</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                    <li><a href="logout.php" class="nav-link signin">Logout</a></li>

                <?php else: ?>
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                    <li><a href="register.php" class="nav-link">Register</a></li>
                    <li><a href="login_choice.php" class="nav-link signin">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main>