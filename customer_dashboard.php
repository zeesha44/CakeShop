<?php
session_start();

// Check if the user is logged in and is a customer
if (!isset($_SESSION['login']) || $_SESSION['usertype'] != 'customer') {
    header("Location: login.php");
    exit();
}

// Get user details from session
$fname = $_SESSION['sessionfname'];
$lname = $_SESSION['sessionlname'];
$userid = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cake Shop</title>
    <script src="https://kit.fontawesome.com/dd67e320d8.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />    
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
								<li class="tm-nav-li"><a href="index.php" class="tm-nav-link active">Home</a></li>
								<li class="tm-nav-li"><a href="#" class="tm-nav-link">About</a></li>
								<li class="tm-nav-li"><a href="#" class="tm-nav-link">Contact</a></li>
								<li class="tm-nav-li"><a href="cart.php" class="tm-nav-link"><i class="fa-solid fa-cart-shopping"></i></a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Welcome <?php echo htmlspecialchars($fname) . " " . htmlspecialchars($lname); ?> to Cake Shop</h2>
				
			</header>
			

			<!-- Gallery -->
			<div class="row tm-gallery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
                <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "connect.php";

// Base directory where images are stored relative to the PHP file
$baseDir = "dist/";

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Prepend the base directory to the image path
        $imagePath = $baseDir . $row['picture'];
        $itemId = htmlspecialchars($row['id']);
        $itemName = htmlspecialchars($row['name']);
        $itemDescription = htmlspecialchars($row['description']);
        $itemPrice = htmlspecialchars($row['price']);
        $modalId = "exampleModal" . $itemId;
        
        echo '<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">';
        echo '<figure>';
        echo '<img src="' . $imagePath . '" alt="' . $itemName . '" class="img-fluid tm-gallery-img" />';
        echo '<figcaption>';
        echo '<h4 class="tm-gallery-title">' . $itemName . '</h4>';
        echo '<p class="tm-gallery-description">' . $itemDescription . '</p>';
        echo '<p class="tm-gallery-price">$' . $itemPrice . ' <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#' . $modalId . '"> <i class="fa-solid fa-cart-shopping"></i></button></p>'?>
        </figcaption>
        </figure>
        </article>

        <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="itemid" value="<?php echo $itemId; ?>">
					<label>Quantity</label>
                    <input class="form-control" type="number" placeholder="Enter quantity" id="quantity" name="quantity" value="1" min="1" required>
                    <input class="form-control" type="text" placeholder="Special instructions" name="notes" id="notes">
                    <input class="form-control" type="date" placeholder="For When" name="date" id="date">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="add_to_cart" class="btn btn-primary" name="add_to_cart">Add To Cart</button>
            </div>
            </form>
        </div>
    </div>
</div>

        <?php
    }
} else {
    echo "No items found.";
}

$conn->close();
?>

				</div> <!-- gallery page 1 -->
				
				
		</main>

		<footer class="tm-footer text-center">
			<p> </p>
		</footer>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="js/parallax.min.js"></script>

	<script>
		$(document).ready(function(){
			// Handle click on paging links
			$('.tm-paging-link').click(function(e){
				e.preventDefault();
				
				var page = $(this).text().toLowerCase();
				$('.tm-gallery-page').addClass('hidden');
				$('#tm-gallery-page-' + page).removeClass('hidden');
				$('.tm-paging-link').removeClass('active');
				$(this).addClass("active");
			});
		});
	</script>
</body>
</html>
