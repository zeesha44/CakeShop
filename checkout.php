<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['login']) || $_SESSION['usertype'] != 'customer') {
    header("Location: login.php");
    exit();
}

$sessionid = session_id();
//echo $sessionid; // Remove single quotes around $sessionid

if (!isset($_SESSION['userid'])) {
    // Handle the case when userid is not set
    // Redirect the user to the login page or handle the error accordingly
    // For example:
    header("Location: index.php");
    exit();
}

$userid = $_SESSION['userid']; // Assuming userid is set in the session

$sql = "SELECT * FROM cart WHERE sessionid = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $sessionid);
    $stmt->execute();
    $result = $stmt->get_result();

    
    $status = 'Pending'; // Assuming 'Pending' is the default status
    while ($row = $result->fetch_assoc()) {
        $itemid = $row['itemid'];
        $quantity = $row['quantity'];
        $notes = $row['notes'];
        $date = $row['date'];
        $payment = 'paid'; // Set payment value as needed

        // Insert into orders table
        $insertOrderSql = "INSERT INTO orders (userid, itemid, quantity, payment, date, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertOrderSql);
        if ($insertStmt) {
            $insertStmt->bind_param("iiissss", $userid, $itemid, $quantity, $payment, $date, $notes, $status);
            $insertStmt->execute();
            $insertStmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    }

    // Clear the cart
    $clearCartSql = "DELETE FROM cart WHERE sessionid = ?";
    $clearCartStmt = $conn->prepare($clearCartSql);
    if ($clearCartStmt) {
        $clearCartStmt->bind_param("s", $sessionid);
        $clearCartStmt->execute();
        $clearCartStmt->close();
    }

    // Redirect to the order confirmation page
    header("Location: order_confirmation.php");
    exit();

    $stmt->close();
} else {
    echo "Prepare failed: " . $conn->error;
}

$conn->close();
?>
