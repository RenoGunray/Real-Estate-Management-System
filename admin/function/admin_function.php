<?php
session_start();
include 'includes/db.php';


function getClient()
{
		global $con;
	$get_client="select * from clients";

				$run_client=mysqli_query($con, $get_client);

				while($row_client = mysqli_fetch_array($run_client)){

					$client_id=$row_client['client_id'];
					$client_title=$row_client['client_title'];
					echo "<option value='$client_id'>$client_title</option>";
				}

}

function get_property_types ()
{
  global $con;
  $select = "select * from categories";
  $query = mysqli_query( $con, $select );

 
?>

<div class="mb-3">
<form role="form" action="property-type.php" method="post">
  <div class="form-group d-flex">
    <input type="text" name="cat-name" placeholder="New Category" required class="form-control me-3" />
    <button type="submit" name="new-cat" class="btn btn-primary">Add</button>
  </div>
</form>

<?php
// add a new category

if (isset($_POST['new-cat'])) {

  if (!empty($_POST['cat-name'])) {
    $cat_name = $_POST['cat-name'];

    $insert = "insert into categories (cat_title) values ('$cat_name')";
    $in_query = mysqli_query($con, $insert);

    if ($in_query) {
      echo "<p><strong>Success!!</strong></p>";
      header ('location:property-type.php');
    }

  }

}

?>
</div>

<table class="table border">
  <thead>
    <tr>
      <th>id #</th>
      <th>Category</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while ($rows=mysqli_fetch_array( $query ))
      {
        $category_name = $rows['cat_title'];
        $category_id = $rows['cat_id'];
    
    ?>
    <tr>
      <td><?php echo $category_id ?></td>
      <td><?php echo $category_name ?></td>
    </tr>
    <?php
      } //End while loop
    ?>
  </tbody>
</table>

<?php
}//End property type function


function get_user_details ()
{
  global $con;
  $name = $_SESSION['name'];
  $u_id = $_SESSION['id'];
  $select = "select * from customer where customer_id='$u_id'";
  $query = mysqli_query($con, $select);

?>

<table class="table table-bordered border">
  <tbody>
    <tr>
      <th>Name: </th>
      <td><?php echo $name ?></td>
    </tr>
    <tr>
      <th>Contact: </th>
      <td><?php echo $_SESSION['contacts'] ?></td>
    </tr>
    <tr>
      <th>Email: </th>
      <td><?php echo $_SESSION['email']; ?></td>
    </tr>
    <tr>
      <th>Gender: </th>
      <td><?php echo $_SESSION['gender'] ?></td>
    </tr>
    <tr>
      <th>Balance: </th>
      <td><?php echo $_SESSION['balance'] ?></td>
    </tr>
  </tbody>
</table>

<?php
}//End user detail function

function get_all_property() {
  global $con;
  $select_property = "select * from property, categories, types, customer where property.property_cat=categories.cat_id and property.property_type=types.type_id and property.property_owner=customer.customer_id";

  $property_query = mysqli_query($con, $select_property);

?>


<table class="table table-bordered border">
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Type</th>
      <th>Category</th>
      <th>Owner</th>
      <th>Description</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while ($rows=mysqli_fetch_array($property_query)) {
        $property_id = $rows['property_id'];
        $title = $rows['property_title'];
        $type = $rows['type_title'];
        $category = $rows['cat_title'];
        $owner = $rows['customer_name'];
        $description = $rows['property_desc'];
        $price = $rows['property_price'];
    
    ?>
    <tr>
      <td><?php echo $property_id ?></td>
      <td><?php echo $title ?></td>
      <td><?php echo $type ?></td>
      <td><?php echo $category ?></td>
      <td><?php echo $owner ?></td>
      <td><?php echo $description ?></td>
      <td><?php echo $price ?></td>
    </tr>

    <?php
      }//end while loop
    ?>
  </tbody>
</table>

<?php
}// end function

?>

<?php
function get_my_property() {
  global $con;
  $select_my_property = "select * from property, categories, types, customer where property.property_cat=categories.cat_id and property.property_type=types.type_id and property.property_owner=customer.customer_id and property.property_owner='".$_SESSION['id']."'";

  $my_property_query = mysqli_query($con, $select_my_property);

?>


<table class="table table-bordered border">
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Type</th>
      <th>Category</th>
      <th>Owner</th>
      <th>Description</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while ($rows=mysqli_fetch_array($my_property_query)) {
        $my_property_id = $rows['property_id'];
        $my_title = $rows['property_title'];
        $my_type = $rows['type_title'];
        $my_category = $rows['cat_title'];
        $my_owner = $rows['customer_name'];
        $my_description = $rows['property_desc'];
        $my_price = $rows['property_price'];
    
    ?>
    <tr>
      <td><?php echo $my_property_id ?></td>
      <td><?php echo $my_title ?></td>
      <td><?php echo $my_type ?></td>
      <td><?php echo $my_category ?></td>
      <td><?php echo $my_owner ?></td>
      <td><?php echo $my_description ?></td>
      <td><?php echo $my_price ?></td>
    </tr>

    <?php
      }//end while loop
    ?>
  </tbody>
</table>

<?php

}

