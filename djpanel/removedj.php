<?php
require_once('auth.php');
require_once('config.php');
$query = mysql_query("SELECT * FROM  ".DBPREF."staff_accounts WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$access = $row['acctype'];

if ($access == 2) {

	if(isset($_GET['dj_id']) && is_numeric($_GET['dj_id'])){
		$dj_id = $_GET['dj_id'];
		$result = mysql_query("DELETE FROM ".DBPREF."dj_list WHERE dj_id=$dj_id") or die(mysql_error()); 

		echo "DJ has been removed.";
	}
	else {
		echo "Failed!";
	}
}
else {
		echo "You can't access this page.";
}
?>