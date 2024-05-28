<?php
//session_start();
include 'connect.php';

// Check if the user is logged in and is a customer
if (!isset($_SESSION['login']) || $_SESSION['usertype'] != 'customer') {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

// Retrieve orders for the logged-in user along with item details
$sql = "SELECT orders.*, items.name AS item_name, items.picture AS item_picture FROM orders JOIN items ON orders.itemid = items.id WHERE orders.userid = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($baseDir= "dist/" . $row['item_picture']) . '" alt="' .'" class="item-image" width="50"></td>';
            echo '<td>' . htmlspecialchars($row['payment']) . '</td>';
            echo '<td>' . htmlspecialchars($row['date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
            echo '<td>' . htmlspecialchars($row['status']) . '</td>';
            echo '<td><a href="edit_order.php?id=' . $row['id'] . '">Edit</a> | <a href="cancel_order.php?id=' . $row['id'] . '">Cancel</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No orders found.';
    }
    $stmt->close();
} else {
    echo "Prepare failed: " . $conn->error;
}

$conn->close();
?>
