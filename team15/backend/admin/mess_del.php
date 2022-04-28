<?php

require '../db.func.php';
require '../toos.func.php';

$id = intval($_GET['id']);

$prefix = getDBPregix();
$sql ="DELETE FROM topic WHERE id = '$id'";

if(execute($sql)){
	setInfo('Delete Successful');
}else{
	setInfo('Delete Failed');
}
header('location:mess.php');
