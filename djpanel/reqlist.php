<?php
require_once('auth.php');
require_once('config.php');
$query = mysql_query("SELECT * FROM  ".DBPREF."staff_accounts WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$access = $row['acctype'];

if ($access >= 1) {
?>
<!--
**********************************
* Title: ADMIN DASHBOARD V1
* Author: Mike
* Designed and Developed by: Mike
* URL: http://cr8tivemanila.com
**********************************
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin Dashboard - <?=SITENAME;?></title>
<script type="text/javascript" src="scripts/jquery-1.8.0.min.js"></script>
		<style>
		* { margin: 0; padding: 0 }
		</style>
		<script>
$('span.reqdone').click(function(){
		if (confirm("Remove this song request?")){
			var req_id = $(this).parent().parent().attr('id');
			var data = 'req_id=' + req_id ;
			var parent = $(this).parent().parent();
			$.ajax({
				type: "GET",
				url: "delrequest.php",
				data: data,
				cache: false,
					
				success: function()
					{
						parent.fadeOut('slow', function() {$(this).remove();});
					}
			});				
		}
	});
</script>
	</head>
<?php

	$tG_Query = mysql_query("SELECT * FROM ".DBPREF."songreq_list ORDER BY req_id ASC") or die(mysql_error());
	$counter = 1;
	if (!mysql_num_rows($tG_Query)) {
								echo "<div class='note'>There are no record in the database.</div>";
							}
							else {
		while($ReqRow=mysql_fetch_array($tG_Query)) {
		echo "<div id=\"{$ReqRow['req_id']}\">";
		echo "<div class=\"reqlist-wrapper\">";
		echo '<div class="number">';
		echo $counter++;
		echo '</div>';
		echo '<div class="user-info">';
		echo "<span class=\"song-title\">{$ReqRow['req_title']}</span>";
		echo "<span class=\"req-by\">REQUESTED BY: {$ReqRow['req_by']}</span>";
		echo '</div>';
		echo '<span class="reqdone" style="float: right;">DONE</span>';
		if (empty($ReqRow['req_youtube'])) {
			// none
		}
		else {
			echo '<a href="'.$ReqRow['req_youtube'].'" target="_blank"><span class="red-butt" style="float: right; margin-right: 5px;">YOUTUBE LINK</span></a>';
		}
		echo '<div class="clear"></div>';
		echo '</div></div>';
		}
			}
	}
	else {
		echo "You can't access this page.";
	}
mysql_close($con);
?>