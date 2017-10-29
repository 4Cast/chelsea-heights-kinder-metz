<?php
	include_once "header.php";
	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST")
	{		
		$image_name=md5($_FILES['image']['name'].date("Y-m-d H:i:s")).".png";
		
		$image_data_array=array();
		$image_data_array['image']=$image_name;
		$image_data_array['link']=$_POST['link'];
		$image_data_array['background_color']=$_POST['background_color'];
		$image_data_array['text']=$_POST['text'];
		$image_data_array['order_by']=$_POST['order_by'];
		
		SQL::insert_sql("home_page_animation",$image_data_array,$connection);
		
		//copy folio image
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/home/";	
	
		$tmp=$_FILES['image']['tmp_name'];
		move_uploaded_file($tmp, $path.$image_name);
	}
	
	$_SESSION['update']=true;
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;
?>