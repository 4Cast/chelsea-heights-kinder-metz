<?php
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	//print_r_html($_POST);
	//print_r_html($_FILES);exit;
	$connection=db_connect();
	
	$data_array=array();
	foreach($_POST as $item=>$value)
	{
		$data_array[$item]=$value;
	}
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		$news_id=SQL::insert_sql("news",$data_array,$connection);
	}
	else//update
	{
		SQL::update_sql("news",$data_array,$_POST['id'],$connection);
		$news_id=$_POST['id'];
	}
	
	//IMAGES
	$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/news/$news_id/";
	@mkdir("$path",0777);
	$index=0;
	
	if($_FILES['images']['name'][0]!="")
	{
		$files=glob("$path*"); // get all file names
		foreach($files as $file)
		{
			if(is_file($file))
			{
		    	unlink($file); // delete file
			}
		}
	}
			
	foreach($_FILES['images']['name'] as $name)
	{
		if($name!="")
		{
			//echo $name."<br />";
			
			//copy product image	
			$tmp=$_FILES['images']['tmp_name'][$index];
			move_uploaded_file($tmp,$path.$name);

		    $image = new SimpleImage(); 
		    $image->load($path.$name); 
		    //$image->resizeToWidth(305);
		    $image->resize(305,210);
		    $image->save($path.$name);
		    
			//echo $path.$name."<br />";
		}
		$index++;
	}
	header("Location:../news/".$news_id);
?>