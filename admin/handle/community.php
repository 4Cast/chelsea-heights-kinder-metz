<?php
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	//print_r_html($_POST);
	//print_r_html($_FILES);
	//exit;
	$connection=db_connect();
	
	$data_array=array();
	foreach($_POST as $item=>$value)
	{
		$data_array[$item]=$value;
	}
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		SQL::insert_sql("community_links",$data_array,$connection);
	}
	else//update
	{
		SQL::update_sql("community_links",$data_array,$_POST['id'],$connection);
	}
	
	header("Location:../community/list");
?>