<?php
	include_once 'include/header.php';
?>
<body>

	<div class='container-fluid'>
		<div class="row">
			<div class="col-sm-12">
				<div style="background-color:pink; height:100px;">
				</div>
			</div>
		</div>

<div class="inner-row">
	<div class="row">


			<div class="col col-3">
				<a href="#"><img alt="Chelsea Heights Kindergarten" src="/images/header/Chelsea-Heights-Kindergarten.png" /></a>
			</div>

			<div class="col col-6">
				<img src="/images/header/Header_LogoDetails.png" />
			</div>

		<!-- </div><! inner-row --> -->



	</div>
</div>


<div class="row">
	<div class="inner-row">
	<div id="menu-links">


			<nav class="hide-for-small">
				<div class="large-12 medium-12 columns" id="main-menu">
					<ul class="sf-menu superfish">
						<li class="<?php if($file_name=="index.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>">HOME</a></li>
										<li class="<?php if(!stristr($_SERVER['REQUEST_URI'],'/about/')===FALSE){echo 'active';}?>">
											<a href="<?php echo $default_path;?>#">ABOUT US</a>
							<ul>
								<li><a href="<?php echo $default_path;?>about/our-philosophy">Our Philosophy</a></li>
								<li><a href="<?php echo $default_path;?>about/our-staff">Our Staff</a></li>
								<li><a href="<?php echo $default_path;?>about/committee-of-management">Committee Management</a></li>
							</ul>
										</li>
										<li class="<?php if(!stristr($_SERVER['REQUEST_URI'],'/program/')===FALSE){echo 'active';}?>">
											<a href="<?php echo $default_path;?>#">PROGRAM</a>
											<ul>
								<li><a href="<?php echo $default_path;?>program/program-3-year-olds">Program 3 year-olds</a></li>
								<li><a href="<?php echo $default_path;?>program/program-4-year-olds">Program 4 year-olds</a></li>
								<li><a href="<?php echo $default_path;?>program/term-dates">Term dates</a></li>
								<li><a href="<?php echo $default_path;?>program/timetable">Timetable</a></li>
							</ul>
										</li>
										<li class="<?php if(!stristr($_SERVER['REQUEST_URI'],'/enrolments/')===FALSE){echo 'active';}?>">
											<a href="<?php echo $default_path;?>#">ENROLMENTS</a>
											<ul>
								<li><a href="<?php echo $default_path;?>enrolments/3-year-old-enrolments">3 year-old Enrolments</a></li>
								<li><a href="<?php echo $default_path;?>enrolments/4-year-old-enrolments">4 year-old Enrolments</a></li>
							</ul>
										</li>
										<li class="<?php if(!stristr($_SERVER['REQUEST_URI'],'/newsletter/')===FALSE){echo 'active';}?>">
											<a href="<?php echo $default_path;?>#">NEWS</a>
											<ul>
								<li><a href="<?php echo $default_path;?>newsletters">Newsletters</a></li>
								<li><a href="<?php echo $default_path;?>events">Events</a></li>
							</ul>
										</li>
										<li class="<?php if(!stristr($_SERVER['REQUEST_URI'],'/parents/')===FALSE){echo 'active';}?>">
											<a href="<?php echo $default_path;?>#">FOR PARENTS</a>
											<ul>
												<li><a href="<?php echo $default_path;?>parents/arrival-at-kinder">Arrival at Kinder</a></li>
								<li><a href="<?php echo $default_path;?>parents/authorisation">Authorisation</a></li>
								<li><a href="<?php echo $default_path;?>parents/birthdays-and-celebrations">Birthdays & celebrations</a></li>
								<li><a href="<?php echo $default_path;?>parents/complaints-and-concerns">Complaints & concerns</a></li>
								<li><a href="<?php echo $default_path;?>parents/illness">Illness</a></li>
								<li><a href="<?php echo $default_path;?>parents/what-to-bring">What to bring</a></li>
								<li><a href="<?php echo $default_path;?>parents/what-to-wear">What to wear</a></li>
								<li><a href="<?php echo $default_path;?>parents/your-child's-progress">Your child's Progress</a></li>
								<li><a href="<?php echo $default_path;?>parents/policies">Policies</a></li>
											</ul>
										</li>
										<li class="<?php if($file_name=="gallery.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>gallery">GALLERY</a></li>
										<li class="<?php if($file_name=="contact.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>contact">CONTACT US</a></li>
					</ul>
						</div>
					</nav>
		</div>
	</div>
</div>
<div class="row">
	<div class="inner-row">
	<div id="slideshow" class="">

			<div class="small-12 medium-12 large-12 columns">
				<div
					class="cycle-slideshow"
				    data-cycle-fx=scrollHorz
				    data-cycle-timeout=5000
				    data-cycle-overlay-template="{{desc}}<span class='right'>&nbsp;{{slideNum}} / {{slideCount}}</span>"
			    >
			    	<div class="cycle-overlay"></div>


					<img class="drop-shadow cycle-slide cycle-slide-active" date-attr="#1892B7" alt="Chelsea Heights Kindergarten" src="/images/home/RotatingBanner_1.jpg" data-cycle-desc="" style="position: absolute; top: 0px; left: 0px; z-index: 99; opacity: 1; display: block; visibility: visible;">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div>
	<div class="content-area white-background" id="index-home">

			<div class="small-12 medium-8 large-8 columns">
				<h1>Our aim at Chelsea Heights Kindergarten is to provide a secure, inclusive, high-quality learning environment.</h1>

<p>All areas of development are catered for and learning through play is the focus of our program. At kindergarten we work to build independence, positive self-esteem and respect for others. We promote a positive attitude to education, believing that we are all "learners for life".</p>

<p>Find out what’s on at Chelsea Heights Kindergarten during 2017 and beyond. Click the date in the calendar or visit latest news page for more information on the upcoming events.</p>
			</div>


		</div>
	</div>
</div>

<div class="row">
	<div class="inner-row">
	<div id="home-tile" class="box-shadow">


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
	</div>
</div>



	</body>
	</html>
