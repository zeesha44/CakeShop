<?php
//session_start();
include "../connect.php";

if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Automatically set the usertype
    $usertype = 'staff';  // Replace 'default_user' with your desired default usertype

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmtEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmtEmail) {
        die("Prepare failed: " . $conn->error);
    }
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $resultEmail = $stmtEmail->get_result();

    if ($resultEmail->num_rows > 0) {
        header("Location: manage_staff.php?&email=exist");
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, phone, email, password, address, city, usertype, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssssssssss", $fname, $lname, $phone, $email, $hashed_password, $address, $city, $usertype, $state, $zipcode);

        if ($stmt->execute()) {
            header("Location: manage_staff.php?&add=success");
        } else {
            header("Location: manage_staff.php?&add=error");
        }
    }

    // Close the prepared statements
    $stmtEmail->close();
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