function get_my_orders() {

  global $con;
  
  $select_orders = "select * from customer, property, purchases where purchases.clients_id=customer.customer_id and purchases.property_id=property.property_id and purchases.clients_id='".$_SESSION['id']."'";
  
  $query_orders = mysqli_query($con, $select_orders);

?>

<table class="table table-bordered border">
  <thead>
    <tr>
      <th>Property ID</th>
      <th>Title</th>
      <th>Price</th>
      <th>Proof of pay</th>
    </tr>
  </thead>

  <tbody>
    <?php
      while ($rows=mysqli_fetch_array($query_orders)) {
        $property_id = $rows['property_id'];
        $property_title = $rows['property_title'];
        $property_price = $rows['property_price'];
        $proof = $rows['proof_of_pay'];

    ?>

    <tr>
      <td><?php echo $property_id ?></td>
      <td><?php echo $property_title ?></td>
      <td><?php echo $property_price ?></td>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          view proof of pay
        </button>
      </td>
    </tr>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">proof of pay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="../payments/<?php echo $proof ?>" alt="proof of pay" style="width:100px;">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>

    <?php

      }
    
    ?>
  </tbody>
</table>

<?php

}

function get_all_orders () {

  global $con;

  $select_all_orders = "select * from customer, property, purchases where purchases.clients_id=customer.customer_id and purchases.property_id=property.property_id";

  $query_all_orders = mysqli_query($con, $select_all_orders);


?>


<table class="table table-bordered border">
  <thead>
    <tr>
      <th>Property ID</th>
      <th>Title</th>
      <th>Price</th>
      <th>Proof of pay</th>
    </tr>
  </thead>

  <tbody>
    <?php
      while ($rows=mysqli_fetch_array($query_all_orders)) {
        //the 'a' at the beginiing stand for 'all'
        $a_property_id = $rows['property_id'];
        $a_property_title = $rows['property_title'];
        $a_property_price = $rows['property_price'];
        $a_proof = $rows['proof_of_pay'];

    ?>

    <tr>
      <td><?php echo $a_property_id ?></td>
      <td><?php echo $a_property_title ?></td>
      <td><?php echo $a_property_price ?></td>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          view proof of pay
        </button>
      </td>
    </tr>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">proof of pay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="../payments/<?php echo $a_proof ?>" alt="proof of pay" style="width:100px;">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>

    <?php

      }
    
    ?>
  </tbody>
</table>


<?php

}


function get_all_users() {

  global $con;
  $select_all_users = "select * from clients, customer where customer.customer_type=clients.client_id";

  $all_user_query = mysqli_query($con, $select_all_users);
?>

  <table class="table table-bordered border">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Gender</th>
        <th>User Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
      while($rows=mysqli_fetch_array($all_user_query)) {

        $name = $rows['customer_name'];
        $email = $rows['customer_email'];
        $contact = $rows['customer_contacts'];
        $gender = $rows['customer_gender'];
        $type = $rows['client_title'];
        $u_id = $rows['customer_id'];

    ?>

      <tr>
        <td><?php echo $u_id ?></td>
        <td><?php echo $name ?></td>
        <td><?php echo $email ?></td>
        <td><?php echo $contact ?></td>
        <td><?php echo $gender ?></td>
        <td><?php echo $type ?></td>
        <td><a href="edit-users.php?u_id=<?php echo $u_id ?>">&#9998 Edit</a></td>
      </tr>

    <?php

      }
    ?>
    </tbody>
  </table>


<?php  

}

function client_orders() {

  global $con;

  $order_select = "select * from customer, property, purchases where purchases.clients_id=customer.customer_id and purchases.property_id=property.property_id and purchases.owner_id='".$_SESSION['id']."'";

  $order_query = mysqli_query($con, $order_select);

?>


<table class="table table-bordered border">
  <thead>
    <tr>
      <th>Property</th>
      <th>Client</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while ($rows=mysqli_fetch_array($order_query)){
        $property = $rows['property_title'];
        $price = $rows['property_price'];
        $client = $rows['customer_name'];

    ?>

    
    <tr>
      <td><?php echo $property ?></td>
      <td><?php echo $client ?></td>
      <td><?php echo $price ?></td>
    </tr>

    <?php

      }
    
    ?>
  </tbody>
</table>

<?php

}

?>
