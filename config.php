<?php
session_start();

$host = "localhost";
$username = '';
$password = '';
$dbname = '';

$con = mysql_connect($host,$username,$password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

define("DB_PREFIX", "scgfx_", true);		// database table prefix name ex. scgfx_user_accounts
define("SESSION_NAME", "nameofyourfm", true);	// 
define("GLOBAL_NAME", "Magic 89.9", true);		// fm station name
define("GLOBAL_MESSAGE", "Welcome to Magic 89.9 FM", true); // global message, appears every 20 msg's

// don't edit
error_reporting(E_ALL ^ E_NOTICE);
session_name("scgfxCbox_".SESSION_NAME);
ini_set("session.gc_maxlifetime","86400");


//Facebook App Id and Secret

$appID = ''; // App ID of your Facebook App
$appSecret = ''; // Secrey Key of your Facebook App
$base_url=''; // Location where your chatbox is located

?>