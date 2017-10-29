<?php
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	//print_r_html($_POST);print_r_html($_FILES);exit;
	
	$connection=db_connect();
	
	$data_array=array();
	foreach($_POST as $item=>$value)
	{
		if($item=="event_date")
		{
			$value=date("Y-m-d H:i:s",strtotime($_POST[$item]));
		}
		$data_array[$item]=$value;
	}
	
	//print_r_html($data_array);exit;
	
	//copy news image	
	if($_FILES['image']['name']!="")
	{
		$image_path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/events/";
	
		$name=$_FILES['image']['name']."-".md5(date("Y/m/d H:i:s")).".png";
		
		$tmp=$_FILES['image']['tmp_name'];
		move_uploaded_file($tmp,$image_path.$name);

	    $image=new SimpleImage(); 
	    $image->load($path.$name); 
	    
	    $image->resizeToWidth(450);
	    $image->save($path.$name);
	    
	    $data_array['image']=$name;
	}
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		$news_id=SQL::insert_sql("events",$data_array,$connection);
	}
	else//update
	{
		SQL::update_sql("events",$data_array,$_POST['id'],$connection);
		$news_id=$_POST['id'];
	}
	
	header("Location:../events/list");
?>