<?php
//https://apps.twitter.com/
	$is_local=false;
	if
	(
		$_SERVER['HTTP_HOST']=="localhost"||
		$_SERVER['HTTP_HOST']=="192.168.1.65"
	)
	{
		$is_local=true;
		$absolute_path="/ChelseaHeightsKinder/";
	}
	else
	{
		$absolute_path="/";
	}
	
	define('SHAMMIKA_HOME_IP_ADDRESS','60.241.85.245');
	
	define('DEFAULT_META_DESCRIPTION',"Chelsea Heights Kindergarten");
	define('DEFAULT_META_KEYWORDS',"Chelsea Heights Kindergarten");
        
	define('SLOGAN',"Chelsea Heights Kindergarten");
	
	define('EMAIL_TO',"info@chelseaheightskinder.vic.edu.au");
	define('SECONDARY_EMAIL_TO','shammika@shammika.com.au');
	
	define('ADDRESS','29 Third Ave, Chelsea Heights, 3196');
	
	define("PHONE_NUMBER","0397728080");
		
	define("WEBSITE_SLOGAN","chelseaheightskinder.vic.edu.au");
    define("FACEBOOK_URL","https://www.facebook.com/chelseaheightskinder");
        
    define("WEBSITE_URL","chelseaheightskinder.vic.edu.au");
    define("CONTACT_EMAIL","shammika@chelseaheightskinder.vic.edu.au");
    
	define("GOOGLE_MAPS_EMBED_API_KEY","AIzaSyBmGB6dSnrlseWiEEZQ0RtN-JAnmQy9LlI"); 
    
?>