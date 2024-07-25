<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Ensure `regno` parameter is set
    if (isset($_GET['regno'])) {
        $regno = $_GET['regno'];

        // Establish a database connection
        $db = dbConn();

        // Find the UserId related to this customer
        $sql = "SELECT UserId FROM customers WHERE RegNo = '$regno'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userId = $user['UserId'];

            // Delete the customer
            $sql = "DELETE FROM customers WHERE RegNo = '$regno'";
            $db->query($sql);

            // Delete the related user
            $sql = "DELETE FROM users WHERE UserId = '$userId'";
            $db->query($sql);

            // Redirect to manage page
            header("Location: manage.php");
            exit; // Ensure no further code is executed
        }
    }
}
?>
