<?php	
	@session_start();
	
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	//print_r_html($_POST);
	//print_r_html($_FILES);
	
	$times=array("spring","autumn","winter","summer");
	foreach($times as $time)
	{
		if($_FILES[$time]['name']!="")
		{
			$type=$time;
			break;
		}
	}
	
	$extension=explode(".",$_FILES[$type]['name']);
	//print_r_html($extension);
	//exit;
	if($extension[count($extension)-1]!="pdf")
	{
		$_SESSION['upload']['error']="File must be a PDF file";
	}
	else
	{
		$file_name=$type;
		if($file_name!="")
		{
			$file_name=$file_name.".pdf";
				
			$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}pdf/";	
			$tmp=$_FILES[$type]['tmp_name'];
			move_uploaded_file($tmp,$path.$file_name);
			//echo $path.$file_name;exit;
			$_SESSION['upload']['success']="File Uploaded";
		}
	}
	header("Location:".$_SERVER['HTTP_REFERER']);