<?php
include_once '../init.php';

// Ensure the attendance_id is provided
if (isset($_GET['attendance_id'])) {
    $attendance_id = $_GET['attendance_id'];

    // Establish a database connection
    $db = dbConn();

    // Prepare and execute the SQL query to delete the attendance record
    $sql = "DELETE FROM attendance WHERE attendance_id='$attendance_id'";

    if ($db->query($sql)) {
        // If the query was successful, redirect to the manage page with a success message
        header("Location: manage.php?message=Record deleted successfully");
    } else {
        // If there was an error, redirect to the manage page with an error message
        header("Location: manage.php?message=Error deleting record");
    }

    // Ensure the script exits after redirection
    exit();
} else {
    // Redirect to manage page if no attendance_id is provided
    header("Location: manage.php?message=No ID provided for deletion");
    exit();
}
?>
