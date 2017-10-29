<?php
	@session_start();
	include_once "../include/db.php";
	include_once "../include/common.php";
	include_once "../include/functions.php";
	include_once "../include/include-classes.php";	
	
	$connection=db_connect();
	
	$id=$_GET['id'];
	
	$sql="DELETE FROM documents WHERE id='$id'";	
	$connection->query($sql);
	
	$_SESSION['deleted']=true;
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;