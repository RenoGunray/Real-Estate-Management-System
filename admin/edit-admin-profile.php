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
    <?php include 'includes/admin-navbar.php' ?>

		</div>
	</div>
	<!--END OF NAVBAR-->
	<div class="container mt-2">
		<!--CLIENT SIDE MENU-->
			<?php include 'includes/sidenav.php'; ?>
		<div class="row">
			<div class="col-lg-10 m-auto">

				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit</h4>
					</div>
					<div class="card-body">
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
