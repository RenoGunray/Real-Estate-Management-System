<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>makao bora</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

  </head>
  <body>
   <div class="container">
	<div class="row mt-5">
		<div class="col-md-4 col-md-offset-4 well m-auto">
			<form role="form" action="adding-property-type.php" method="post">
				<fieldset>
					<legend>Login</legend>

					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Your Email" required class="form-control" />
					</div>
					
					<div class="form-group">
							<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
				<span class="text-danger"><?php //if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
        <div class="col-md-4 col-md-offset-4 text-center m-auto">
        New User? <a href="sign_up.php">Sign Up Here</a>
        </div>
    </div>
   </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>