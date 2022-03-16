<?php
//session_start();
include ("function/function.php");

if(isset($_POST['purchase']))
{

	//orders
	//property id
	//user id {purchaser's id}


	$client = $_POST['clients_id'];
	$property = $_POST['property_id'];
	$payment = $_POST['payment'];
	$price = $_POST['price'];
	$owner = $_POST['owner_id'];
	$type_id = $_POST['type_id'];

	//proof of pay
	$file_name = $_FILES['proof']['name'];
	$file_size = $_FILES['proof']['size'];
	$file_tmp = $_FILES['proof']['tmp_name'];
	$file_type = $_FILES['proof']['type'];

	$explode = explode('.', $file_name);
	$fileActualExt = strtolower(end($explode));

	$allowed_file_type = array('image/jpg', 'image/png', 'image/jpeg', 'image/JPG', 'image/PNG', 'image/JPEG');

	if (in_array($file_type, $allowed_file_type)) {

		$newfilename = uniqid('', true) . '.' . $fileActualExt;

		$move_dir = "c:xampp/htdocs/Real-Estate-Management-System/payments/" . $newfilename;

		move_uploaded_file($file_tmp, $move_dir);

		if ($payment == $price) {
	
	
			$insert = "insert into purchases (
				property_id,
				pro_type, 
				clients_id,
				owner_id,
				payment,
				proof_of_pay
				) 
				values (
					'$property',
					'$type_id',
					'$client',
					'$owner',
					'$payment',
					'$newfilename'
				)";
		
				$query = mysqli_query( $con, $insert );
		
				if ( $query ) {
					header("location: index.php");
				}
		}
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
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="style/style.css" media="all">

  </head>
  <body>

  <!-- NAVBAR SECTION -->
	<div class="container-fluid">
		<div class="row">

		<!--		<div class="logo"> <img src="images/makazi.png" class="img-responsive" /></div> -->
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

    <!-- CHECKING DETAILS OF THE SELECTED PROPERTY SECTION -->
	<div class="container">

		<div class="row">
			<h3> More details about</h3>
		</div>

	<?php
	global $con;

	if (isset($_GET['pro_id']))	{

	$property_id=$_GET['pro_id'];

	$_SESSION['pro_id']=$property_id;

	$get_pro="select * from customer, property where property.property_owner=customer.customer_id and property_id='$property_id'";

	$run_pro=mysqli_query($con, $get_pro);

	while ($row_pro=mysqli_fetch_array($run_pro))
	{
		$pro_id=$row_pro['property_id'];
					$pro_cat=$row_pro['property_cat'];
					$pro_type=$row_pro['property_type'];
					$pro_title=$row_pro['property_title'];
					$pro_owner=$row_pro['property_owner'];
					$pro_image=$row_pro['property_image'];
					$pro_price=$row_pro['property_price'];
					$pro_desc=$row_pro['property_desc'];
					$pro_bed=$row_pro['bed'];
					$pro_bath=$row_pro['bath'];
					$pro_owner = $row_pro['property_owner'];
					$pro_owner_name = $row_pro['customer_name'];
		?>
		
				<ul class='list-group'>
					<li class='list-group-item'>
				<br>
					<div class='row'>
						<div class='col-md-4 col-sm-4'>
							<img src='property_images/<?php echo $pro_image ?>' height=400 width=400 style='border:2px solid black;' class='img-responsive'>
						</div>
						<div class='col-md-8 col-sm-8'>
							<h3><?php echo $pro_title ?></h3>
							<p> <?php echo $pro_desc ?> </p>
							<p><b> K <?php echo $pro_price ?>  /-</b></p>
							<a href='index.php'style='float:left;'>Go Back</a>
						</div>
					</div>
					<br>
					</li>
				</ul>
				<div class='row' >
					<div class='col-xs-4 mt-3'>
						<button type='button' name='purchase' class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#staticBackdrop">Purchase</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="staticBackdropLabel">Make Order</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="details.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="owner">Owner</label>
											<input type="text" id="owner" name="owner_name" class="form-control" value="<?php echo $pro_owner_name ?>">
											<input type="text" id="owner_id" name="owner_id" class="form-control" value="<?php echo $pro_owner ?>" hidden>
										</div>
										<div class="form-group">
											<label for="property_id">Property</label>
											<input type="text" name="property_id" value="<?php echo $pro_id ?>" hidden>
											<input type="text" id="property_id" name="prop_id" class="form-control" value="<?php echo $pro_title ?>">
										</div>
										<div class="form-group">
											<label for="type_id">Type</label>
											<select type="text" id="type_id" name="type_id" class="form-control">
											<?php
												$select_type = "select * from types where type_id='$pro_type'";
												$type_query = mysqli_query($con, $select_type);

												while ($rows_type=mysqli_fetch_array($type_query)) {
													$type_title = $rows_type['type_title'];
													$type_id = $rows_type['type_id'];
											?>
												<option value="<?php echo $type_id ?>"><?php echo $type_title ?></option>
											<?php
												}
											?>
											</select>
										</div>
										<div class="form-group">
											<label for="cusotmer">Customer</label>
											<input type="text" name="clients_id" value="<?php echo $_SESSION["id"] ?>" hidden>
											<input type="text" id="client" name="client" class="form-control" value="<?php echo $_SESSION['name'] ?>">
										</div>
										<div class="form-group">
											<label for="price">Price</label>
											<input type="text" name="price" class="form-control" value="<?php echo $pro_price ?>">
										</div>
										<div class="form-group">
											<label for="payment">Payment</label>
											<input type="text" id="payment" name="payment" class="form-control" placeholder="Payment">
										</div>
										<div class="form-group">
											<label for="proof">Proof Of Pay</label>
										
											<input type="file" id="proof" name="proof" class="form-control">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="submit" name="purchase" class="btn btn-primary">Purchase</button>
									</div>
							</form>
							</div>
						</div>
					</div>
				</div>

<?php

	}

	}
?>
		
	</div>


	 <!--  END OF CHECKING DETAILS OF THE SELECTED PROPERTY SECTION -->

	 	 <!-- FOOTER SECTION -->

	 	 <footer class="site-footer">
	 		<?php include 'footer.php' ?>
	 	 </footer>


	 	<!-- END OF THE FOOTER -->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#myslider').carousel();

	}
	);
	</script>
  </body>
</html>
