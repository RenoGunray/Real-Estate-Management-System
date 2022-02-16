<?php
//session_start();
include ("function/admin_function.php");

if (isset($_POST['update'])) {
	$new_name = $_POST['customer_name'];
	$new_email = $_POST['customer_email'];
	$new_contact = $_POST['customer_contact'];

	$password = $_POST['customer_pass1'];
	$con_pass = $_POST['customer_pass2'];

	if ($password == "" and $con_pass == "") {
		$verify_mssg = "Please Verify Its you";
	} else if ($password != "" and $con_pass != "") {
		if ($password == $con_pass) {
			$new_password = $con_pass;

			//using prepared staments for updating
			$mysqli = new mysqli("127.0.0.1", "root", "", "makao");
			$stmt = $mysqli->prepare("UPDATE customer SET customer_name=?, customer_email=?, customer_contacts=?, customer_password=? WHERE customer_id=?");
			$stmt->bind_param('ssisi', $new_name, $new_email, $new_contact, $new_password, $_SESSION['id']);
			$stmt->execute();

			if ($stmt) {
				$update_mssg = "Update successful";
			} else {
				$update_err = "Something went wrong with the update";
			}

		} else {
			$pass_err = "Passwords do not match";
		}
	}



	// $update = "update customer set customer_name='$new_name' where cutomer_id='".$_SESSION['id']."'";

	// $query = mysqli_query($con, $update);

	

}

	$select = "select * from customer where customer_id='".$_SESSION['id']."'";
	$query = mysqli_query($con, $select);

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

	</div>

  </div>

  <!-- NAVBAR SECTION -->
	<div class="container-fluid">
		<div class="row">

		<!--		<div class="logo"> <img src="images/makazi.png" class="img-responsive" /></div> navbar-fixed-top-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Client Orders</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">FAQs</a>
                </li>
              </ul>
              <div class="d-flex">
                <?php echo $_SESSION['name']; ?>
              </div>
            </div>
          </div>
        </nav>

		</div>
	</div>
	<!--END OF NAVBAR-->
	<div class="container">
		<div class="row">
			<div class="col-md-5">
			<!--CLIENT SIDE MENU-->
        <a href="admin.php">personal details</a><br>
        <a href="property-type.php">Property</a><br>
				<a href="Landlords_order.php">my orders</a><br>
				<a href="edit_admin_profile.php">edit personal details</a><br>
				<a href="withdraw.php">Widthdraw cash</a><br>
				<a href="../signout.php">logout</a>
			</div>
			<div class="col-md-7">

			<!-- FORM FOR EDITTING PERSONAL DETAILS-->

				<form action="edit-admin-profile.php" class="form-horizontal" method="post" enctype="multipart/form-data">
				  <?php
						while ($rows=mysqli_fetch_array($query)) {

							$name = $rows['customer_name'];
							$contact = $rows['customer_contacts'];
							$email = $rows['customer_email'];
							$password = $rows['customer_password'];

					?>

				  <div class="form-group">
						<label class="control-label col-xs-2"> Names :</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="customer_name" placeholder="fullnames" value="<?php echo $name; ?>" >
							
							</div>
					<div class="form-group">
						<label class="control-label col-xs-2">Contacts :</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="customer_contact" value="<?php echo $contact; ?>">
						</div>
					</div>
					<!--W
						<div class="form-group">
							<label class="control-label col-xs-2">Profile Picture :</label>
							<div class="col-xs-4">
								<input type="file" class="form-control" name="profile_pic" >
							</div>
						</div>
					-->
					<div class="form-group">
						<label class="control-label col-xs-2"> Email :</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="customer_email" placeholder="eg. some@thing.com" value="<?php echo $email; ?>" />
							
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"> Password :</label>
						<div class="col-xs-4">
							<input type="password" class="form-control" name="customer_pass1" placeholder="New/Current Password">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"> Confirm Password :</label>
						<div class="col-xs-4">
							<input type="password" class="form-control" name="customer_pass2" placeholder="confirm password" >
							 <span><?php if(isset($pass_err)) echo $pass_err; ?></span>
							 <span><?php if(isset($verify_mssg)) echo $verify_mssg; ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"></label>
						</div>
						<div class="col-xs-4">
					<button type="submit" name="update" class="btn btn-primary">Update Details</button>
					</div>

					<?php
					
						}//close loop
					?>
					  </fieldset>
				</form>
				<span><?php if(isset($update_mssg)) echo $update_mssg; ?></span>
				<span><?php if(isset($update_err)) echo $update_err; ?></span>

			</div>
		</div>
	</div>
	<!-- FOOTER SECTION -->

	 <footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
				<h4>Contact Address </h4>
					<address>
						#999, Siriba Campus,<br>
						Maseno,<br>
						Kenya.
					</address>
				</div>
		</div>
		<div class="bottom-footer">
			<div class="col-md-5">&copy;Copyright Makao Bora 2017.</div>
			<div class="col-md-7">
				<ul class="footer-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="#">FAQs</a></li>
					<li><a href="index.php">Sign Out</a></li>
				</ul>
			</div>
			</div>
		</div>
	 </footer>
	<!-- END OF THE FOOTER -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
