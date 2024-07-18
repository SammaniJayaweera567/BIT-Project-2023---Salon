<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Update";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM items WHERE id='$itemid'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $item_name = $row['item_name'];
    $item_category = $row['item_category'];
    $item_image = $row['item_image'];
    $status = $row['status'];
    $itemid = $row['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $item_name = dataClean($item_name);
    $item_category = dataClean($item_category);
    $status = dataClean($status);

    $message = array();
    if (empty($item_name)) {
        $message['item_name'] = "The Item Name should not be blank!";
    }
    if (empty($item_category)) {
        $message['item_category'] = "The Item Category should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    // Image upload
    if ($_FILES['item_image']['name']) {
        $target_dir = "uploads/";
        $target_file =
