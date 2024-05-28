<?php
include 'connect.php';

// Check if the user is logged in and is a customer
if (!isset($_SESSION['login']) || $_SESSION['usertype'] != 'customer') {
    header("Location: login.php");
    exit();
}
//$_SESSION['userid'] = $userid;
$sessionid = session_id();

/// Adjust the base directory to point to dist/include
$baseDir = "dist/";


// Retrieve cart items for the current session
$sql = "SELECT items.*, cart.quantity, cart.notes, cart.date FROM cart JOIN items ON cart.itemid = items.id WHERE cart.sessionid = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $sessionid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
          
            // Adjust the image source path to include the base directory
            echo '<td><img src="' . htmlspecialchars($baseDir . $row['picture']) . '" alt="' . htmlspecialchars($row['name']) .  '" class="item-image" width="50"></td>';

            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>$' . htmlspecialchars($row['price']) . '</td>';
            echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
            echo '<td>' . htmlspecialchars($row['date']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No items in the cart.';
    }
    $stmt->close();
} else {
    echo "Prepare failed: " . $conn->error;
}
?>