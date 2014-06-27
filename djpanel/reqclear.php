<?php
require_once('auth.php');
require_once('config.php');
$query = mysql_query("SELECT * FROM  ".DBPREF."staff_accounts WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$access = $row['acctype'];

if ($access >= 1) {

		$result = mysql_query("TRUNCATE ".DBPREF."songreq_list") or die(mysql_error()); 

		Header('Location: admin.php?page=songreq');
}
else {
		echo "You can't access this page.";
}
?>