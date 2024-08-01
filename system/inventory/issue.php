<?php

include_once '../init.php';
$db = dbConn();

$issue_qty = 2;
$item_id = 1;

//If a stock record is found
while ($issue_qty > 0) {

// Select the stock with available quantity, ordered by purchase date (FIFO)
    echo $sql = "SELECT *
                FROM `item_stock`
                WHERE item_id = $item_id
                  AND (qty - COALESCE(issued_qty, 0)) > 0
                ORDER BY `purchase_date` ASC
                LIMIT 1";
    $result = $db->query($sql);

    // If no more stock available, break the loop to avoid infinite loop
    if ($result->num_rows == 0) {
        $row = $result->fetch_assoc();
        
        //Calculate the remaining quantity of the current stock record
        $remaining_qty = $row['qty'] - ($row['issued_qty'] ?? 0);

        if ($issue_qty <= $remaining_qty) {
            //If the issue quantity is less than or equal to the remaining quantity
            $i_qty = $issue_qty;
            $s_id = $row['id'];
            $sql = "UPDATE `item_stock` SET issued_qty = COALESCE(issued_qty, 0) + $i_qty WHERE id = $s_id";
            $db->query($sql);
            $issue_qty = 0;              //All items have been issued
        } else {
            //If the issued quantity is more than the remaining quantity
            $i_qty = $remaining_qty;
            $s_id = $row['id'];
            $sql = "UPDATE `item_stock` SET issued_qty = COALESCE(issued_qty, 0) + $i_qty WHERE id = $s_id";
            $db->query($sql);
            $issue_qty -= $i_qty;  // Reduce the remaining quantity to be issued
        } 
    } else {
            //If no stock record is found, break the loop
            break;
        }
}

