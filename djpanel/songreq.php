<style>

* {
	margin: 0;
	padding: 0;
}
body {
	
	color: #f1f1f1;
	font-family: Verdana,Helvetica,sans-serif;
	font-size: 12px;
}
div.RequestBox {
	width: 260px;
	height: 250px;
	background: #000000;
	padding: 10px;
}
input.button {
	min-width: 150px;
	margin-left: -3px;
	margin-bottom: 5px;
	padding: 7px 10px;
	color: #ffffff;
	font-weight: bold;
	border-radius: 5px;
	border: 1px solid #000000;
	background: #002D47;
	background: -webkit-gradient( linear, left bottom, left top, color-stop(0.12, #00466E), color-stop(1, #002D47) );
	background: -moz-linear-gradient( center bottom, #00466E 12%, #002D47 100% );
	cursor: pointer;
}
span.title {
	display: block;
}
div.error {
	background: #e33535;
	color: #f1f1f1;
	padding: 5px;
	font-size: 11px;
	margin-top: 5px;
	margin-bottom: 5px;
	border: 1px solid #5e0000;
	text-align: center;
}
div.success {
	background: #58b619;
	padding: 5px;
	font-size: 11px;
	margin-top: 5px;
	margin-bottom: 5px;
	border: 1px solid #2e7200;
	color: #f1f1f1;
	text-align: center;
}	
</style>
<div class="RequestBox">
<?php

require_once('config.php');

$query_status = mysql_query("SELECT * FROM ".DBPREF."songreq_status") or die(mysql_error());
$row = mysql_fetch_array($query_status);
if(isset($_POST['SubmitSR'])) {
	$songtitle = mysql_real_escape_string(htmlspecialchars($_POST['songtitle']));
	$youtube = mysql_real_escape_string(htmlspecialchars($_POST['youtubelink']));
	$reqby = mysql_real_escape_string(htmlspecialchars($_POST['requestedby']));
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	$timeout = 5*60; //60*60*24 seconds = 1 day 
	$expire = $time-$timeout; 

	$check = mysql_query("SELECT * FROM ".DBPREF."songreq_list WHERE req_ip='".$ip."' AND req_time > ".$expire."") or die(mysql_error());
	if(mysql_num_rows($check) > 0) {
		echo "<div class='error'>Sorry, Please wait 30 Minutes to request again.</div>";
	}
	else {
		echo "<div class='success'>Thank you for requesting a song! :)</div>";
		mysql_query("INSERT INTO ".DBPREF."songreq_list (req_title, req_youtube, req_by, req_ip, req_time)VALUES ('".$songtitle."', '".$youtube."', '".$reqby."', '".$ip."', '".$time."')") or die(mysql_error());

	}
	//mysql_query("INSERT INTO songreq_list (req_title, req_youtube, req_by, req_ip, req_time)VALUES ('".$songtitle."', '".$youtube."', '".$reqby."', '".$ip."', '".$time."')") or die(mysql_error());
}

if ($row['status'] == "open") {
?>
<form id="formID" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<span class="title">Song Title:</span>
			<input type="text" name="songtitle" placeholder="Title of the Song" required="required" style="width: 260px; height: 30px; margin-bottom: 10px; margin-top: 2px;">
			<span class="title">YouTube Link:</span>
			<input type="text" name="youtubelink" placeholder="YouTube Link" required="required" style="width: 260px; height: 30px; margin-bottom: 10px; margin-top: 2px;">
			<span class="title">Requested By:</span>
			<input type="text" name="requestedby" placeholder="Put your name here" required="required" style="width: 260px; height: 30px; margin-bottom: 5px; margin-top: 2px;">
			<div><input type="submit" id="SubmitSR" name="SubmitSR" value="SUBMIT REQUEST" class="button"></div>
</form>
<?php }
else {
echo "<center><br/><br/>Sorry, Song Request is closed.<br/><br/>or DJ is not accepting song request at this moment.</center>";
}
?>
</div>