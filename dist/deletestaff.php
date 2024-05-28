<?php
session_start();
require "../connect.php";

$id = $_GET['id'];

// Prepare the statement to prevent SQL injection
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);

// Execute the statement and check the result
if ($stmt->execute()) {
    header("Location: manage_staff.php?id=$id&delete=successful");
    exit();
} else {
    header("Location: manage_staff.php?id=$id&delete=failed");
    exit();
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
