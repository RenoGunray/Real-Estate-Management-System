<?php
//session_start();
include ("function/landlords_function.php");


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
        

    <?php include 'includes/navbar.php' ?>

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
						<h4 class="card-title">My Orders</h4>
					</div>
					<div class="card-body">
						<div class="d-flex justify-content-start mb-3">
							<a href="my-orders.php" class="btn btn-outline-primary me-3">My Orders</a>
							<!-- <a href="all-orders.php" class="btn btn-outline-primary">All Orders</a> -->
						</div>
						<?php get_my_orders();?>
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
