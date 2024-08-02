<?php
include_once '../init.php';
$db = dbConn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['issued_qty'])) {
    $issued_qty = $_POST['issued_qty'];
    $items = $_POST['items'];
    $prices = $_POST['prices'];
    $order_id = $_POST['order_id'];

    foreach ($issued_qty as $key => $qty) {
        $issue_qty = (int) $qty;
        $item = $items[$key];
        $price = $prices[$key];

        while ($issue_qty > 0) {
            $sql = "SELECT * FROM `item_stock`
                    WHERE item_id = ? 
                    AND unit_price = ?
                    AND (qty - COALESCE(issued_qty, 0)) > 0
                    ORDER BY `purchase_date` ASC
                    LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("id", $item, $price);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {           
                break;
            }

            $row = $result->fetch_assoc();
            $remaining_qty = $row['qty'] - ($row['issued_qty'] ?? 0);
            $item_id = $row['item_id'];
            $unit_price = $row['unit_price'];
            $i_date = date('Y-m-d');
            $s_id = $row['id'];

            if ($issue_qty <= $remaining_qty) {
                $i_qty = $issue_qty;
                $sql = "UPDATE `item_stock` SET issued_qty = COALESCE(issued_qty, 0) + ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ii", $i_qty, $s_id);
                $stmt->execute();

                $sql = "INSERT INTO order_items_issue(order_id, item_id, stock_id, unit_price, issued_qty, issue_date) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("iiidis", $order_id, $item_id, $s_id, $unit_price, $i_qty, $i_date);
                $stmt->execute();

                $issue_qty = 0;  // All quantity issued
            } else {
                $i_qty = $remaining_qty;
                $sql = "UPDATE `item_stock` SET issued_qty = COALESCE(issued_qty, 0) + ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ii", $i_qty, $s_id);
                $stmt->execute();

                $sql = "INSERT INTO order_items_issue(order_id, item_id, stock_id, unit_price, issued_qty, issue_date) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("iiidis", $order_id, $item_id, $s_id, $unit_price, $i_qty, $i_date);
                $stmt->execute();

                $issue_qty -= $i_qty;  // Reduce the remaining quantity to be issued
            }
        }
    }

    header("Location: ../orders/view_order_items.php?order_id=" . $order_id);
    exit;
}
?>
