<?php
session_start();
require "../connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Check if the file was uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
        $picture = $_FILES['picture'];
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($picture["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($picture["size"] > 500000) { // 500 KB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                // File uploaded successfully, proceed with database insertion

                // Prepare the insert statement
                $stmt = $conn->prepare("INSERT INTO items (name, price, description, picture) VALUES (?, ?, ?, ?)");
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param("ssss", $name, $price, $description, $target_file);

                // Execute the statement and check the result
                if ($stmt->execute()) {
                    header("Location: products.php?add=successful");
                    exit();
                } else {
                    header("Location: add_item.php?add=failed");
                    exit();
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}

// Close the database connection
$conn->close();
?>
