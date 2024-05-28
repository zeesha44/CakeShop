<?php
//session_start();
include '../connect.php';

// Get the current date
$today = date('Y-m-d');

// Retrieve orders for today's date along with item details
$sql = "SELECT orders.*, items.name AS item_name, items.picture AS item_picture 
        FROM orders 
        JOIN items ON orders.itemid = items.id
        WHERE DATE(orders.date) = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead><tr><th>Order ID</th><th>Item Name</th><th>Picture</th><th>Payment</th><th>Date</th><th>Quantity</th><th>Notes</th><th>Status</th><th>Action</th></tr></thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($row['item_picture']) . '" alt="' . htmlspecialchars($row['item_name']) . '" class="item-image" width="50"></td>';
            echo '<td>' . htmlspecialchars($row['payment']) . '</td>';
            echo '<td>' . htmlspecialchars($row['date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
            echo '<td>' . htmlspecialchars($row['status']) . '</td>';
            echo '<td><a href="edit_order.php?id=' . $row['id'] . '">Mark as done</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No orders found for today.';
    }
    $stmt->close();
} else {
    echo "Query failed: " . $conn->error;
}

$conn->close();
?>
