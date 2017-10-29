<?php
	@session_start();
	if(!$_SESSION['logged_in'])
	{
		header("Location:login.php");
		exit;
	}
	
	include_once "../include/db.php";
	include_once "../include/common.php";
	include_once "../include/functions.php";
	include_once "../include/include-classes.php";	
	$connection=db_connect();
	
	ini_set('display_errors',0);
	ini_set("error_reporting",E_ALL);
	
	$default_path="../";
	$admin_path="";
	
	if
	(
		!stristr($_SERVER['REQUEST_URI'],'/admin/newsletters/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/events/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/page-tiles/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/content/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/staff/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/services/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/healthcare-packages/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/community/')===FALSE||
		!stristr($_SERVER['REQUEST_URI'],'/admin/general/')===FALSE||		
		!stristr($_SERVER['REQUEST_URI'],'/admin/enrolment-pdfs/')===FALSE||		
		!stristr($_SERVER['REQUEST_URI'],'/admin/gallery/')===FALSE
	)
	{
		$admin_path="../../";
		$default_path="../../";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo SLOGAN;?> CMS Admin</title>
		
	  	<script src="<?php echo $default_path;?>js/jquery-1.7.2.min.js"></script>
		
		<link type="text/css" href="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" />	
		
		<link rel="stylesheet" href="<?php echo $default_path;?>include/foundation5/css/foundation.css">	
		<link rel="stylesheet" href="<?php echo $default_path;?>admin/css/admin-style.css">
		
	  	<script src="<?php echo $default_path;?>js/jquery-ui.min.js"></script>
	  	<script src="<?php echo $default_path;?>js/common.js"></script>
		
		<link rel="stylesheet" href="<?php echo $default_path;?>css/superfish.css" media="screen">
		<script src="<?php echo $default_path;?>js/hoverIntent.js"></script>
		<script src="<?php echo $default_path;?>js/superfish.js"></script>
		
		
	  	<script type="text/javascript" src="<?php echo $default_path;?>js/browser-detect.js"></script>
	  	<script type="text/javascript" src="<?php echo $default_path;?>include/foundation5/js/foundation/foundation.js"></script>
	  	
  		<script type="text/javascript" src="<?php echo $default_path;?>include/foundation5/js/foundation/foundation.reveal.js"></script>
	  	
	  	<script src='<?php echo $default_path;?>include/ckeditor4/ckeditor.js'></script>
	  	
	  	<script src="<?php echo $default_path;?>admin/script.js"></script>
	  	
	  	<script src="<?php echo $default_path;?>js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
	  	
		<script src="<?php echo $default_path;?>js/jdatetimepicker/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $default_path;?>js/jdatetimepicker/jquery.datetimepicker.min.css"/>
		
		<script>

		(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function()
			{
				$('.datetimepicker').datetimepicker();
				
				// initialise plugin
				var example = $('.superfish').superfish
				({
					//add options here if required
				});

				// buttons to demonstrate Superfish's public methods
				$('.destroy').on('click', function()
				{
					example.superfish('destroy');
				});

				$('.init').on('click', function()
				{
					example.superfish();
				});

				$('.open').on('click', function()
				{
					example.children('li:first').superfish('show');
				});

				$('.close').on('click', function()
				{
					example.children('li:first').superfish('hide');
				});
			});
		})(jQuery);
		</script>
	</head>
	<body>
		<div id="top-row">
			<ul class="sf-menu superfish">
				<li><a href="<?php echo $default_path;?>admin">Home</a></li>
				
				<li>
					<a href="<?php echo $default_path;?>admin/page-tiles">Page Tiles</a>
					<ul>
						<li><a href="<?php echo $default_path;?>admin/page-tiles/home">Home Page</a></li>
					</ul>
				</li>
				
				<li class="current">
					<a href="#">Page Content</a>
					<ul>
						<?php 
							$page_content=SQL::get_page_content_details($connection);
							foreach($page_content as $page)
							{
								echo '<li><a href='.$default_path.'admin/content/'.$page[page_name].'>'.ucwords(str_ireplace("-"," ",$page['page_name']))."</a></li>";
							}
						?>
					</ul> 
				</li>
				
				<li>
					<a href="#">Enrolment PDFs</a>
					
					<ul>
						<li><a href="<?php echo $default_path;?>admin/enrolment-pdfs/3">3 Year Old Enrolments</a></li>
						<li><a href="<?php echo $default_path;?>admin/enrolment-pdfs/4">4 Year Old Enrolments</a></li>
					</ul>
				</li>
				
				<li>
					<a href="#">Newsletters</a>
					<ul>
						<li><a href="<?php echo $default_path;?>admin/newsletters/list">Newsletters</a></li>
						<li><a href="<?php echo $default_path;?>admin/newsletters/add">Add new item</a></li>
					</ul>
				</li>
				
				<li><a href="<?php echo $default_path;?>admin/upload">Upload Files (PDF)</a></li>
				
				<li>
					<a href="#">Events</a>
					<ul>
						<li><a href="<?php echo $default_path;?>admin/events/list">Events</a></li>
						<li><a href="<?php echo $default_path;?>admin/events/add">Add new event</a></li>
					</ul>
				</li>
				
				<li><a href="<?php echo $default_path;?>admin/gallery">Gallery</a></li>
				
				<li><a target="_blank" href="<?php echo $default_path;?>">View Site</a></li>
				<li><a href="<?php echo $default_path;?>admin/logout">Log out</a></li>
			</ul>
		</div>