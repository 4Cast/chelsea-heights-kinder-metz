<?php
	@session_start();
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
		
	$return_url=$_SERVER['HTTP_REFERER'];		
			
	//print_r_html($_FILES);print_r_html($_POST);
	
	$connection=db_connect();
		
	$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/gallery/";	
	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST")
	{
		$name=$_FILES['gallery']['name'];
		$size=$_FILES['gallery']['size'];		
		
		//if(strlen($name))
		
		$image_data_array=array();
		if($name!="")
		{
			$actual_image_name=md5(date("Y-m-d H:i:s")).".png";
			$image_data_array['image_name']=$actual_image_name;
		}
		$image_data_array['description']=$_POST['description'];
		$image_data_array['priority']=$_POST['priority'];
		
		
		//print_r_html($image_data_array);exit;
		if($_POST['id']!=""||$_POST['id']!=0)//EDIT
		{
			$folio_images_id=$_POST['id'];
			SQL::update_sql("gallery",$image_data_array,$folio_images_id,$connection);
			$return_url="../gallery";
		}
		else
		{
			$image_data_array['created']=date("Y-m-d H:i:s");
			$folio_images_id=SQL::insert_sql("gallery",$image_data_array,$connection);		
			$return_url=$_SERVER['HTTP_REFERER'];		
		}
		
		if($actual_image_name!="")
		{
			$tmp=$_FILES['gallery']['tmp_name'];
			if(move_uploaded_file($tmp, $path.$actual_image_name))
			{
			    $image = new SimpleImage(); 
			    $image->load($path.$actual_image_name);
			    //$image->resizeToWidth(624);
	   		 	$image->resize(960,480);
			    $image->save($path.$actual_image_name);
			    
				$_SESSION['gallery']['message']="Image uploaded";					
			}
			else
			{					
				$_SESSION['gallery']['message']="Something went wrong, please try again!";
			}
		}
		/*	}
			else
			{
				$_SESSION['gallery']['message']="Image is too big, must be under 10mbs";
			}
		}
		else
		{
			$_SESSION['gallery']['message']="Please select image to upload";
		}*/
	}
	header("Location:".$return_url);
?>