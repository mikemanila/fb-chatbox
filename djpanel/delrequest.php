<?php
require_once('auth.php');
require_once('config.php');
$query = mysql_query("SELECT * FROM  ".DBPREF."staff_accounts WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$access = $row['acctype'];

if ($access >= 1) {

	if(isset($_GET['req_id']) && is_numeric($_GET['req_id'])){
		$req_id = $_GET['req_id'];
		$result = mysql_query("DELETE FROM ".DBPREF."songreq_list WHERE req_id=$req_id") or die(mysql_error()); 

		echo "Song requested has been removed.";
	}
	else {
		echo "Failed!";
	}
}
else {
		echo "You can't access this page.";
}
?>