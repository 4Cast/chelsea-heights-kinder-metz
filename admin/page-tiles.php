<?php 
	include_once "header.php";
	$type=$_GET['type'];
	
	$sql="
		SELECT *
		FROM image_tiles
		WHERE type='$type'
	";	
	$query=$connection->query($sql);
	$image_tiles=$query->fetchAll(PDO::FETCH_ASSOC);
?>
	<div class="main-content" id="staff">
      	<div class="row">				
			<div class="large-12 medium-12 small-12 columns">
				<fieldset>
					<legend>Image Tiles for - <?php echo ucfirst($type);?></legend>
					<?php 
						//print_r_html($image_tiles);
						foreach($image_tiles as $row)
						{
					?>
					<fieldset>
						<form action="../handle/page-tiles.php" enctype="multipart/form-data" method="post">
							<?php 
								if($_SESSION['update']!=""||$_SESSION['deleted']!="")
								{
									echo "<div class='success-class'>";
									if($_SESSION['update'])
									{
										echo "Image Uploaded";
									}
									else if($_SESSION['deleted'])
									{
										echo "Image Deleted";	
									}
									echo "</div>";
									
									unset($_SESSION['update']);
									unset($_SESSION['deleted']);
								}
							?>
							<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
							<section>
		      					<div>
		      						<?php 
		      							echo "width=320px <img width='300' src='{$default_path}images/image-tiles/$row[image]' />";
									?>
								</div>
		      					<div><input type="file" name="image" /></div>
		      				</section>
							
							<section>
		      					<div>URL : </div>
		      					<div><input type="text" placeholder="link/URL" name="url" size="80" value="<?php echo $row['url'];?>" /></div>
		      				</section>
		      				
							<section>
		      					<div>Text : </div>
		      					<div><input type="text" placeholder="Image description" name="text" size="80" value="<?php echo $row['text'];?>" /></div>
		      				</section>	
							<input class="button" type="submit" value="Submit" />
						</form>
					</fieldset>
					<?php
						}
					?>
				</fieldset>
			</div>
		</div>
	</div>