<?php
	include_once "../../include/db.php";
	include_once "../../include/common.php";
	include_once "../../include/functions.php";
	include_once "../../include/include-classes.php";	
	
	//print_r_html($_POST);
	//print_r_html($_FILES);
	//exit;
	$connection=db_connect();
	
	$data_array=array();
	foreach($_POST as $item=>$value)
	{
		$data_array[$item]=$value;
	}
	
	//print_r_html($data_array);exit;
	
	//IMAGE
	$mugshot=$_FILES['image']['name'];
	
	if($mugshot!="")
	{
		//$mugshot=md5($mugshot.date("Y-m-d H:i:s")).".png";
		$mugshot=md5($data_array['title'].date("Y-m-d H:i:s")).".png";
		$data_array['image']=$mugshot;
			
		//copy product image
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}/images/healthcare-packages/";	
		$tmp=$_FILES['image']['tmp_name'];
		move_uploaded_file($tmp,$path.$mugshot);
		
		/*$image=new SimpleImage();
	    $image->load($_FILES['uploaded_image']['tmp_name']);
	    $image->resizeToWidth(150);
	    $image->output();*/
		
	    $image = new SimpleImage(); 
	    $image->load($path.$mugshot); 
	    //$image->resize(192,213);
	    $image->resizeToWidth(290);
	    $image->save($path.$mugshot);
	    
		//echo $path.$mugshot;
	}
	
	//print_r_html($data_array);
	//exit;
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		$data_array['created']=date("Y-m-d H:i:s");
		SQL::insert_sql("healthcarepackages",$data_array,$connection);
	}
	else//update
	{
		SQL::update_sql("healthcarepackages",$data_array,$_POST['id'],$connection);
	}
	
	header("Location:../healthcare-packages/list");
?>