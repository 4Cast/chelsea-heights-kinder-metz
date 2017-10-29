<?php
	@session_start();
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	$connection=db_connect();
	
	$sql="
		UPDATE around_the_globe 
		SET order_by='$_POST[priority]'
		WHERE id='$_POST[id]'
	";
	$connection->query($sql);
?>