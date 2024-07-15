<?php
ob_start();                    //multiple header error remove
include 'header2.php';
include '../function.php';

// Include database connection
include 'db.php';

// Initialize message variables
$changePasswordMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = dataClean($_POST['current_password']);
    $new_password = dataClean($_POST['new_password']);
    $retype_password = dataClean($_POST['retype_password']);

    // Fetch the current password from the database
    $conn = dbConn();
    $sql = "SELECT password FROM customers WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['customer_id']);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current_password, $db_password)) {
        if ($new_password == $retype_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE customers SET password = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $hashed_password, $_SESSION['customer_id']);
            if ($stmt->execute()) {
                $changePasswordMessage = "Password successfully updated.";
            } else {
                $changePasswordMessage = "Error updating password.";
            }
            $stmt->close();
        } else {
            $changePasswordMessage = "New passwords do not match.";
        }
    } else {
        $changePasswordMessage = "Current password is incorrect.";
    }
}
?>
?>
<main id="main">
    <div class="container mt-5 py-5">
        <div class="card card-profile-manage mb-3 my-5 border mx-auto">
            <div class="card-header card-header bg-dark-black text-light-yellow">
                Change Login Information
            </div>
            <div class="card-body">
                <p class="text-center text-success"><?= $changePasswordMessage; ?></p>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="retype_password" class="form-label">Re-type New Password</label>
                        <input type="password" class="form-control" id="retype_password" name="retype_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="forgot_password.php" class="btn btn-link">Forgot Password</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include 'footer.php';
ob_end_flush();
?>
