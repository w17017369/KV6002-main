<?php
//存放session
function setSession($key,$data,$prefix=''){
	session_id() || @session_start();
	if(!empty($prefix)){
		$_SESSION[$prefix][$key]=$data;
	}else{
		$_SESSION[$key]=$data;
	}
}
//获取session
function getSession($key,$prefix=''){
	session_id() || @session_start();
	if(!empty($prefix)){
		// var_dump($_SESSION);die;
		return isset($_SESSION[$prefix][$key]) ? $_SESSION[$prefix][$key] :[];
	}else{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : [];
	}
	
}
//删除session
function deleteSession($key,$prefix=''){
	 @session_start();
	if(!empty($prefix)){
		$_SESSION[$prefix][$key]= null;
	}else{
		$_SESSION[$key]= null;
	}
}


function setInfo($info){
	setSession('info',$info,'stystem');
	// var_dump($_SEESION['system']);die;
}
function getInfo(){
	$info = getSession('info','stystem');
	deleteSession('info','stystem');
	return $info;
}
function hasInfo(){
	// var_dump(getSession('info','stystem'));
	return !empty(getSession('info','stystem'));
}