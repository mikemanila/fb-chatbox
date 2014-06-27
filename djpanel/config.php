<?php

	$host = "localhost";
	$username = '';
	$password = '';
	$dbname = '';

    $con = mysql_connect($host,$username,$password) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	
	// Basic Settings
	define("SITENAME", "Radio Virtual FM"); // NAME OF YOUR SITE
	define("SITEURL", "http://radiovirtualfm975.blogger.com/"); // URL OF YOUR SITE
	define("SITETAGLINE", "Ang Sarap Dito!"); // TAGLINE OF YOUR SITE
	define("CHATBOXLINK", ""); // URL OF YOUR CHAT BOX
	define("PAGEUID", "000"); // YOUR PAGE UID
	
	/**
	To Get your Page UID, Follow this steps:
	type http://graph.facebook.com/username_of_your_page
	example: http://graph.facebook.com/magic899
	find "id": "164790013558518"
	
	164790013558518 << That's your Page UID.
	**/	
	// Voscast Settings (Voscast Users Only) - If you're using USTREAM, JUST LEAVE AS IS.
	define("STARTAUTODJ", "PUT_LINK_HERE"); // API LINK TO START YOUR AUTODJ
	define("STOPAUTODJ", "PUT_LINK_HERE"); // API LINK TO STOP YOUR AUTODJ
	
	// Database Prefix -- Please do not edit this line 
	define("DBPREF", "mggfx_"); // DO NOT EDIT THIS LINE ! OR ELSE SOME QUERY IN DB WILL NOT WORK PROPERLY
	
	
	/**
	
	VOSCAST API LINK LOOKS LIKE THIS:
	http://voscast.com/api/?key=59ak23lkv1b2932019d3281s5js1&action=start
	http://voscast.com/api/?key=59ak23lkv1b2932019d3281s5js1&action=stop

	
	Enjoy!
	
	**/

?>