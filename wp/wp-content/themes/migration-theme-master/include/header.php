

<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" > <!--<![endif]-->
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	    <meta name="format-detection" content="telephone=no"/>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="keywords" content="<?php echo $meta_keywords;?>"/>
	    <meta name="description" content="<?php echo $meta_description;?>"/>

		<link rel="icon" href="<?php echo $default_path;?>images/header/FAVICON-v2.png" type="image/x-icon" />
	    <link rel="shortcut icon" href="<?php echo $default_path;?>images/header/FAVICON-v2.png" type="image/x-icon" />

		<meta property='og:locale' content='en_US'/>
		<meta property='og:title' content='<?php echo $title;?>'/>
		<meta property='og:description' content='<?php echo $meta_description;?>'/>
		<meta property='og:url' content='http://www.<?php echo WEBSITE_URL;?>/'/>
		<meta property='og:site_name' content='<?php echo WEBSITE_SLOGAN;?>'/>
		<meta property='og:type' content='article'/>

	  	<?php
	  		$title=SLOGAN;
	  	?>
		<title><?php echo $title;?></title>

  		<?php /*<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>*/?>

		<link type="text/css" href="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" href="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" />

		<link rel="stylesheet" href="<?php echo $default_path;?>include/foundation5/css/foundation.css">
		<link rel="stylesheet" href="<?php echo $default_path;?>css/style.css">
		<link rel="stylesheet" href="<?php echo $default_path;?>css/home.css">
		<link rel="stylesheet" href="<?php echo $default_path;?>css/header.css">
		<link rel="stylesheet" href="<?php echo $default_path;?>css/footer.css">
		<link rel="stylesheet" href="<?php echo $default_path;?>css/slideshow.css">

	  	<script src="<?php echo $default_path;?>js/jquery-1.7.2.min.js"></script>
	  	<script src="<?php echo $default_path;?>js/jquery-ui.min.js"></script>
		<script src="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>

		<script src="<?php echo $default_path;?>js/jquery.scrollbox.js"></script>
	  	<script src="<?php echo $default_path;?>js/common.js"></script>

	  	<?php /*<script src="http://malsup.github.io/jquery.cycle2.js"></script>
		<script src="http://malsup.github.io/jquery.cycle2.tile.js"></script>*/?>

		<?php
			if($file_name=="indexs.php")
			{
				echo '<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>';
			}
			else
			{
				echo '<script src="http://malsup.github.io/jquery.cycle2.js"></script>';
				echo '<script src="http://malsup.github.io/jquery.cycle2.tile.js"></script>';
			}
		?>

	  	<script src="<?php echo $default_path;?>js/slick-1.4.1/slick/slick.js"></script>
	  	<script src="<?php echo $default_path;?>include/foundation5/js/foundation/foundation.js"></script>
	  	<script src="<?php echo $default_path;?>include/foundation5/js/foundation/foundation.offcanvas.js"></script>
	  	<script src="<?php echo $default_path;?>js/script.js"></script>
	  	<script src="<?php echo $default_path;?>js/browser-detect.js"></script>

	  	<script>$(document).foundation();</script>

		<link rel="stylesheet" href="<?php echo $default_path;?>css/superfish.css" media="screen">
		<script src="<?php echo $default_path;?>js/hoverIntent.js"></script>
		<script src="<?php echo $default_path;?>js/superfish.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo $default_path;?>js/slick-1.4.1/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $default_path;?>js/slick-1.4.1/slick/slick-theme.css"/>

		<link rel="icon" href="<?php echo $default_path;?>images/FAVICON-RPV.png" type="image/x-icon" />
	    <link rel="shortcut icon" href="<?php echo $default_path;?>images/FAVICON-RPV.png" type="image/x-icon" />

		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>

		<script>

		(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function()
			{
				// initialise plugin
				var example = $('.superfish').superfish
				({
					//add options here if required
				});

				// buttons to demonstrate Superfish's public methods
				$('.destroy').on('click', function()
				{
					example.superfish('destroy');
				});

				$('.init').on('click', function()
				{
					example.superfish();
				});

				$('.open').on('click', function()
				{
					example.children('li:first').superfish('show');
				});

				$('.close').on('click', function()
				{
					example.children('li:first').superfish('hide');
				});
			});
		})(jQuery);
		</script>
	</head>

	<body>
		<?php
			if($_SERVER['HTTP_HOST']!="localhost"&&get_ip()!=SHAMMIKA_HOME_IP_ADDRESS)
			{

			}
		?>

		<div id="mobile-menu">
			<img id="close-icon" src='<?php echo $default_path;?>images/icons/close-button.png' />
			<ul>
		  		<li class="<?php if($file_name=="index.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>">HOME</a></li>
                <li class="<?php if($file_name=="about.php"){echo 'active';}?>">
                	<a href="<?php echo $default_path;?>#" class="open-mobile-sub-menu">ABOUT US<img class="down-arrow-image" src='<?php echo $default_path;?>images/icons/ARROW_down.png' /></a>
					<ul class="hidden mobile-sub-menu">
						<li><a href="<?php echo $default_path;?>about/our-philosophy"> - Our Philosophy</a></li>
						<li><a href="<?php echo $default_path;?>about/our-staff"> - Our Staff</a></li>
						<li><a href="<?php echo $default_path;?>about/committee-of-management"> - Committee Management</a></li>
					</ul>
                </li>
                <li class="<?php if($file_name=="program.php"){echo 'active';}?>">
                	<a href="<?php echo $default_path;?>#" class="open-mobile-sub-menu">PROGRAM<img class="down-arrow-image" src='<?php echo $default_path;?>images/icons/ARROW_down.png' /></a>
                	<ul class="hidden mobile-sub-menu">
						<li><a href="<?php echo $default_path;?>program/program-3-year-olds"> - Program 3 year-olds</a></li>
						<li><a href="<?php echo $default_path;?>program/program-4-year-olds"> - Program 4 year-olds</a></li>
						<li><a href="<?php echo $default_path;?>program/term-dates"> - Term dates</a></li>
						<li><a href="<?php echo $default_path;?>program/timetable"> - Timetable</a></li>
					</ul>
                </li>
                <li class="<?php if($file_name=="enrolments.php"){echo 'active';}?>">
					<a href="<?php echo $default_path;?>#" class="open-mobile-sub-menu">ENROLMENTS<img class="down-arrow-image" src='<?php echo $default_path;?>images/icons/ARROW_down.png' /></a>
                	<ul class="hidden mobile-sub-menu">
						<li><a href="<?php echo $default_path;?>enrolments/3-year-old-enrolments"> - 3 year-old Enrolments</a></li>
						<li><a href="<?php echo $default_path;?>enrolments/4-year-old-enrolments"> - 4 year-old Enrolments</a></li>
					</ul>
				</li>
                <li class="<?php if($file_name=="news.php"){echo 'active';}?>">
                	<a href="<?php echo $default_path;?>#" class="open-mobile-sub-menu">NEWS<img class="down-arrow-image" src='<?php echo $default_path;?>images/icons/ARROW_down.png' /></a>
                	<ul class="hidden mobile-sub-menu">
						<li><a href="<?php echo $default_path;?>newsletters"> - Newsletters</a></li>
						<li><a href="<?php echo $default_path;?>events"> - Events</a></li>
					</ul>
                </li>
                <li class="<?php if($file_name=="parents.php"){echo 'active';}?>">
                	<a href="<?php echo $default_path;?>#" class="open-mobile-sub-menu">FOR PARENTS<img class="down-arrow-image" src='<?php echo $default_path;?>images/icons/ARROW_down.png' /></a>
                	<ul class="hidden mobile-sub-menu">
                		<li><a href="<?php echo $default_path;?>parents/arrival-at-kinder"> - Arrival at Kinder</a></li>
						<li><a href="<?php echo $default_path;?>parents/authorisation"> - Authorisation</a></li>
						<li><a href="<?php echo $default_path;?>parents/birthdays-and-celebrations"> - Birthdays & celebrations</a></li>
						<li><a href="<?php echo $default_path;?>parents/complaints-and-concerns"> - Complaints & concerns</a></li>
						<li><a href="<?php echo $default_path;?>parents/illness"> - Illness</a></li>
						<li><a href="<?php echo $default_path;?>parents/what-to-bring"> - What to bring</a></li>
						<li><a href="<?php echo $default_path;?>parents/what-to-wear"> - What to wear</a></li>
						<li><a href="<?php echo $default_path;?>parents/your-child's-progress"> - Your child's Progress</a></li>
						<li><a href="<?php echo $default_path;?>parents/policies"> - Policies</a></li>
                	</ul>
                </li>
                <li class="<?php if($file_name=="gallery.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>gallery">GALLERY</a></li>
                <li class="<?php if($file_name=="contact.php"){echo 'active';}?>"><a href="<?php echo $default_path;?>contact">CONTACT US</a></li>
	        </ul>
		</div>

		<div id="header-section">
			<div class="row" id="header">
				<div class="large-3 medium-3 columns hide-for-small">
					<a href="<?php echo $default_path;?>"><img alt="Chelsea Heights Kindergarten" src="<?php echo $default_path;?>images/header/Chelsea-Heights-Kindergarten.png" /></a>
				</div>

				<div class="large-6 medium-6 columns hide-for-small padded-top-20">
					<img src="<?php echo $default_path;?>images/header/Header_LogoDetails.png" />
				</div>

				<div class="small-12 medium-12 large-12 columns top-header">
					<nav class="mobile-top-menu show-for-small">
						<ul>
							<li>
								<a class="sleft-off-canvas-toggle " href="#" >
									<img id="menu-icon" src="<?php echo $default_path;?>images/icons/mobile-menu.png" />
									<img id="mobile-logo" src="<?php echo $default_path;?>images/header/mobile-header.png" alt="<?php echo SLOGAN;?>" />
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div id="menu-links">

			<div class="row">
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
