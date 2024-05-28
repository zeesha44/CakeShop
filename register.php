<?php
session_start();
include "connect.php";

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
    $usertype = 'customer';  // Replace 'default_user' with your desired default usertype

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
        header("Location: register.php?&email=exist");
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, phone, email, password, address, city, usertype, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssssssssss", $fname, $lname, $phone, $email, $hashed_password, $address, $city, $usertype, $state, $zipcode);

        if ($stmt->execute()) {
            header("Location: register.php?&add=success");
        } else {
            header("Location: register.php?&add=error");
        }
    }

    // Close the prepared statements
    $stmtEmail->close();
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Simple House - Contact Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
	<link href="css/templatemo-style.css" rel="stylesheet" />
</head>
<!--

Simple House

https://templatemo.com/tm-539-simple-house

-->
<body> 

	<div class="container">
	<!-- Top box -->
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="img/10.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							<img src="" alt="" class="" /> 
							<div class="tm-site-text-box">
								<h2 class="tm-site-title">Cake Shop</h2>
								<h2 class="tm-site-description">Satisfying Cravings</h2>	
							</div>
						</div>
						<nav class="col-md-6 col-12 tm-nav">
							<ul class="tm-nav-ul">
								<li class="tm-nav-li"><a href="index.php" class="tm-nav-link ">Home</a></li>
								<li class="tm-nav-li"><a href="#" class="tm-nav-link">About</a></li>
								<li class="tm-nav-li"><a href="#" class="tm-nav-link">Contact</a></li>
								<li class="tm-nav-li"><a href="register.php" class="tm-nav-link active">Register</a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Register</h2>
			</header>

			<div class="tm-welcome-section">
				<div class="row">
                <form method="post" action="register.php">
                    <div class="row">
                        <div class="col">
						<label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname">
                        </div>
                        <div class="col">
						<label for="inputEmail4">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname">
                        </div>
                    </div>
                                           
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
                        </div>
						<div class="form-group">
                            <label for="inputAddress">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="+234">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" name="city" id="city">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select name="state" id="state" class="form-control">
                                <option selected>Choose...</option>
                                <option>Adamawa</option>
								<option>Bauchi</option>
								<option>Benue</option>
								<option>Kaduna</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="inputzipcode">zipcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary" name="submit">Register</button></center>
                        </form>
					
				
			</div>
            

			</div>
		</main>

		<footer class="tm-footer text-center">
			
		</footer>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script>
		$(document).ready(function(){
			var acc = document.getElementsByClassName("accordion");
			var i;
			
			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
			    this.classList.toggle("active");
			    var panel = this.nextElementSibling;
			    if (panel.style.maxHeight) {
			      panel.style.maxHeight = null;
			    } else {
			      panel.style.maxHeight = panel.scrollHeight + "px";
			    }
			  });
			}	
		});
	</script>
</body>
</html>