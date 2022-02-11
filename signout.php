<?php
session_start();
$name = $_SESSION['idno'];
unset($name);
session_destroy();
header("location: index.php");

?>