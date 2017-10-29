<?php
	include_once "header.php";
	
	//print_r_html($_REQUEST);exit;
	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST")
	{		
		$image_data_array=array();
		
		if($_FILES['image']['name']!="")
		{
			$image_name=md5($_FILES['image']['name'].date("Y-m-d H:i:s")).".png";
			$image_data_array['image']=$image_name;
		}
		
		$image_data_array['url']=$_POST['url'];
		$image_data_array['text']=$_POST['text'];
		//$image_data_array['order_by']=$_POST['order_by'];
		//$image_data_array['background_color']=$_POST['background_color'];
		
		SQL::update_sql("image_tiles",$image_data_array,$_POST['id'],$connection);
		
		//copy folio image
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/image-tiles/";	
	
		$tmp=$_FILES['image']['tmp_name'];
		move_uploaded_file($tmp, $path.$image_name);
	}
	
	$_SESSION['update']=true;
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;
?>