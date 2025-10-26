<?php
include 'header.php'; // New header

// Ensure user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}

$userID = $_SESSION['userID'];
$error = '';
$success = '';

// Check if form is submitted (for updating)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $address = $_POST['Address'];

    if (empty($fname) || empty($lname) || empty($address)) {
        $error = "All fields are required.";
    } else {
        $sql_update = "UPDATE users SET
                            FirstName = '$fname',
                            LastName = '$lname',
                            Address = '$address'
                       WHERE userID = $userID";

        if ($conn->query($sql_update) === TRUE) {
            $success = "Your settings have been updated successfully!";
            $_SESSION['FirstName'] = $fname; // Update session
        } else {
            $error = "Error updating settings: " . $conn->error;
        }
    }
}

// Fetch user's current details
$sql_fetch = "SELECT FirstName, LastName, Address FROM users WHERE userID = $userID";
$result = $conn->query($sql_fetch);
$user = $result->fetch_assoc();
$conn->close();
?>

<div class="form-container-boxed">
    <h2>My Settings</h2>
    <p style="text-align: center; margin-bottom: 20px;">Update your personal information.</p>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="user_settings.php" method="POST">
        <div class="form-group">
            <label for="FirstName">First Name</label>
            <input type="text" name="FirstName" id="FirstName" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>
        </div>
        <div class="form-group">
            <label for="LastName">Last Name</label>
            <input type="text" name="LastName" id="LastName" value="<?php echo htmlspecialchars($user['LastName']); ?>" required>
        </div>
        <div class="form-group">
            <label for="Address">Address</label>
            <input type="text" name="Address" id="Address" value="<?php echo htmlspecialchars($user['Address']); ?>" required>
        </div>
        
        <button type="submit" class="form-btn">Update Settings</button>
    </form>
</div>

<?php
include 'footer.php'; // New footer
?>