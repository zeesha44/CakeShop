
<?php
require "../connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_staff.php?error=missingid");
    exit();
}

$id = $_GET['id'];

// Fetch the staff details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: manage_staff.php?error=notfound");
    exit();
}

$row = $result->fetch_assoc();

$stmt->close();
$conn->close();
     
     require "insert_staff.php";
      include "header.php";
      ?> 
       <!-- partial -->
       <div class="main-panel">
          <div class="content-wrapper">
        
          <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Staff</h4>
          <form method="post" action="updatestaff.php">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="row">
                        <div class="col">
						<label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" value = "<?php echo $row['fname']?>">
                        </div>
                        <div class="col">
						<label for="inputEmail4">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname"  value = "<?php echo $row['lname'];?>">
                        </div>
                    </div>
                                           
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email"  value = "<?php echo $row['email'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value = "<?php echo $row['address'];?>">
                        </div>
						<div class="form-group">
                            <label for="inputAddress">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="+234 " value = "<?php echo $row['phone'];?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" name="city" id="city" value = "<?php echo $row['city'];?>">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select name="state" id="state" class="form-control" value = "<?php echo $row['state'];?>">
                                <option>Choose...</option>
                                <option>Adamawa</option>
								<option>Bauchi</option>
								<option>Benue</option>
								<option>Kaduna</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="inputzipcode">zipcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" value = "<?php echo $row['zipcode'];?>">
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary" name="submit">Update</button></center>
                        </form>
</div>
</div>


    </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <script>
    // JavaScript functions to handle modal
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        var modals = document.getElementsByClassName('modal');
        for (var i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }
    }
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNvDHoBYWGUrC1hQ2uY7gy2hvkeGETyoNcQ8zV+NgdMB/IfxFt1Nf7L4f2hFiLG" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4Ag3ZBLOe2c37h8r5A8INN43ck8/Cvl1kYXYQRKaIYjHpyXGb1l5" crossorigin="anonymous"></script>
  </body>
</html>