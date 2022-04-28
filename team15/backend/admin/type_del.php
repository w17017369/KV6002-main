<?php

require '../db.func.php';
require '../toos.func.php';

$id = intval($_GET['id']);

$prefix = getDBPregix();
$sql ="DELETE FROM {$prefix}type WHERE id = '$id'";

if(execute($sql)){
	setInfo('Delete Success');
}else{
	setInfo('Delete Failed');
}
header('location:type.php');
