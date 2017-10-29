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
	
	//copy news image	
	if($_FILES['image']['name']!="")
	{
		$image_path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}images/newsletters/";
	
		$name=$_FILES['image']['name']."-".md5(date("Y/m/d H:i:s")).".png";
		
		$tmp=$_FILES['image']['tmp_name'];
		move_uploaded_file($tmp,$image_path.$name);

	    $image=new SimpleImage(); 
	    $image->load($path.$name); 
	    
	    $image->resizeToWidth(450);
	    $image->save($path.$name);
	    
	    $data_array['image']=$name;
	}
	
	//copy PDF
	if($_FILES['pdf']['name']!="")
	{
		$pdf_file_path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}download-documents/";
	
		$name="newsletter-".md5(date("Y/m/d H:i:s"));
		
		$tmp=$_FILES['pdf']['tmp_name'];
		move_uploaded_file($tmp,$pdf_file_path.$name.".pdf");
	    
	    $data_array['pdf']=$name;
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
	
	header("Location:../newsletters/list");
?>