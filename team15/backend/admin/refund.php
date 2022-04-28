<?php
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = $_GET['id'];
$prefix = getDBPregix();
$sql = "UPDATE `cc_order` SET `pay_status` = -1 WHERE `Id` = {$id}";
$res = query($sql);

die("<script>alert('Refund successful!'); window.location='orderDetails.php?id=' + {$id};</script>");

