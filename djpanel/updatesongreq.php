<?php

include('config.php');

if (isset($_GET['stat'])) {
	$stat = mysql_real_escape_string(htmlspecialchars($_GET['stat']));
	
	mysql_query("UPDATE  ".DBPREF."songreq_status SET status='".$stat."'") or die(mysql_error());
}

?>