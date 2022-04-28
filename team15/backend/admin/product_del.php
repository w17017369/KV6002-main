<?php

require '../db.func.php';
require '../toos.func.php';

$id = intval($_GET['id']);

$prefix = getDBPregix();
$sql ="DELETE FROM {$prefix}products WHERE proid = '$id'";

if(execute($sql)){
	setInfo('Delete Success');
}else{
	setInfo('Detele failed');
}
header('location:products.php');
