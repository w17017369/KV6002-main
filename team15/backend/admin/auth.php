<?php 

if(empty(getSession('adminuser','admin'))){
	header('location:login.php');
	exit;
}