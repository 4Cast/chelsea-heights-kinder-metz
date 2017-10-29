<?php 
	include_once "header.php";
	$id=$_GET['id'];

	$sql="
		SELECT *
		FROM gallery
		WHERE id='$id'
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
					<legend>Gallery Item Edit</legend>
					<form action="<?php echo $default_path;?>admin/handle/gallery.php" enctype="multipart/form-data" method="post">
						<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
						<table>
							<tr>
								<td>
									<p>Upload image here (960px X 480px)</p>
	      							<input type="file" name="gallery" id="gallery" />
									<img src='<?php echo $default_path;?>images/gallery/<?php echo $row['image_name'];?>' />
								</td>
							</tr>
							
							<tr>
								<td>
									Description:
									<input type="text" name="description" value="<?php echo $row['description'];?>" />
								</td>
							</tr>
							
							<tr>
								<td>
									Priority:
									<input type="text" name="priority" value="<?php echo $row['priority'];?>" />
								</td>
							</tr>
							
							<tr>
								<td>
									<input class="button" type="submit" value="Update Gallery Item" />
								</td>
							</tr>
						</table>
						
					</form>
				</fieldset>
			</div>
		</div>
	</div>
<?php 
	include_once 'include/footer.php';
?>