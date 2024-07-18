<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stock_id = $_GET['id'];

    // Delete the stock entry
    $db = dbConn();
    $delete_query = "DELETE FROM item_stock WHERE id='$stock_id'";
    $delete_result = $db->query($delete_query);

    if ($delete_result) {
        header("Location: manage_stock.php");
    } else {
        // Redirect back with an error message if deletion fails
        header("Location: manage_stock.php?error=Failed to delete stock. Please try again.");
    }
}
?>
