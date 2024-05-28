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
$userid = $_SESSION['userid'] ;
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
                                <li class="tm-nav-li"><a href="customer_dashboard.php" class="tm-nav-link ">Home</a></li>
                                <li class="tm-nav-li"><a href="#" class="tm-nav-link">About</a></li>
                                <li class="tm-nav-li"><a href="#" class="tm-nav-link">Contact</a></li>
                                <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link active"><i
                                            class="fa-solid fa-cart-shopping"></i></a></li>
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
            <div class="col-12 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Picture</th>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        include 'fetch_items.php';
                        ?>
                    </tbody>
                </table>
                <a type="button" class="btn btn-primary btn-lg" href="checkout.php?<?php echo "$sessionid"?>">Checkout</a>

            </div> <!-- gallery page 1 -->


        </main>

        <footer class="tm-footer text-center">
           
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHw
