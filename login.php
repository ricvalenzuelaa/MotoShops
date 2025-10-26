<?php
include 'header.php'; // New header
$error = '';

// Redirect if already logged in
if (isset($_SESSION['userID']) || isset($_SESSION['adminID'])) {
    header('Location: index.php');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $pass = $_POST['Password']; // Checking plain text password

    if (empty($email) || empty($pass)) {
        $error = "Email and Password are required.";
    } else {
        // INSECURE SQL query to find user
        $sql = "SELECT * FROM users WHERE Email = '$email' AND Password = '$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['FirstName'] = $user['FirstName'];

            $logSql = "INSERT INTO login (Email, loginDate, loginTime) VALUES ('$email', CURDATE(), CURTIME())";
            $conn->query($logSql);

            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid Email or Password.";
        }
    }
    $conn->close();
}
?>

<div class="form-container-boxed">
    <h2>User Login</h2>
    <p style="text-align: center; margin-bottom: 20px;">Enter your account details</p>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" name="Password" id="Password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="form-btn">Submit</button>
    </form>

    <a href="register.php" class="form-link">Don't have an account? Sign up</a>
</div>

<?php
include 'footer.php'; // New footer
?>