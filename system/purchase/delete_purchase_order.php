<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $purchase_order_id = intval($_GET['id']);
    $db = dbConn();
    
    // Start transaction
    $db->begin_transaction();

    try {
        // Delete associated items from purchase_order_item table
        $delete_items_query = "
            DELETE FROM purchase_order_item
            WHERE purchase_order_id = '$purchase_order_id'
        ";
        $db->query($delete_items_query);

        // Delete the purchase order from purchase_order table
        $delete_order_query = "
            DELETE FROM purchase_order
            WHERE purchase_order_id = '$purchase_order_id'
        ";
        $db->query($delete_order_query);

        // Commit transaction
        $db->commit();

        // Redirect to manage page
        header("Location: manage_purchase_orders.php");
    } catch (mysqli_sql_exception $e) {
        // Rollback transaction in case of error
        $db->rollback();
        echo "Failed to delete purchase order. Please try again.";
    }
}
?>
