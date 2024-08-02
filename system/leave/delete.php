<?php
include_once '../init.php';

if (isset($_GET['leave_id'])) {
    $leave_id = intval($_GET['leave_id']);

    // Connect to the database
    $db = dbConn();

    // Prepare and execute the delete query
    $sql = "DELETE FROM `leave` WHERE leave_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $leave_id);

    if ($stmt->execute()) {
        // Redirect to the manage page with a success message
        header("Location: manage.php?msg=delete_success");
    } else {
        // Redirect to the manage page with an error message
        header("Location: manage.php?msg=delete_error");
    }

    $stmt->close();
    $db->close();
} else {
    // Redirect to the manage page if no leave_id is provided
    header("Location: manage.php");
}
exit();
?>

