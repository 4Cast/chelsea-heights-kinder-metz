<?php
	include_once 'include/header.php';
?>
	<div class="heading box-shadow">
		<div class="row">
			<div class="large-12 medium-12 small-12 column">
				<h2>View our image gallery</h2>
			</div>
		</div>
	</div>
	
	<div class="content-with-background gallery padded-top-30">
		<div class="row white-background" id="gallery">
			<div class="small-12 large-12 medium-12 columns">
				<div class="cycle-slideshow composite-example" 
					data-cycle-fx="scrollHorz"
				    data-cycle-timeout="0"
				    data-cycle-prev="#previous"
				    data-cycle-next="#next"
				    data-cycle-caption="#adv-custom-caption"
				    data-cycle-caption-template="{{cycleTitle}}"
			    >
			    <?php
					$sql="
						SELECT *
						FROM gallery
						ORDER BY priority ASC
					";
					$query=$connection->query($sql);
					$rows=$query->fetchAll(PDO::FETCH_ASSOC);
					foreach($rows as $row)
					{
						echo "<img class='small-12 large-12 columns' src='{$default_path}images/gallery/$row[image_name]' data-cycle-title='$row[description]' />";
					}
				?>
				</div>
			
				<div class="small-12 large-12 medium-12 columns" id='previous-next'>
					<div class="small-1 large-1 medium-1 columns"><img id='previous' src='<?php echo $default_path;?>images/icons/ARROW_LEFT.png' /></div>
					<div class="small-10 large-10 medium-10 columns image-description"><span class="" id="adv-custom-caption"><?php echo $rows[0]['description'];?></span></div>
					<div class="small-1 large-1 medium-1 columns"><img id='next' src='<?php echo $default_path;?>images/icons/ARROW_RIGHT.png' /></div>
				</div>
			</div>
			
			
			<?php include_once 'include/contact-info-panel.php';?>
			
			<?php include_once 'include/subscribe-widget.php';?>
		
		</div>
	</div>
<?php
	include_once 'include/footer.php';
?>