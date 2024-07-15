<?php
include_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "DELETE users, customers FROM users INNER JOIN customers ON users.UserId = customers.UserId WHERE users.UserId = '$userid'";
    $db->query($sql); 
    header("Location: manage.php");
}
?>

