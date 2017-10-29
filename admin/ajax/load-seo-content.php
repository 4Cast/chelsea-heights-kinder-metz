<?php
	@session_start();
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	$connection=db_connect();
	
	$page_name=$_POST['page'];
	
	$sql="
		SELECT *
		FROM seo 
		WHERE page_name='$page_name'
	";
	$query=$connection->query($sql);
	$row_seo=$query->fetch(PDO::FETCH_ASSOC);
	
	if($row_seo['meta_description']=="")
	{
		$row_seo['meta_description']=DEFAULT_META_DESCRIPTION;
	}
	if($row_seo['meta_keywords']=="")
	{
		$row_seo['meta_keywords']=DEFAULT_META_KEYWORDS;
	}
	header("Content-type:application/json");
	echo json_encode($row_seo);		
?>