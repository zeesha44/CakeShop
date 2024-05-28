<?php
session_start();
require "../connect.php";

if (isset($_POST["submit"])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];


    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, phone = ?, email = ?, address = ?, city = ?, state = ?, zipcode = ? WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssssssi", $fname, $lname, $phone, $email,  $address, $city, $state, $zipcode, $id);

    // Execute the statement and check the result
    if ($stmt->execute()) {
        header("Location: editstaff.php?update=successful");
        exit();
    } else {
        header("Location: editstaff.php?id=$id&update=failed");
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
