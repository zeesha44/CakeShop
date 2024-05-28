<?php

require "../connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing item details
    $sql = "SELECT * FROM items WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "Item not found.";
        exit();
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $picture = $item['picture']; // Keep existing picture path by default

        // Handle new picture upload if provided
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
            $pictureFile = $_FILES['picture'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($pictureFile["name"]);
            move_uploaded_file($pictureFile["tmp_name"], $target_file);
            $picture = $target_file; // Update picture path with new uploaded file
        }

        // Update the item in the database
        $sql = "UPDATE items SET name = ?, price = ?, description = ?, picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $price, $description, $picture, $id);

        if ($stmt->execute()) {
            header("Location: products.php?edit=success");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<?php
     
     include '../connect.php';
     
     $sql = "SELECT * FROM items";
    $result = $conn->query($sql);
     
     require "insert_staff.php";
      include "header.php";
      ?> 
       <!-- partial -->
       <div class="main-panel">
          <div class="content-wrapper">
       <div class="row">
              <div class="col-12 grid-margin">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Product</h4>
          <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						<label for="inputEmail4">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $item['name']; ?>">
                        </div>
                        <div class="col">
						<label for="inputEmail4">Price</label>
                        <input type="text" class="form-control" name="price" id="price" value="<?php echo $item['price']; ?>">
                        </div>
                    </div>
                                           
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $item['description']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture"  >
                            <img src="<?php echo $item['picture']; ?>" alt="Current Picture" width="50">
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary" name="submit">Update Product</button></center>
                        </form>
</div>
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