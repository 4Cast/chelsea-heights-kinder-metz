<?php 
	include_once "header.php";
	$page=$_GET['page'];

	$sql="
		SELECT *
		FROM gallery
		ORDER BY priority ASC
	";
	$query=$connection->query($sql);
	$rows=$query->fetchAll(PDO::FETCH_ASSOC);
?>
	<div class="main-content" id="gallery">
      	<div class="row">				
			<div class="small-12 large-12 columns">
				<fieldset>
	      			<form id="display-gallery-form" method="post" enctype="multipart/form-data" action='<?php echo $default_path;?>admin/handle/gallery.php'>      	
	      				<p>Upload image here (960px X 480px)</p>
	      				<input type="file" name="gallery" id="gallery" />
	      				<input type="text" name="description" placeholder="Description" />
	      				<input type="text" name="priority" placeholder="Priority" />
	      				<div align="right"><input class="button" type="submit" value="Submit" /></div>
					</form>
				</fieldset>
				
				<table style="width:100%:">
					<?php
						if($_SESSION['gallery']!="")
						{
							echo "";
							if($_SESSION['gallery']['message']=="Image uploaded")
							{
								echo "<div class='success-class'>Image uploaded</div>";
							}
							else
							{
								echo "<div class='error-class'>".$_SESSION['gallery']['message']."</div>";
							}
							
							unset($_SESSION['gallery']);
						}
						
						foreach($rows as $row)
						{
							echo "
								<tr>
									<td>$row[priority]</td>
									<td><img width='200' src='{$default_path}images/gallery/$row[image_name]' /></td>
									<td>$row[description]</td>
									<td>
										<a class='delete' href='delete-gallery-image.php?id=$row[id]'><img src='{$default_path}images/icons/no.png' /> Delete image</a>
										<a class='edit' href='gallery/$row[id]'><img src='{$default_path}images/icons/edit.png' /> Edit image</a>
									</td>
								</tr>
							";
						}
					?>
				</table>
			</div>
		</div>
	</div>
<?php 
	include_once 'include/footer.php';
?>