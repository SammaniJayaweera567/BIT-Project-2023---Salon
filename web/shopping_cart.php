<?php
session_start();
include '../function.php';

extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $operate == 'add_cart') {
    $db = dbConn();

    $sql = "SELECT * FROM item_stock 
            INNER JOIN items ON items.id = item_stock.item_id 
            WHERE item_stock.id='$id'";

    $result = $db->query($sql);

    $row = $result->fetch_assoc();
    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    } else {
        $_SESSION['cart'][$id] = array(
            'stock_id' => $row['id'],
            'item_id' => $row['item_id'],
            'item_name' => $row['item_name'],
            'unit_price' => $row['unit_price'],
            'qty' => 1
        );
    }
    header('Location:product.php');
}
?>
