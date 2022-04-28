<?php 

require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = $_GET['id'];

$mysqli = connect();

mysqli_query($mysqli, "update cc_order set status='Out Of Stock' where Id=$id");

die("<script>alert('Set Out Of Stock Success!'); window.location='orders.php';</script>");

?>