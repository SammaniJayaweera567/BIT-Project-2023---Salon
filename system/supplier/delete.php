<?php
include_once '../init.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = dbConn();
    $delete_query = "DELETE FROM supplier WHERE id='$id'";
    $delete_result = $db->query($delete_query);
    if ($delete_result) {
        header("Location: manage.php");
    } else {
        echo "Failed to delete supplier. Please try again.";
    }
}
?>
