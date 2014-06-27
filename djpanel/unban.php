<?php
 include('config.php');

	if(isset($_GET['ban_id']) && is_numeric($_GET['ban_id'])){
		$ban_id = $_GET['ban_id'];
		$result = mysql_query("DELETE FROM scgfx_ban_list WHERE ban_id=$ban_id") or die(mysql_error()); 

		echo "Song requested has been removed.";
	}
	else {
		echo "Failed!";
	}
?>