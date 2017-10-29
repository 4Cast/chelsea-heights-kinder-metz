<?php
	@session_start();
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	$connection=db_connect();
	
	$details_array=array();
	$details_array['order_by']=$_POST['priority'];
	$details_array['text']=$_POST['text'];
	
	SQL::update_sql("home_page_animation",$details_array,$_POST['id'],$connection);
	
?>