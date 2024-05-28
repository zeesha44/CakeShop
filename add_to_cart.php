<?php
session_start();
include 'connect.php';

$sessionid = session_id();

if (isset($_POST['add_to_cart'])) {
    // Create the temporary table if it doesn't exist
    // $createTableSql = "CREATE TEMPORARY TABLE IF NOT EXISTS cart (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     itemid INT NOT NULL,
    //     quantity INT NOT NULL,
    //     notes TEXT,
    //     sessionid VARCHAR(255) NOT NULL
    // )";
    // if (!$conn->query($createTableSql)) {
    //     header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=create_table_failed");
    //     exit();
    // }

    $itemid = $_POST['itemid'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO cart (itemid, quantity, notes, sessionid, date) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iisss", $itemid, $quantity, $notes, $sessionid, $date);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=insert_failed");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=prepare_failed");
        exit();
    }
}

$conn->close();
?>
