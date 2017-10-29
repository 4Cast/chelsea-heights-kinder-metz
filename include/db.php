<?php
	ini_set('display_errors',0);
	ini_set("error_reporting",E_ALL);
	date_default_timezone_set("Australia/Melbourne");
	
	function db_connect($type="PDO")
	{
		if
		(
			$_SERVER['HTTP_HOST']=="localhost"||
			$_SERVER['HTTP_HOST']=="192.168.1.65"
		)
		{
			$host="localhost";
			$dbname="ChelseaHeightsKinder";
			$username="root";
			$password='';
		}
		else
		{
			$host="localhost";
			$dbname="s1091257_ChelseaHeightsKinder";
			$username="s1091257_Chelsea";
			$password='mco$I2ew';
		}
				
		if($type=="PDO")
		{
			$db=new PDO("mysql:host=$host;dbname=$dbname",$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
			return $db;	
		}
		else
		{		
			$connection = @mysql_connect($host, $username, $password) or die(mysql_error());
			$db = @mysql_select_db($dbname, $connection) or die("Couldn't select database : " . mysql_error());
			return $connection;		
		}
			
	}
?>