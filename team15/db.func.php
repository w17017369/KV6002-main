<?php  


//Database connection
function connect()
{
	//Set the time zone
	// date_default_timezone_set(timezone_identifier:'PRC');
	$config = require dirname(__FILE__) .'/config.php';
	$mysqli = @mysqli_connect(
	  $config['DB_HOST'] . ':' . $config['DB_PORT'],
	  $config['DB_USER'],
	  $config['DB_PASS'],
	  $config['DB_NAME']
	)or die('Connect Error:' .mysqli_connect_errno() . '-' .mysqli_connect_error());
	mysqli_set_charset($mysqli,$config['DB_CHARSET']);
	return $mysqli;
}
//Querying a piece of data
function queryOne($sql){
	$mysqli = connect();
	$result = mysqli_query($mysqli,$sql);
	$data =[];
	if($result && mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_assoc($result);
	}
	return $data;
}
//Querying multiple pieces of data
function query($sql){
	$mysqli = connect();
	$result = mysqli_query($mysqli,$sql);
    $data=[];
	if($result && mysqli_num_rows($result) > 0){
		while($res =mysqli_fetch_assoc($result) ){
			$data[]= $res;
		}
	}
	return $data;
}


//Get table prefix
function getDBPregix(){
	$config =  require dirname(__FILE__) . '/config.php';
	return $config['DB_PREFIX'];
}


//Revision update
function execute($sql){
	$mysqli = connect();
	mysqli_query($mysqli,$sql);	
	return mysqli_affected_rows($mysqli)>0;
}
