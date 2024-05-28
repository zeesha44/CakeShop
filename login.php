<?php
session_start();
include 'connect.php';

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['sessionemail'] = $row['email'];
            $_SESSION['sessionfname'] = $row['fname'];
            $_SESSION['sessionlname'] = $row['lname'];
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['login'] = true;

            if ($_SESSION['usertype'] == 'staff') {
                header("Location: dist/index.php");
            } 
            elseif ($_SESSION['usertype'] == 'customer') {
                header("Location: customer_dashboard.php");
            } 
            else {
                header("Location: index.php?error=unknownusertype");
            }
        } else {
            header("Location: index.php?error=wrongpassword");
        }
    } else {
        header("Location: index.php?error=usernotfound");
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
