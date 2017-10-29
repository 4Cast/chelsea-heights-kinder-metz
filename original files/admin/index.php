<?php 
	include_once 'header.php';
?>
	<div class="main-content" id="blurb">
      	<div class="row">				
			<div class="small-12 large-12 columns">
				<fieldset>
					<legend>Sliding Home Page Banner Animation</legend>
					<form action="<?php echo $admin_path?>handle/index.php" enctype="multipart/form-data" method="post">
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
						<section>
	      					<div>Image (960px x 388px) : </div>
	      					<div><input type="file" name="image" /></div>
	      				</section>
						
						<section>
	      					<div>URL : </div>
	      					<div><input type="text" placeholder="Please enter full url, i.e. http://www....." name="link" size="80" /></div>
	      				</section>
	      				
						<section>
	      					<div>Text : </div>
	      					<div><input type="text" placeholder="Image description" name="text" size="80" /></div>
	      				</section>
	      				
	      				<?php /*
						<section>
	      					<div>Background Color : </div>
	      					<div style='width:60%;'>	      						
	      						<input  style='float:left;margin-right:10px;' type="text" placeholder="i.e. #4C4D4F" name="background_color" id="background_color" size="30" />
	      						<div id="background_color_div"></div>
	      					</div>
	      				</section>
	      				*/?>				
						<section>
	      					<div>Order/Priority : </div>
	      					<div><input type="text" placeholder="1,2,3..." name="order_by" size="10" /></div>
	      				</section>	      				
	      				
						<input class="button" type="submit" value="Submit" />
					</form>
				</fieldset>
				
				<fieldset id='animation-slides'>
					<legend>Current Sliding Images</legend>
					<?php 
						$sql="
							SELECT *
							FROM home_page_animation
							ORDER BY order_by
						";
						$query=$connection->query($sql);
						$rows=$query->fetchAll(PDO::FETCH_ASSOC);
						foreach($rows as $row)
						{
							echo "<div class='animation-slide' style='padding:10px;border-bottom:1px solid;' data-id='$row[id]'>";	
								echo $row['link']."<br /><img width='300' src='{$default_path}images/home/$row[image]' />";
								echo "<a class='delete' href='delete-home-image.php?id=$row[id]'><img src='{$default_path}images/icons/no.png' /> Delete this image</a><br />";
								echo "<input style='margin-top:20px;' placeholder='Text' type='text' id='text-$row[id]' size='80' value='$row[text]' />";
								echo "<input style='width:80px;' placeholder='Priority' type='text' id='priority-$row[id]' size='10' value='$row[order_by]' />";
							echo "</div>";
						}
					?>
					<input class="button" type="button" id="change-order" value="Change Order" />
				</fieldset>
			</div>
		</div>
	</div>

<?php 
	include_once 'footer.php';
?>