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

?>

