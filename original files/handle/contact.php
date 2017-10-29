<?php
	@session_start();
	
	include_once "../include/db.php";
	include_once "../include/common.php";
	include_once "../include/functions.php";
	include_once "../include/include-classes.php";	
	
	$data_array=array();
	unset($_SESSION['contact']);
	
	foreach($_POST as $item=>$value)
	{
		if($item!="security_code"&&$item!="x"&&$item!="y")
		{
			$data_array[$item]=$value;
			$_SESSION['contact'][$item]=$value;
		}
	}
	$data_array['date']=date("Y-m-d H:i:s");
	
	//print_r_html($data_array);exit;
	
	if($data_array['name']=="")
	{
		$error=true;
		$_SESSION['contact']['error'].="#empty_name";
	}
	if($data_array['email']=="")
	{
		$error=true;
		$_SESSION['contact']['error'].="#empty_email";
	}
	elseif(!check_email_address($data_array['email']))
	{
		$error=true;
		$_SESSION['contact']['error'].="#invalid_email";
	}	
	if($data_array['comment']=="")
	{
		$error=true;
		$_SESSION['contact']['error'].="#empty_comment";
	}
	if($_POST['security_code']=="")
	{
		$_SESSION['contact']['error'].="#empty_security_code";
		$error=true;
	}
	if($_SESSION['security_code']!=$_POST['security_code'])  //invalid security code was provided
	{
		$_SESSION['contact']['error'].="#invalid_security_code";
		$error=true;
	}
	
	
	if(!$error)
	{
		$connection=db_connect();
			
		SQL::insert_sql("contacts",$data_array,$connection);
		
		$email_subject=$data_array['name']." has sent a message.";
		
		$email_content="
			<table>
				<tr>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;text-align:right;'>Name : </td>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;'>$data_array[name]</td>
				</tr>
				<tr>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;text-align:right;'>Email : </td>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;'>$data_array[email]</td>
				</tr>
				<tr>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;text-align:right;'>Phone : </td>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;'>$data_array[phone]</td>
				</tr>
				<tr>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;text-align:right;'>Message : </td>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;'>$data_array[comment]</td>
				</tr>
				<tr>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;text-align:right;'>Message sent : </td>
					<td style='font-family:Arial,Helvetica,sans-serif;font-size:14px;'>".date("d/M/Y H:i a")."</td>
				</tr>
			</table>
		";
		
		$email_array=array();
		$email_array['email_from']=$data_array['email'];
		$email_array['email_from_name']=$data_array['name'];
		$email_array['subject']=$email_subject;
		$email_array['content']=$email_content;	
		
		$email_array['email_to']=EMAIL_TO;
		$email_obj=new Mail(0,$email_array,$conneciton);
		$email_obj->send();	
		
		$email_array['email_to']=SECONDARY_EMAIL_TO;
		$email_obj=new Mail(0,$email_array,$conneciton);
		$email_obj->send();
		
		unset($_SESSION['contact']);
		$_SESSION['update']=true;
	}
	
	//print_r_html($data_array);exit;
	
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit;