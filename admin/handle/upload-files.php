<?php	
	@session_start();
	
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	$connection=db_connect();
	
	$extension=explode(".",$_FILES['file']['name']);
	$extension=$extension[count($extension)-1];
	
	$identifier=create_slug($_FILES['file']['name']);
	$identifier=str_ireplace("-".$extension,"",$identifier);
	
	if($_POST['title']=="")//no file title was provided, so use the file name
	{
		//$filename=create_slug($identifier."-".md5(date("y-m-d H:i:s")));
		$filename=create_slug($identifier);
	}
	else 
	{
		$identifier=create_slug($_POST['title']);
		//$filename=create_slug($_POST['title'])."-".md5(date("y-m-d H:i:s"));
		$filename=create_slug($_POST['title']);
	}
	
	$data_array=array();
	$data_array['identifier']=$filename;
	$data_array['filename']=$filename.".".$extension;
	$data_array['created']=date("Y-m-d H:i:s");
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		SQL::insert_sql("documents",$data_array,$connection);
	}
	
	$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}download-documents/";	
	$tmp=$_FILES['file']['tmp_name'];
	move_uploaded_file($tmp,$path.$data_array['filename']);
	//echo $path.$file_name;exit;
	$_SESSION['upload']['success']="File Uploaded";

	header("Location:".$_SERVER['HTTP_REFERER']);
	
?>