<?php
include ("function/function.php");

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
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="style/style.css" media="all">

  </head>
  <body>

  <!-- NAVBAR SECTION -->
	<div class="container-fluid">
		<div class="row">

		<!--		<div class="logo"> <img src="images/makazi.png" class="img-responsive" /></div> 
				<nav class="navbar navbar-default navbar-fixed-top">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="images/logo4.png" style="max-width:120px; margin-top:-15px; " ></a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php">Home</a></li>
								<li class="active"><a href="#">Property Search</a></li>
								<li class="active"><a href="#">About Us</a></li>
								<li class="active"><a href="contact_us.php">Contact Us</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
								<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
							</ul>
					</div>

				</nav>
-->
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
                  <a class="nav-link" href="#">Property Search</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact_us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">About Us</a>
                </li>
              </ul>
              <div class="d-flex">
								<?php
									if (isset($_SESSION['id']) and isset($_SESSION['name'])) {

										$select = "select * from customer, clients where customer.customer_type=clients.client_id and customer_id='".$_SESSION['id']."'";

										$query = mysqli_query($con, $select);

										while ($rows=mysqli_fetch_array($query)) {
											$customer_name = $rows['customer_name'];
											$customer_type = $rows['customer_type'];
											$client_type = $rows['client_title'];

										}
										if ($client_type == 'admin') {
											
											?>
									<a href="admin/admin.php" class="nav-link"><?php echo $customer_name; ?></a>
									<?php
									}
									
									if ($client_type == "LandLord") {
										?>
										<a href="landlords/landlord.php" class="nav-link"><?php echo $customer_name; ?></a>
										
										<?php
									}
										
									}

									else {

								?>

									<ul class="nav navbar-nav navbar-right">
										<li clas="nav-item"><a href="sign_up.php" class="nav-link"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
										<li class="nav-item"><a href="login.php" class="nav-link"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
									</ul>
								<?php

									}
								?>
              </div>
            </div>
          </div>
        </nav>

		</div>
	</div>


  <!-- LIST PROPERTY SECTION -->
	<div class="container">
	<br>
		<div class="row">
	<h3>All Properties In Malawi </h3>
	</div>

	<?php getProperty();?>
	</div>

	<!-- END OF THE PROPERTY LIST-->


	 <!-- FOOTER SECTION -->

	 <footer class="site-footer">
		<?php include 'footer.php' ?>
	 </footer>


	<!-- END OF THE FOOTER -->








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="..bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#myslider').carousel();

	}
	);
	</script>
  </body>
</html>
