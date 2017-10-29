<?php
	@session_start();
	
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	$connection=db_connect();
	
	//print_r_html($_POST);print_r_html($_FILES);exit;
	if($_FILES['image']['name']!="")
	{
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/contact/";	
	
		$file_name="contact-Rosebud-Pet-Vet.png";
		
		$tmp=$_FILES['image']['tmp_name'];
		//echo $path.$file_name;exit;
		move_uploaded_file($tmp, $path.$file_name);
	}
	else
	{
		$count=count($_POST);
		$i=1;
		
		$sql="UPDATE contact SET ";
		foreach($_POST as $key=>$value)
		{
			$sql.="$key='$value'";
			if($i<$count)
			{
				$sql.=",";	
			}
			$i++;
		}
		$sql=$sql." WHERE type='$_POST[type]'";
		$connection->query($sql);
	}
	
	$_SESSION['update']=true;
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;
?>