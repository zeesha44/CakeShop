<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cakeshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Create cart table if it doesn't exist
$createCartTable = "CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
        itemid INT NOT NULL,
        quantity INT NOT NULL,
        notes TEXT,
        sessionid VARCHAR(255) NOT NULL
)";

if ($conn->query($createCartTable) === FALSE) {
    die("Error creating cart table: " . $conn->error);
}
?>
