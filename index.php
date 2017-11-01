<?php
	include_once 'include/header.php';
?>
	<div id="slideshow" class="">
		<div class="inner-row">
			<div class="small-12 medium-12 large-12 columns">
				<div
					class="cycle-slideshow"
				    data-cycle-fx=scrollHorz
				    data-cycle-timeout=5000
				    data-cycle-overlay-template="{{desc}}<span class='right'>&nbsp;{{slideNum}} / {{slideCount}}</span>"
			    >
			    	<div class="cycle-overlay"></div>
				    <?php
						if(false){
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
					}
					?>

					<img class="drop-shadow cycle-slide cycle-slide-active" date-attr="#1892B7" alt="Chelsea Heights Kindergarten" src="/images/home/RotatingBanner_1.jpg" data-cycle-desc="" style="position: absolute; top: 0px; left: 0px; z-index: 99; opacity: 1; display: block; visibility: visible;">
				</div>
			</div>
		</div>
	</div>

	<div class="content-area white-background" id="index-home">
		<div class="row">
			<div class="small-12 medium-8 large-8 columns">
				<h1>Our aim at Chelsea Heights Kindergarten is to provide a secure, inclusive, high-quality learning environment.</h1>

<p>All areas of development are catered for and learning through play is the focus of our program. At kindergarten we work to build independence, positive self-esteem and respect for others. We promote a positive attitude to education, believing that we are all "learners for life".</p>

<p>Find out what’s on at Chelsea Heights Kindergarten during 2017 and beyond. Click the date in the calendar or visit latest news page for more information on the upcoming events.</p>
			</div>

			<!-- <div class="small-12 medium-4 large-4 columns">

			</div> -->
		</div>
	</div>

	<div id="home-tile" class="box-shadow">
		<div class="row">

					<div class="small-12 medium-4 large-4 columns">
						<a href="/parents/arrival-at-kinder">

							<img src="/images/image-tiles/Tile_1.png" class="tile-image box-shadow-image class_1">
							<span>For Parents</span>
						</a>
					</div>

					<div class="small-12 medium-4 large-4 columns">
						<a href="/program/program-3-year-olds">

							<img src="/images/image-tiles/Tile_2.png" class="tile-image box-shadow-image class_2">
							<span>Program</span>
						</a>
					</div>

					<div class="small-12 medium-4 large-4 columns">
						<a href="/newsletters">

							<img src="/images/image-tiles/Tile_3.png" class="tile-image box-shadow-image class_3">
							<span>News</span>
						</a>
					</div>
							</div>
	</div>
	<div id="footer">
				<div class="row">
					<div class="columns large-3 medium-3 small-12">
						<img src="/images/footer/Footer_Logo.png">
					</div>
					<div class="columns large-5 medium-5 small-12" id="business-hours">
						<img src="/images/footer/Footer_Tagline.png">
					</div>
					<div class="columns large-3 medium-3 small-12" id="fb">
						<a target="_blank" href="https://www.facebook.com/chelseaheightskinder">
							<img src="/images/footer/Header_Facebook.png">
						</a>
					</div>
				</div>
			</div>
			<div id="footer-gutter">
		 </div>
			<div id="footer-credits">

			<div class="row">
				<div class="columns large-6 medium-6 small-12">
					© Copyright 2017 Chelsea Heights Kindergarten. All Rights Reserved
				</div>


				<div class="columns large-3 medium-3 small-12" id="mc">
					<a href="http://www.metzcreative.com.au" target="_blank">
						<img alt="Graphic Design Studio Services in Melbourne | Print Designer" src="/images/footer/Footer_MCLogo.png">
					</a>
				</div>
			</div>
		</div>
