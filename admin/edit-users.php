<?php
//session_start();
include ("function/admin_function.php");

global $con;

$us_id = $_GET['u_id'];

$select = "select * from clients, customer where customer.customer_type=clients.client_id and customer_id='$us_id'";

$query = mysqli_query($con, $select);


if (isset($_POST['save'])) {

  $newName = $_POST['name'];
  $newEmail = $_POST['email'];
  $newContact = $_POST['contact'];
  $newGender = $_POST['gender'];
  $newType = $_POST['type'];

  $mysqli = new mysqli("127.0.0.1", "root", "", "makao");
  $stmt = $mysqli->prepare("UPDATE customer SET customer_name=?, customer_email=?, customer_contacts=?, customer_gender=?, customer_type=? WHERE customer_id=?");
  $stmt->bind_param('ssisii', $newName, $newEmail, $newContact, $newGender, $newType, $us_id);
  $stmt->execute();

  if ($stmt) {
    // header("location: all-users.php");
    echo "Update Successfull";
    
  }else {
    echo "Something went wrong with the update";
  }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>makao bora</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="../style/style.css" media="all">

  </head>
  <body>
  <div class='container'>
	<div class="row">
		<div class="col-md-3 col-md-offset-9">
		 <?php  //echo get_profile_pic().'<br>';
		 //echo 'Welcome '.$_SESSION['name'];?>
		</div>

	</div>

  </div>

  <!-- NAVBAR SECTION -->
	<div class="container-fluid">
		<div class="row">

		<!--		<div class="logo"> <img src="images/makazi.png" class="img-responsive" /></div> navbar-fixed-top-->
    <?php include 'includes/admin-navbar.php' ?>

		</div>
	</div>
	<!--END OF NAVBAR-->
	<div class="container mt-5">
    <!--CLIENT SIDE MENU-->
    <?php include 'includes/sidenav.php' ?>
		<div class="row">
			<div class="col-lg-10 m-auto">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit User</h4>
          </div>
          <div class="card-body">
          <form action="edit-users.php" method="post">
          <?php
            while ($rows=mysqli_fetch_array($query)) {
              $name = $rows['customer_name'];
              $email = $rows['customer_email'];
              $contact = $rows['customer_contacts'];
              $gender = $rows['customer_gender'];
              $type = $rows['client_title'];
              $type_id = $rows['client_id'];

          ?>

            <div class="form-group mt-2 mb-2">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="<?php echo $name ?>">  
            </div>
            <div class="form-group mt-2 mb-2">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" value="<?php echo $email ?>">  
            </div>
            <div class="form-group mt-2 mb-2">
              <label for="contact">Contact</label>
              <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $contact ?>">  
            </div>
            <div class="form-group mt-2 mb-2">
              <label for="name">Gender</label>
              <select type="text" name="gender" id="gender" class="form-control">
                <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                <option value="female">Female</option>
                <option value="male">Male</option>
              </select>  
            </div>
            <div class="form-group mt-2 mb-2">
              <label for="type">User Type</label>
              <select type="text" name="type" id="type" class="form-control">
                <option value="<?php echo $type_id ?>"><?php echo $type ?></option>
                <?php 
                  $sub_sel = "select * from clients";
                  $sub_query = mysqli_query($con, $sub_sel);

                  while ($sub_rows=mysqli_fetch_array($sub_query)) {
                    $type_name = $sub_rows['client_title'];
                    $type_id = $sub_rows['client_id'];
                  
                ?>

                <option value="<?php echo $type_id ?>"><?php echo $type_name ?></option>

                <?php
                  }
                ?>
              </select>
            </div>

          <?php
            }
          ?>
          </div>
          <div class="card-footer">
            <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
        </div>
			</div>
		</div>
	</div>
	<!-- FOOTER SECTION -->

	 <footer class="site-footer">
		<?php include 'includes/footer.php' ?>
	 </footer>
	<!-- END OF THE FOOTER -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/dist/js/bootstrap.js"></script>
    <script src="../js/mainjs.js"></script>
  </body>
</html>
