<?php
session_start();
include 'includes/db.php';

function get_property_types ()
{
  global $con;
  $select = "select * from categories";
  $query = mysqli_query( $con, $select );

 
?>

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
  $u_id = $_SESSION['idno'];
  $select = "select * from customer where customer_id='$u_id'";
  $query = mysqli_query($con, $select);

?>

<table class="table border">
  <tbody>
    <?php 
      while($rows=mysqli_fetch_array($query))
      {
        $name = $rows['customer_name'];
        $gender = $rows['customer_gender'];
        $contact = $rows['customer_contacts'];
        $email = $rows['customer_email'];
        $balance = $rows['customer_balance'];
      
    ?>
    <tr>
      <td><?php echo $name ?></td>
    </tr>
    <tr>
      <td><?php echo $gender ?></td>
    </tr>
    <tr>
      <td><?php echo $contact ?></td>
    </tr>
    <tr>
      <td><?php echo $email ?></td>
    </tr>
    <tr>
      <td><?php echo $balance ?></td>
    </tr>
    <?php }//End while loop ?>
  </tbody>
</table>

<?php
}//End user detail function

?>

