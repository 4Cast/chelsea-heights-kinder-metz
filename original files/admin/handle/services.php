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
	
	//PDF
	$pdf=$_FILES['pdf']['name'];
	
	if($pdf!="")
	{
		$pdf=md5($data_array['name'].date("Y-m-d H:i:s")).".pdf";
		$data_array['pdf']=$pdf;
			
		//copy product image
		$path=$_SERVER['DOCUMENT_ROOT']."{$absolute_path}/services/";	
		$tmp=$_FILES['pdf']['tmp_name'];
		move_uploaded_file($tmp,$path.$pdf);
		//echo $path.$pdf;exit;
	}
	
	//print_r_html($data_array);
	//exit;
	
	if($_POST['id']==""||$_POST['id']==0)//insert
	{
		SQL::insert_sql("services",$data_array,$connection);
	}
	else//update
	{
		SQL::update_sql("services",$data_array,$_POST['id'],$connection);
	}
	
	header("Location:../services/list");
?>