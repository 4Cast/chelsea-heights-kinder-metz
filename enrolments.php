<?php
	include_once 'include/header.php';
	
	$page=$_REQUEST['page'];
	$display_tilte=$page;

	$display_tilte=ucwords(str_ireplace("-"," ",$display_tilte));
	
	if($display_tilte=="3 Year Old Enrolments")
	{
		$display_tilte="3 Year-old Enrolments";
	}
	if($display_tilte=="4 Year Old Enrolments")
	{
		$display_tilte="4 Year-old Enrolments";
	}
?>
	<div class="heading box-shadow">
		<div class="row">
			<div class="large-12 medium-12 small-12 column">
				<h2><?php echo $display_tilte;?></h2>
			</div>
		</div>
	</div>
	
	<div class="content-with-background">
		<div class="row white-background">
			<div class="content-area columns large-12 medium-12 small-12">
				<?php 
					if($page=="3-year-olds-enrolments")
					{
						
					}
					else if($page=="4-year-olds-enrolments")
					{
						
					}
					echo SQL::get_page_content($page,$connection);
				?>
			</div>
		</div>
	</div>

<?php
	include_once 'include/footer.php';
?>