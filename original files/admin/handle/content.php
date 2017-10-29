<?php
	@session_start();
	
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	$connection=db_connect();
	
	$_POST['modified']=date("Y-m-d H:i:s");
	SQL::update_sql("page_descriptions",$_POST,$_POST['id'],$connection);
	
	$_SESSION['update']=true;
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;
?>