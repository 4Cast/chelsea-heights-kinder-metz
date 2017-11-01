

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
	  		$title='Chelsea Heights Kindergarten';
	  	?>
		<title><?php echo $title;?></title>

  		<?php /*<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>*/?>

		<link type="text/css" href="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" href="<?php echo $default_path;?>js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


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
		<style>
			.container-fluid{
				padding: 0;
			}
			.inner-row{
			  width: 100%;
			  margin-left: auto;
			  margin-right: auto;
			  margin-top: 0;
			  margin-bottom: 0;
			  max-width: 62.5rem;
			  *zoom: 1; }

		</style>
	</head>

	
