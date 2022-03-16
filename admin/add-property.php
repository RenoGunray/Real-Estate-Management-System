<?php
include ("function/admin_function.php");

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
	<div class="container mt-2">
		<!--CLIENT SIDE MENU-->
			<?php include 'includes/sidenav.php'; ?>
		<div class="row m-auto">
			
			<div class="col-lg-10">

			<!-- FORM FOR EDITTING PERSONAL DETAILS-->

				<form action="edit-admin-profile.php" class="form-horizontal" method="post" enctype="multipart/form-data">
				  

        <div class="form-group">
						<label class="control-label col-xs-2"> Property Title :</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="p-title" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"> Property Description</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="p-desc" >
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
						<label class="control-label col-xs-2"> Property Title :</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="p-title" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"> Property Description</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="" placeholder="New/Current Password">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"> Confirm Password :</label>
						<div class="col-xs-4">
							<input type="password" class="form-control" name="customer_pass2" placeholder="confirm password" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2"></label>
						</div>
						<div class="col-xs-4">
					<button type="submit" name="update" class="btn btn-primary">Update Details</button>
					</div>
					  </fieldset>
				</form>
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
