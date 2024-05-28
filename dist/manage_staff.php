
     <?php
     
     include '../connect.php';
     
     $sql = "SELECT * FROM users WHERE usertype ='staff'";
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
                    <h4 class="card-title">List of Staff</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['fname'] . "</td>";
                                        echo "<td>" . $row['lname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" ?> 

                                            <a type="button" class="btn btn-outline-success" href="editstaff.php?id=<?php echo $id; ?>')">
                                            <span class="mdi mdi-note-edit-outline"></span> Edit
                                            </a>         
                                        <?php "</td>";
                                        echo "<td>" ?>
                                            <!-- Modal for item deletion -->
                                            <a type="button" class="btn btn-outline-danger" href="deletestaff.php?id=<?php echo $id; ?>')">
                                                    <span class="mdi mdi-delete-outline"></span> Delete
                                    </a>                                
                                         <?php "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No staff found</td></tr>";
                                }
                                ?>
                                </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        
          <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Staff</h4>
          <form method="post" action="manage_staff.php">
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
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="1234 Main St">
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