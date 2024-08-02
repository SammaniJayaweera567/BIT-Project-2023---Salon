<?php
include_once '../init.php';

if (isset($_GET['id'])) {
    $supplier_id = intval($_GET['id']); // Correct parameter name and variable
    $db = dbConn();
    $delete_query = "DELETE FROM supplier WHERE supplier_id='$supplier_id'"; // Correct column name
    $delete_result = $db->query($delete_query);
    if ($delete_result) {
        header("Location: manage.php");
        exit();
    } else {
        echo "Failed to delete supplier. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>