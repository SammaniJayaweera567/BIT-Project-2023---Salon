<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $purchase_order_item_id = intval($_GET['id']);
    $db = dbConn();

    $sql = "DELETE FROM purchase_order_item WHERE purchase_order_item_id = '$purchase_order_item_id'";

    if ($db->query($sql)) {
        header("Location: manage_purchase_order_items.php");
    } else {
        echo "Failed to delete purchase order item. Please try again.";
    }
}
?>
