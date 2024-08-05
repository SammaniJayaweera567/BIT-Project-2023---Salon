<?php
include_once '../init.php';

// Ensure the 'id' parameter is present in the URL and is valid
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $itemid = $_GET['id'];

    // Sanitize and validate the input to prevent SQL injection
    $itemid = intval($itemid);

    // Create database connection
    $db = dbConn();

    // Prepare the SQL query to delete the item
    $sql = "DELETE FROM items WHERE item_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $itemid);

    if ($stmt->execute()) {
        // Redirect to manage.php after successful deletion
        header("Location: manage.php");
        exit();
    } else {
        // Handle error if deletion fails
        echo "Error deleting item: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $db->close();
} else {
    // Handle missing or invalid 'id' parameter
    echo "Invalid or missing item ID.";
}
?>
