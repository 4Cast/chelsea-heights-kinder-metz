<?php
	include_once 'include/header.php';
?>
	<div id="slideshow" class="">
		<div class="row">
			<div class="small-12 medium-12 large-12 columns">
				<div 
					class="cycle-slideshow" 
				    data-cycle-fx=scrollHorz
				    data-cycle-timeout=5000
				    data-cycle-overlay-template="{{desc}}<span class='right'>&nbsp;{{slideNum}} / {{slideCount}}</span>"
			    >
			    	<div class="cycle-overlay"></div>
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
							if($row['background_color']!="")
							{
								$background_color="style='background-color:$row[background_color];'";
								$attr="date-attr='$row[background_color]'";
							} 
							else
							{
								$background_color="style='background-color:#1892B7;'";
								$attr="date-attr='#1892B7'";
							}
							if($row['link']=="")
							{
								echo "<img class='drop-shadow' $attr alt='".SLOGAN."' src='{$default_path}images/home/$row[image]' data-cycle-desc='$row[text]' />";	
							}
							else
							{
								$link=$row['link'];
								echo "<img data-link='$link' class='drop-shadow' $attr alt='".SLOGAN."' src='{$default_path}images/home/$row[image]' data-cycle-desc='$row[text]' />";
							}		
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="content-area white-background" id="index-home">
		<div class="row">
			<div class="small-12 medium-8 large-8 columns">
				<?php echo SQL::get_page_content("index",$connection);?>
			</div>
			
			<div class="small-12 medium-4 large-4 columns">
				<?php 
					include 'events-calendar-widget.php';
				?>
			</div>
		</div>
	</div>
	
	<div id="home-tile" class="box-shadow">
		<div class="row">
			<?php
				$home_tiles=SQL::get_page_tiles($connection,"home");
				$index=1;
				foreach($home_tiles as $home_tile)
				{
					$class="class_$index";
					//<div class='feature-overlay'></div>
					echo 
					"
					<div class='small-12 medium-4 large-4 columns'>
						<a href='{$default_path}$home_tile[url]'>
							
							<img src='{$default_path}images/image-tiles/$home_tile[image]' class='tile-image box-shadow-image $class' />
							<span>$home_tile[text]</span>
						</a>
					</div>
					";
					$index++;
				}
			?>
		</div>
	</div>
<?php
	include_once 'include/footer.php';
?>