<?php	
	@session_start();
	
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	print_r_html($_POST);
	print_r_html($_FILES);
	//exit;
	
	$index=0;
	foreach($_FILES['file']['name'] as $file_name)
	{
		if($file_name!="")
		{
			//check if it's PDF 
			$extension=explode(".",$file_name);
			if($extension[count($extension)-1]!="pdf")
			{
				echo $index." incorrect file type<br />";
			}
			else//all good, upload
			{
				$file_name=$_POST['id'][$index].".pdf";
					
				$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}download-documents/";	
				$tmp=$_FILES['file']['tmp_name'][$index];
				move_uploaded_file($tmp,$path.$file_name);
				$_SESSION['upload'][$index]['success']="File Uploaded";
			}
		}
		$index++;
	}
	
	header("Location:".$_SERVER['HTTP_REFERER']);