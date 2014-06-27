<?php
ini_set( "display_errors", 0);
$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
putenv ('TZ=' . $timezone);
$date = date("F j, Y");

require_once('auth.php');
require_once('config.php');

$query = mysql_query("SELECT * FROM  ".DBPREF."staff_accounts WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$access = $row['acctype'];

if (isset($_GET['delstaff'])) {
	$delstaff = mysql_real_escape_string($_GET['delstaff']);
	if(empty($delstaff)) {
		Header('Location: admin.php?page=staff');
	}
	else {
		mysql_query("UPDATE scgfx_user_accounts SET acctype='0' WHERE fbid='".$delstaff."'");
		Header('Location: admin.php?page=staff');
	}
}
if (isset($_POST['changeDJ'])) {
	$selected = $_REQUEST['selectDJ'];
	
	$query = mysql_query("SELECT * FROM  ".DBPREF."dj_list WHERE dj_id='{$selected}'") or die(mysql_error());
	$row = mysql_fetch_array($query);
	$djname = $row['dj_name'];
	$djfbid = $row['dj_fbid'];
	$djtag = $row['dj_tagline'];
	$djtime = $row['dj_time'];
	
	if ($selected == "0") {
		mysql_query("UPDATE  ".DBPREF."onboard SET dj_name='AUTO-TUNE', dj_fbid='".PAGEUID."', dj_tagline='".SITEURL."', dj_time='".SITETAGLINE."', dj_status='NO ACTIVE DJ'") or die(mysql_error());
	}
	else {
		mysql_query("UPDATE  ".DBPREF."onboard SET dj_name='{$djname}', dj_fbid='{$djfbid}', dj_tagline='{$djtag}', dj_time='{$djtime}', dj_status='ON-AIR'") or die(mysql_error());
	}
	Header('Location: admin.php?page=djonboard&successdj');
}

if (isset($_POST['addStaff'])) {
	$staffid = $_POST['staffid'];
	$staffrank = $_REQUEST['selectRank'];
	$q1 = mysql_query("SELECT * FROM scgfx_user_accounts WHERE fbid='".$staffid."'");
	$qrow = mysql_fetch_array($q1);
	if ($staffrank == "5") {
	mysql_query("UPDATE scgfx_user_accounts SET acctype='5' WHERE fbid='".$staffid."'") or die(mysql_error());
	}
	elseif ($staffrank == "3") {
	mysql_query("UPDATE scgfx_user_accounts SET acctype='3', fbname='[DJ] ".$qrow['fbname']."' WHERE fbid='".$staffid."'") or die(mysql_error());
	}
	elseif ($staffrank == "2") {
	mysql_query("UPDATE scgfx_user_accounts SET acctype='2', fbname='[DJ] ".$qrow['fbname']."' WHERE fbid='".$staffid."'") or die(mysql_error());
	}
	elseif ($staffrank == "4") {
	mysql_query("UPDATE scgfx_user_accounts SET acctype='4', fbname='[MOD] ".$qrow['fbname']."' WHERE fbid='".$staffid."'") or die(mysql_error());
	}
	Header('Location: admin.php?page=addstaff&successaddstaff');
	
}
if (isset($_POST['addNewDJ'])) {
	$djname = mysql_real_escape_string(htmlspecialchars($_POST['nameofdj']));
	$djuid = mysql_real_escape_string(htmlspecialchars($_POST['djuid']));
	$djtagline = mysql_real_escape_string(htmlspecialchars($_POST['djtagline']));
	$djtimeslot = mysql_real_escape_string(htmlspecialchars($_POST['djtimeslot']));
	
	mysql_query("INSERT INTO  ".DBPREF."dj_list (dj_name, dj_fbid, dj_tagline, dj_time) VALUES('".$djname."', '".$djuid."', '".$djtagline."', '".$djtimeslot."')") or die(mysql_error());
	Header('Location: admin.php?page=djonboard&successadddj');
}
if (isset($_POST['submitNewVip'])) {
	$vipnewname = mysql_real_escape_string(htmlspecialchars($_POST['avip_name']));
	$vipfbuid = mysql_real_escape_string(htmlspecialchars($_POST['avip_fbuid']));
	$subscription = mysql_real_escape_string(htmlspecialchars($_POST['avip_days']));
	$vipcolor = $_REQUEST['selectVipColor'];
	$today = date("M-d-Y");
	$date = strtotime($today);
	$date = strtotime("+".$subscription." day", $date);
	$date = date('Y-m-d', $date);
	$check = mysql_query("SELECT * FROM ".DBPREF."vip_members WHERE vip_fbid='".$vipfbuid."' AND vip_status='active'");
	
	if (mysql_num_rows($check)) {
		Header('Location: admin.php?page=vip&vipalreadyexist');
	}
	else {
	$tG_Query1 = mysql_query("SELECT * FROM scgfx_user_accounts WHERE fbid='".$vipfbuid."'"); 
	$tG_Row1 = mysql_fetch_array($tG_Query1);
	$oldname = $tG_Row1['fbname'];
	
	mysql_query("INSERT INTO  ".DBPREF."vip_members (vip_expdate, vip_status, vip_fbid, vip_oldname, vip_newname) VALUES('".$date."', 'active', '".$vipfbuid."', '".$oldname."', '".$vipnewname."')") or die(mysql_error());
	mysql_query("UPDATE scgfx_user_accounts SET acctype='".$vipcolor."', fbname='".$vipnewname."' WHERE fbid='".$vipfbuid."'");
	Header('Location: admin.php?page=vip&successvip');
	}
}
if (isset($_POST['submitNewAcc'])) {
	$fname = mysql_real_escape_string(htmlspecialchars($_POST['ac_fname']));
	$lname = mysql_real_escape_string(htmlspecialchars($_POST['ac_lname']));
	$usrname = mysql_real_escape_string(htmlspecialchars($_POST['ac_username']));
	$pword = mysql_real_escape_string(htmlspecialchars($_POST['ac_password']));
	$pass = md5($pword);
	$selectedPos = $_REQUEST['selectPosition'];
	
	mysql_query("INSERT INTO  ".DBPREF."staff_accounts (firstname, lastname, login, passwd, acctype) VALUES('".$fname."', '".$lname."', '".$usrname."', '".$pass."', '".$selectedPos."')") or die(mysql_error());
	Header('Location: admin.php?page=accounts&successaddacc');
}

if (isset($_POST['changeName'])) {
	$cuid = $_POST['cuid'];
	$cname = $_POST['cname'];
	
	mysql_query("UPDATE scgfx_user_accounts SET fbname='".$cname."' WHERE fbid='".$cuid."'") or die(mysql_error());
	Header('Location: admin.php?page=settings&successcname');
}

if (isset($_POST['addNewStaff'])) {
	$staffname = mysql_real_escape_string(htmlspecialchars($_POST['staffname']));
	$staffuid = mysql_real_escape_string(htmlspecialchars($_POST['staffuid']));
	$selectedRank = $_POST['selectRank'];
	
	mysql_query("UPDATE scgfx_user_accounts SET acctype='".$selectedRank."', fbname='".$staffname."' WHERE fbid='".$staffuid."'") or die(mysql_error());
	Header('Location: admin.php?page=staff&successnewstaff');
}
if (isset($_POST['submitPass'])){
        if (empty($_POST['cp_current'])){
                $errors[] = 'Current Password is empty.';
        }
		if (empty($_POST['cp_newpass'])){
                $errors[] = 'New Password is empty.';
        }
		if ($_POST['cp_newpass'] == $_POST['cp_newpass2']) {
			$newPw = md5($_POST['cp_newpass']);
		}
		else {
			$errors[] = 'New Password is not match.';
		}
		$tG_QueryCheck = mysql_query("SELECT * FROM ".DBPREF."staff_accounts WHERE member_id = '{$_SESSION['SESS_MEMBER_ID']}'");
		$tG_Row = mysql_fetch_array($tG_QueryCheck);
		$chkPw = md5($_POST['cp_current']);
		if ($chkPw == $tG_Row['passwd']){
                
        }
		else {
				$errors[] = 'Current Password didn\'t match!';
		}

        if (empty($errors)){
		
		$cp_user = mysql_real_escape_string(htmlentities($_POST['cp_user']));
		$cp_fname = mysql_real_escape_string(htmlentities($_POST['cp_fname']));
		$cp_lname = mysql_real_escape_string(htmlentities($_POST['cp_lname']));
		
		mysql_query("UPDATE ".DBPREF."staff_accounts SET passwd = '{$newPw}' WHERE member_id = '{$_SESSION['SESS_MEMBER_ID']}'");
                Header('Location: admin.php?page=changepass&pwsuccess');
                die();
        }
}
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
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald:400,700"/>
		<script type="text/javascript" src="scripts/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
	</head>
<body>
	<header>
		<div class="head-copy">Copyright &copy; <?php echo date("o"); ?> - <?=SITENAME;?></div>
		<div class="clear"></div>
	</header>
	<div id="body">
		<div id="wrapper">
		
			<div id="midContent">
			
				<div id="leftBox">
				<div class="dashboardBg">
					<div class="dashboardBox">
					<?php 
					if(isset($_SESSION['SESS_MEMBER_ID'])) {
						echo "<span style='font-size: 11px; margin-bottom: 3px; padding-bottom: 5px;'>You're logged in as:<br/><b style='text-transform: uppercase;'>".$_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME']."</span></b><br/>";
						echo "<font style='color: black;'>";
						if($access == 0) {
							echo "Moderator";
						}
						elseif($access == 1) {
							echo "Disc Jockey";
						}
						elseif($access == 2) {
							echo "Administrator";
						}
						echo "</font>";
					}
					?>
					</div>
				</div>
				
				<ul class="adminMenu">
					<li><a href="admin.php">ADMIN HOME</a></li>
					<li><a href="admin.php?page=djonboard">DJ ON BOARD</a></li>
					<?php
						if ($access >= 1) { 
							echo '<li><a href="admin.php?page=autodj">AUTO DJ</a></li>';
							echo '<li><a href="admin.php?page=songreq">SONG REQUEST</a></li>';
						}
						if ($access == 2) { 
							echo '<li><a href="admin.php?page=accounts">ACCOUNTS</a></li>';
						}
					?>
					<li><a href="admin.php?page=staff">STAFF LIST</a></li>
					<li><a href="admin.php?page=settings">SETTINGS</a></li>
					<li><a href="admin.php?page=vip">VIP LIST</a></li>
					<li><a href="admin.php?page=banlist">BAN LIST</a></li>
					<li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?');" style="color: #ffffff;">LOGOUT</a></li>		
				</ul>			

				</div>
				
				<div id="rightBox">
					
					<?php
					
					if (isset($_GET['page'])) {
					
						$page = mysql_real_escape_string($_GET['page']);
						if ($page == "djonboard" && $access >= 0) {
						?>
						<div class="right2Col">
						<div class="right2Col-left">
							<div class="right2Col-Title">DJ ON BOARD</div>
							<div class="right2Col-Cont">
						<?php
							if (isset($_GET['successdj'])) {
							echo "<div class='success'>Successfully Changed!</div>";
						}
						?>
						<form method="post" name="selectaDJ" action="" >
						<table>
							<tr>
								<td>
								<select name="selectDJ" style="width: 240px; height: 35px;">
									<option>-- Choose --</option>
									<option value='0'>NO ACTIVE DJ</option>
								<?php
								$tG_Query2 = mysql_query("SELECT * FROM ".DBPREF."dj_list") or die(mysql_error());
								while($tG_row2 = mysql_fetch_array($tG_Query2)) {
								echo "<option value='".$tG_row2['dj_id']."'>".$tG_row2['dj_name']."</option>";
								}
								?>
								</select>
								</td>
								<td>
								<input name="changeDJ" type="submit" class="defaultButton" style="margin-top: -1px;" id="changeDJ" value="CHANGE"/>
								</td>
							</tr>
						</table>
						</form>
						</div>
						</div>

						<div class="clear"></div>
						</div>
						
						<?php
							if ($access == 2) {
						?>
						<div class="rightTitle">
						ADD NEW DJ
						</div>
						<div class="rightCont">
						<?php
							if (isset($_GET['successadddj'])) {
							echo "<div class='success'>Successfully Added!</div>";
						}
						?>
						<table>
							<form method="post" action="">
								<tr>
									<td><input type="text" name="nameofdj" id="nameofdj" placeholder="NAME OF DJ" style="width: 340px; height: 25px;" required="required"/></td>
									<td><input type="text" name="djuid" id="djuid" placeholder="FACEBOOK UID" style="width: 335px; height: 25px;" required="required"/></td>
								</tr>
								<tr>
									<td><input type="text" name="djtagline" id="djtagline" placeholder="TAG LINE" style="width: 340px; height: 25px;"></td>
									<td><input type="text" name="djtimeslot" id="djtimeslot" placeholder="TIME SLOT" style="width: 335px; height: 25px;"></td>
								</tr>
								<tr>
									<td><input name="addNewDJ" type="submit" class="defaultButton" id="addNewDJ" value="SAVE DJ"/></td>
								</tr>
							</form>
						</table>
						</div>
						
						<div class="rightTitle">DISCJOCKEY LIST</div>
					<div class="rightCont">
						<?php
							$tG_Query = mysql_query("SELECT * FROM ".DBPREF."dj_list ORDER BY dj_name") or die(mysql_error());
							if (!mysql_num_rows($tG_Query)) {
								echo "<div class='note'>There are no record in the database.</div>";
							}
							else {
							while($tG_row=mysql_fetch_array($tG_Query)) {
								echo "<div id=\"{$tG_row['dj_id']}\">";
								echo "<div class=\"stafflist-wrapper\">";
								echo '<div class="user-pic">';
								echo "<a href=\"http://facebook.com/{$tG_row['dj_fbid']}\"><img src=\"https://graph.facebook.com/{$tG_row['dj_fbid']}/picture\" alt=\"\"/></a>";
								echo '</div>';
								echo '<div class="user-info">';
								echo "<span class=\"staff-name\" stlye='line-height: 40px;'><a href=\"http://facebook.com/{$tG_row['dj_fbid']}\" target=\"_blank\">{$tG_row['dj_name']}</a></span>";
								echo '</div>';
								echo '<span class="red-butt" id="removedj" style="float: right;">REMOVE</span>';
								echo '<div class="clear"></div>';
								echo '</div></div>';
								}
							}
						?>
					</div>
					<?php

							}

						} // END OF DJ ON BOARD
						
					if ($page == "autodj" && $access >= 1) {
					?>
					<div class="rightTitle">AUTO DJ</div>
					<div class="rightCont">
						<center>
							<a href="<?=STARTAUTODJ;?>" target="autodjstat"><input type="submit" class="defaultButton" value="START AUTO DJ"/></a> 
							<a href="<?=STOPAUTODJ;?>" target="autodjstat"><input type="submit" class="defaultButton" value="STOP AUTO DJ"/></a>
							<br/><br/>
							<small style="text-shadow: none; color: #1d1d1d;">Choose Action Above and You'll see the result below</small><br/>
							<iframe src="" name="autodjstat" width="100" height="30" scrolling="no" style="background: #f1f1f1; font-family: Arial; margin-top: 3px; border: 2px solid #d1d1d1; text-align: center;" allowTransparency="true"></iframe>
							<br/>
							<span style="text-shadow: none; color: #1d1d1d;">**If you click "STOP" please DO NOT FORGET to <br/>click "START" again after your successful connect to the server.**</span><br/>
						</center>
					</div>
					
					<?php
						} // END OF AUTO DJ
						
					if ($page == "songreq") {
						if ($access >= 1) {
					?>
					
					<div class="right2Col">
						<div class="right2Col-left">
							<div class="right2Col-Title">SONG REQUEST SETTINGS</div>
							<div class="right2Col-Cont">
						<?php
							if (isset($_GET['successdj'])) {
							echo "<div class='success'>Successfully Changed!</div>";
						}
						?>
						<center>
						<a href="javascript:void(0);" onclick="updateReqStatus('open')"><input type="submit" class="defaultButton" value="ACCEPT REQUEST"/></a><a href="javascript:void(0);" onclick="updateReqStatus('close')"><input type="submit" class="defaultButton" style="margin-left: 10px;" value="CLOSE REQUEST"/></a> 
						
						</center>
						</div>
						</div>

						<div class="clear"></div>
						</div>
					<?php
						} // END OF ACCESS 2 - SONG REQUEST
					if ($access >= 0) {
					?>
					
					<div class="rightTitle">SONG REQUEST LIST
					<a href="reqclear.php" onclick="return confirm('Are you sure you want to clear all the requested songs?');"><span class="green-butt" style="float: right; margin-right: 5px; margin-top: 7px;">CLEAR LIST</span></a>
					<a href="javascript:void(0);" id="RefreshReqList"><span class="red-butt" style="float: right; margin-right: 5px; margin-top: 7px;">REFRESH LIST</span></a>
					</div>
					<div class="rightCont">
						<div id="RequestList"></div>
						
					</div>
					
					<?php
							} // END OF ACCESS 0 - SONG REQUEST
						} // END OF SONG REQUEST
						
					if ($page == "banlist" && $access >= 0) {
					?>
					
					<div class="rightTitle">BAN LIST</div>
					<div class="rightCont">
						<?php
							$tG_Query = mysql_query("SELECT * FROM scgfx_ban_list") or die(mysql_error());
							if (!mysql_num_rows($tG_Query)) {
								echo "<div class='note'>There are no record in the database.</div>";
							}
							else {
							while($banlist=mysql_fetch_array($tG_Query)) {
								echo "<div id=\"{$banlist['ban_id']}\">";
								echo "<div class=\"banlist-wrapper\">";
								echo '<div class="user-pic">';
								echo "<a href=\"http://facebook.com/{$banlist['fbid']}\"><img src=\"https://graph.facebook.com/{$banlist['fbid']}/picture\" alt=\"\"/></a>";
								echo '</div>';
								echo '<div class="user-info">';
								echo "<span class=\"user-name\">{$banlist['fbname']}</span>";
								echo "<span class=\"banned-by\">BANNED BY {$banlist['banned_by']}</span>";
								echo '</div>';
								echo '<span class="unban" style="float: right;">UNBAN</span>';
								echo '<div class="clear"></div>';
								echo '</div></div>';
							}
							}
						?>
					</div>
					
					<?php
						} // END OF BAN LIST
						
						if ($page == "vip") {
						
							if ($access == 2) {
					?>
					<div class="right2Col">
						<div class="right2Col-left">
							<div class="right2Col-Title">ADD VIP</div>
							<div class="right2Col-Cont">
						<?php
							if (isset($_GET['successvip'])) {
								echo "<div class='success'>Successfully Added!</div>";
							}
							else if(isset($_GET['vipalreadyexist'])) {
								echo "<div class='error'>Already Exist!</div>";
							}
						?>
						<table style="margin-bottom: 10px;">
						 <form method="post" action="">
							<tr>
								<td><input type="text" id="avip_name" name="avip_name" placeholder="CHANGE NAME" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td><input type="text" id="avip_fbuid" name="avip_fbuid" placeholder="FACEBOOK UID" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td><input type="text" id="avip_days" name="avip_days" placeholder="DAYS SUBSCRIPTION (NUMBER ONLY)" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td>
								<select name="selectVipColor" style="width: 330px; height: 30px;" required="required">
									<option>-- Choose Color --</option>
									<option value='vip-1' style="background: #8a2be2; color: #ffffff;">COLOR #1</option>
									<option value='vip-2' style="background: #c000c0; color: #ffffff;">COLOR #2</option>
									<option value='vip-3' style="background: #008080; color: #ffffff;">COLOR #3</option>
									<option value='vip-4' style="background: #e0400a; color: #ffffff;">COLOR #4</option>
									<option value='vip-5' style="background: #fe7878; color: #ffffff;">COLOR #5</option>
									<option value='vip-6' style="background: #ff69ff; color: #ffffff;">COLOR #6</option>
									<option value='vip-7' style="background: #dc143c; color: #ffffff;">COLOR #7</option>
									<option value='vip-8' style="background: #ffff00; color: #ffffff;">COLOR #8</option>
									<option value='vip-9' style="background: #bc95b8; color: #ffffff;">COLOR #9</option>
									<option value='vip-10' style="background: #69ff69; color: #ffffff;">COLOR #10</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" name="submitNewVip" id="submitNewVip" class="defaultButton" value="ADD VIP"/></td>
							</tr>
						</form>
					</table>
						</div>
						</div>

						<div class="clear"></div>
						</div>
					<?php 
						} // ACCESS 2
					if ($access >= 0) {
					?>
						
					<div class="rightTitle">VIP LIST</div>
					<div class="rightCont">
					<?php
						$tG_Query = mysql_query("SELECT * FROM ".DBPREF."vip_members WHERE vip_status='active'");
						
					if (!mysql_num_rows($tG_Query)) {
								echo "<div class='note'>There are no record in the database.</div>";
						}
					else {
						while($tG_row=mysql_fetch_array($tG_Query)) {
						$exp_date = strtotime(''.$tG_row['vip_expdate'].'');
						$todays_date = date("Y-m-d");
						$today = strtotime($todays_date);
						$timeleft = $exp_date-$today;
						$daysleft = round((($timeleft/24)/60)/60);
						$tG_Query2 = mysql_query("SELECT * FROM scgfx_user_accounts WHERE fbid='".$tG_row['vip_fbid']."'");
						$tG_row2 = mysql_fetch_array($tG_Query2);
						$showexp = date("M d, Y", $exp_date);
						
						echo "<div id=\"{$tG_row['vip_id']}\">";
						echo "<div class=\"banlist-wrapper\">";
						echo '<div class="user-pic">';					
						echo "<a href=\"http://facebook.com/{$tG_row['vip_fbid']}\"><img src=\"https://graph.facebook.com/{$tG_row['vip_fbid']}/picture\" alt=\"\"/></a>";
						echo '</div>';
						echo '<div class="user-info">';
						echo "<span class=\"user-name\">{$tG_row['vip_newname']}</span>";
						echo "<span class=\"banned-by\">EXPIRATION: <b>".$showexp."</b> ";
						if ($daysleft <= 7) {
							echo "( <font style='color: red; text-shadow: red;'>".$daysleft." days left</font> )";
						}
						else {
							echo "( <font style='color: green; text-shadow: green;'>".$daysleft." days left</font> )";
						}
						echo '</span></div>';
						echo '<div class="clear"></div>';
						echo '</div></div>';

					}
					}
					
					
					
					?>
					</div>
					
					<?php
							} // END OF ACCESS 0
						} // END OF VIP LIST
						if ($page == "staff") {
							if ($access == 2) {
					?>
					<div class="rightTitle">
						ADD NEW STAFF
						</div>
						<div class="rightCont">
						<?php
							if (isset($_GET['successnewstaff'])) {
							echo "<div class='success'>Successfully Added!</div>";
						}
						?>
						<table>
							<form method="post" action="">
								<tr>
									<td><input type="text" name="staffname" id="staffname" placeholder="NAME OF STAFF" style="width: 340px; height: 25px;" required="required"/></td>
									<td><input type="text" name="staffuid" id="staffuid" placeholder="FACEBOOK UID" style="width: 335px; height: 25px;" required="required"/></td>
								</tr>
								<tr>
									<td>
									<select name="selectRank" style="width: 345px; height: 30px;">
									<option>-- Choose Rank --</option>
									<option value='5'>ADMIN (Red)</option>
									<option value='3'>MALE DJ (Blue)</option>
									<option value='2'>FEMALE DJ (Pink)</option>
									<option value='4'>MODERATOR (Green)</option>
									</select>
								</td>
								</tr>
								<tr>
									<td><input name="addNewStaff" type="submit" class="defaultButton" id="addNewStaff" value="ADD NEW STAFF"/></td>
								</tr>
							</form>
						</table>
						</div>
					<?php
						} // END OF ACCESS 2 - STAFF LIST
					if ($access >= 0) {
					?>
					<div class="rightTitle">STAFF LIST</div>
					<div class="rightCont">
						<?php
							$tG_Query = mysql_query("SELECT * FROM scgfx_user_accounts WHERE acctype > 0 ORDER BY fbname") or die(mysql_error());
							while($tG_row=mysql_fetch_array($tG_Query)) {
								echo "<div class=\"stafflist-wrapper\">";
								echo '<div class="user-pic">';
								echo "<a href=\"http://facebook.com/{$tG_row['fbid']}\"><img src=\"https://graph.facebook.com/{$tG_row['fbid']}/picture\" alt=\"\"/></a>";
								echo '</div>';
								echo '<div class="user-info">';
								echo "<span class=\"staff-name\" stlye='line-height: 40px;'><a href=\"http://facebook.com/{$tG_row['fbid']}\" target=\"_blank\">{$tG_row['fbname']}</a></span>";
								echo '</div>';
								if ($access == 2) {
								echo '<a href="javascript:void(0);" onclick="if(confirm(\'Remove from Staff?\')) window.location.href=\'admin.php?delstaff='.$tG_row['fbid'].'\';"><span class="red-butt" id="editstaff" style="float: right;">REMOVE</span></a>';
								}
								echo '<div class="clear"></div>';
								echo '</div>';
							}
						?>
					</div>
					<?php
							} // END OF ACCESS 0 - STAFF LIST
						} // END OF STAFF LIST
						
					if ($page == "settings") {
					?>
					<div class="right2Col">
						<div class="right2Col-left">
							<div class="right2Col-Title">CHANGE PASS</div>
							<div class="right2Col-Cont">
						<?php
							if (isset($_GET['pwsuccess'])) {
							echo "<div class='success'>Successfully Changed!</div>";
						}
							if (empty($errors) === false){
							echo "<div class='error'>";
							echo "<ul style='list-style-type: none;'>";
								foreach ($errors as $error){
									echo "<li>{$error}</li>";
								}
							echo "</ul>";
							echo "</div>";
						}
						?>
						<table style="margin-bottom: 10px;">
						 <form method="post" action="">
							<tr>
								<td><input type="password" id="cp_current" name="cp_current" placeholder="CURRENT PASSWORD" style="width: 325px; height: 25px;" value="<?php if(isset($_POST['cp_current'])) { echo $_POST['cp_current']; }?>"/></td>
							</tr>
							<tr>
								<td><input type="password" id="cp_newpass" name="cp_newpass" placeholder="NEW PASSWORD" style="width: 325px; height: 25px;" value="<?php if(isset($_POST['cp_newpass'])) { echo $_POST['cp_newpass']; }?>"/></td>
							</tr>
							<tr>
								<td><input type="password" id="cp_newpass2" name="cp_newpass2" placeholder="REPEAT PASSWORD" style="width: 325px; height: 25px;" value="<?php if(isset($_POST['cp_newpass2'])) { echo $_POST['cp_newpass2']; }?>"/></td>
							</tr>
							<tr>
								<td><input type="submit" name="submitPass" id="submitPass" class="defaultButton" value="CHANGE PASSWORD"/></td>
							</tr>
						</form>
					</table>
						</div>
						</div>

						<div class="clear"></div>
						</div>
						<?php 
							if ($access == 2) {
						?>
					<div class="rightTitle">CHANGE NAME (CHATBOX)</div>
					<div class="rightCont">
					<table>
						<form method="post" action="">
							<tr>
								<td><input type="text" name="cname" id="cname" placeholder="NEW NAME" style="width: 340px; height: 25px;" required="required"></td>
								<td><input type="text" name="cuid" id="cuid" placeholder="FACEBOOK UID" style="width: 335px; height: 25px;" required="required"></td>
							</tr>
							<tr>
								<td><input name="changeName" type="submit" class="defaultButton" id="changeName" value="CHANGE NAME"/></td>
							</tr>
						</form>
					</table>
					</div>
					
					<?php
					}
						} // END OF SETTINGS
						
					if($page == "accounts" && $access == 2) {
					?>
					<div class="right2Col">
						<div class="right2Col-left">
							<div class="right2Col-Title">ADD ACCOUNT</div>
							<div class="right2Col-Cont">
						<?php
							if (isset($_GET['successaddacc'])) {
							echo "<div class='success'>Successfully Added!</div>";
						}
						?>
						<table style="margin-bottom: 10px;">
						 <form method="post" action="">
							<tr>
								<td><input type="text" id="ac_fname" name="ac_fname" placeholder="FIRST NAME" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td><input type="text" id="ac_lname" name="ac_lname" placeholder="LAST NAME" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td><input type="text" id="ac_username" name="ac_username" placeholder="USERNAME" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td><input type="password" id="ac_password" name="ac_password" placeholder="PASSWORD" style="width: 325px; height: 25px;" required="required"/></td>
							</tr>
							<tr>
								<td>
								<select name="selectPosition" style="width: 330px; height: 30px;">
									<option>-- Choose Position --</option>
									<option value='0'>MODERATOR</option>
									<option value='1'>DISC JOCKEY</option>
									<option value='2'>ADMINISTRATOR</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" name="submitNewAcc" id="submitNewAcc" class="defaultButton" value="ADD ACCOUNT"/></td>
							</tr>
						</form>
					</table>
						</div>
						</div>

						<div class="clear"></div>
						</div>
						
					<div class="rightTitle">ACCOUNT LIST</div>
					<div class="rightCont">
					<?php
							$tG_Query = mysql_query("SELECT * FROM ".DBPREF."staff_accounts ORDER BY acctype") or die(mysql_error());
							while($tG_row=mysql_fetch_array($tG_Query)) {
								echo "<div id=\"{$tG_row['member_id']}\">";
								echo "<div class=\"stafflist-wrapper\">";
								echo '<div class="user-info">';
								echo "<span class=\"staff-name\" stlye='line-height: 40px; display: block;'>{$tG_row['firstname']} {$tG_row['lastname']}</a></span>";
								
								echo "<span class=\"position\" style=\"padding-left: 3px;\">";
								if ($tG_row['acctype'] == 0) {
									echo "MODERATOR";
								}
								elseif ($tG_row['acctype'] == 1) {
									echo "DISC JOCKEY";
								}
								elseif ($tG_row['acctype'] == 2) {
									echo "ADMINISTRATOR";
								}
								
								echo "</span>";
								echo '</div>';
								echo '<span class="red-butt" id="removeacc" style="float: right;">DELETE</span>';
								echo '<div class="clear"></div>';
								echo '</div></div>';
							}
						?>
					</div>
					<?php
						} // END OF ACCOUNTS

					}
					
					else {
					?>
					<div class="rightTitle">
					CHATBOX
					</div>
					<div class="rightCont">
						<iframe src="<?=CHATBOXLINK;?>" width="690px" height="600px" height="115px" scrolling="no" frameborder="0"></iframe>
					</div>
					<?php
					}
					
					?>
					
					
				</div>
				<div class="clear"></div>
			</div>
		
		</div>
	</div>
	<footer>
		Admin Dashboard - <b><?=SITENAME;?></b> / <a href="<?=SITEURL;?>"><?=SITEURL;?></a><br/>
		Designed and Coded by: Mike
	</footer>
</body>
</html>