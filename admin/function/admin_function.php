<?php
session_start();
include 'includes/db.php';

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
