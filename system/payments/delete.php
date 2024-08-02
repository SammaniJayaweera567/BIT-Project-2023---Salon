<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Extract payment_id from the URL
    extract($_GET);
    
    // Check if payment_id is set and not empty
    if (isset($payment_id) && !empty($payment_id)) {
        $db = dbConn();
        
        // Prepare SQL statement to delete payment
        $sql = "DELETE FROM payments WHERE payment_id = ?";
        
        // Prepare and execute the statement
        if ($stmt = $db->prepare($sql)) {
            $stmt->bind_param("i", $payment_id);
            if ($stmt->execute()) {
                // Redirect to manage page after successful deletion
                header("Location: manage.php");
                exit();
            } else {
                // Handle SQL execution error
                echo "Error executing query: " . $stmt->error;
            }
        } else {
            // Handle SQL preparation error
            echo "Error preparing query: " . $db->error;
        }
    } else {
        // Handle missing payment_id
        echo "No Payment ID provided.";
    }
} else {
    // Handle wrong request method
    echo "Invalid request method.";
}
?>
