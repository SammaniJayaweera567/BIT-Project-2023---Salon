<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $category_id = $_GET['id'];

    // Delete the category
    $db = dbConn();
    $delete_query = "DELETE FROM item_category WHERE id='$category_id'";
    $delete_result = $db->query($delete_query);

    if ($delete_result) {
        header("Location: manage.php");
    } else {
        // Redirect back with an error message if deletion fails
        header("Location: manage.php?error=Failed to delete category. Please try again.");
    }
}
?>
