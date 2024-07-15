<?php

// Create Database Connection ----------------------------------
function dbConn() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "sms";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn->connect_error) {
        die("Database Error: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

// End Database Connection -------------------------------------

// Data clean start ------------------------------------------
function dataClean($data = null) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// Data clean end --------------------------------------------

?>


