<?php
session_start();
require "../connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the item from the database
    $sql = "DELETE FROM items WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: products.php?delete=success");
        exit();
    } else {
        header("Location: products.php?delete=failed");
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
