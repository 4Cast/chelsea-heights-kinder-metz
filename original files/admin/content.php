<?php 
	include_once "header.php";
	$page=$_GET['page'];

	$sql="
		SELECT *
		FROM page_descriptions
		WHERE page_name=\"$page\"
	";
	$query=$connection->query($sql);
	$row=$query->fetch(PDO::FETCH_ASSOC);
?>
	<div class="main-content" id="blurb">
      	<div class="row">				
			<div class="small-12 large-12 columns">
				<?php 
					if($_SESSION['update']!="")
					{
						echo "<div class='success-class'>";
						if($_SESSION['update'])
						{
							echo "Updated";
						}
						echo "</div>";
						
						unset($_SESSION['update']);
					}
				?>
				<fieldset>
					<legend>Page = <?php echo str_ireplace("-"," ",ucwords($page));?></legend>
					<p>When editing content please do not cut and past directly from a word or PDF doc into the CMS as this will also bring across other html styles that may effect the correct layout style of your page. If you need to cut and paste from another document please then cut and paste again into an editor such as windows notepad, and then copy that content from notepad and paste into the CMS, or simply edit directly through the CMS editor for non cut and paste practices.</p>
					<form action="<?php echo $default_path;?>admin/handle/content.php" method="post">
						<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
						<textarea class="ckeditor" rows="10" cols="5" name="content"><?php echo SQL::get_page_content($page,$connection);?></textarea>
						<input class="button" type="submit" value="Update Content" />
					</form>
				</fieldset>
			</div>
		</div>
	</div>