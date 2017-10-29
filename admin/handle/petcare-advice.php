<?php
	include_once "header.php";
	
	//print_r_html($_FILES);exit;
	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST")
	{		
		$extension=explode(".",$_FILES['pdf']['name']);
		$extension=$extension[count($extension)-1];
		
		if(strtolower($extension)!="pdf")
		{
			$_SESSION['update']="pdf_error";
			header("Location:".$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		//copy folio image
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}petcare-advice-pdf/";	
	
		$file_name=$_POST['id'].".pdf";
		
		$tmp=$_FILES['pdf']['tmp_name'];
		//echo $path.$file_name;exit;
		move_uploaded_file($tmp, $path.$file_name);
	}
	
	$_SESSION['update']="success";
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;
?>