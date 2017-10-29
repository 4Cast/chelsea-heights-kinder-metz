<?php
	$home_tiles=SQL::get_page_tiles($connection,"home");
	
	echo "<div id='tile-widgets'>";
	foreach($home_tiles as $home_tile)
	{
		//<div class='feature-overlay'></div>
		echo 
		"
		<div class='small-12 medium-4 large-4 columns'>
			<div class='home-tile'>
				<a href='{$default_path}$home_tile[url]'>
					
					<img src='{$default_path}images/image-tiles/$home_tile[image]' class='tile-image box-shadow-imagea' />
					<span>$home_tile[text]</span>
				</a>
			</div>
		</div>
		";
	}
	echo "</div>";