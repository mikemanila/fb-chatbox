<?php 
require '../config.php';
require 'lib/facebook/facebook.php';

$facebook = new Facebook(array(
		'appId'		=> $appID,
		'secret'	=> $appSecret,
		));

//get the user facebook id		
$user = $facebook->getUser();

if($user){

	try{
		//get the facebook user profile data
		$getUserInfo = $facebook->api('/me');
		$params = array('next' => $base_url.'logout.php');
		//logout url
		$logout =$facebook->getLogoutUrl($params);
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}		
}
	
if(!empty($user)){
//login url	

	$userInfo = $getUserInfo;
	$_SESSION['ses_id'] = md5(microtime());
    $buid = $userInfo['id'];
	$user = mysql_query("SELECT * FROM `scgfx_user_accounts` WHERE `fbid`='".$buid."'");

	if(mysql_num_rows($user)>0) {
		$userdata = mysql_fetch_assoc($user);

		if($userdata['last_request_time']<=(time()-10800)) {
			mysql_query("INSERT INTO `scgfx_chats` VALUES('','Welcome back to ".GLOBAL_NAME." <b>".$userdata['fbname']."</b>','0','global','".time()."')");
		}
		mysql_query("UPDATE `scgfx_user_accounts` SET 
											`gender`			=	'".$userInfo['gender']."',
											`ses_id`			=	'".$_SESSION['ses_id']."',
											`active`			=	'1',
											`sign_time`			=	CURRENT_TIMESTAMP,
											`last_request_time`	=	'".time()."',
											`ip_address`		=	'".$_SERVER['REMOTE_ADDR']."' WHERE `fbid`='".$userInfo['id']."'");

	} else {
		mysql_query("INSERT INTO `scgfx_user_accounts` VALUES('',
											'".$userInfo['id']."',
											'".$userInfo['name']."',
											'".$userInfo['gender']."',
											'0',
											'".$_SESSION['ses_id']."',
											'1',
											CURRENT_TIMESTAMP,
											'".time()."',
											'".$_SERVER['REMOTE_ADDR']."','0','0')");
		mysql_query("INSERT INTO `scgfx_chats` VALUES('','We have a new member :) Welcome to ".GLOBAL_NAME." <b>".$userInfo['name']."</b>!<br/>Enjoy your stay!','0','global','".time()."')");
	}

	if(isset($_SESSION['ses_id'])) {
		$getUserInfo = mysql_query("SELECT * FROM `scgfx_user_accounts` WHERE `ses_id`='".$_SESSION['ses_id']."'");
		if(mysql_num_rows($getUserInfo)>0) {
			while($data=mysql_fetch_assoc($getUserInfo)) {
				$_SESSION['fbid'] = $data['fbid'];
				$_SESSION['name'] = $data['fbname'];
				$_SESSION['gender'] = $data['gender'];
				$_SESSION['acctype'] = $data['acctype'];
				$_SESSION['points'] = $data['points'];
			}
		} else {
					die("Invalid Session ID");
		}
	?>
		<script>

        window.close();
        window.opener.location.reload();
		</script>
		<?php
	}
}

else {
	$loginurl = $facebook->getLoginUrl(array(
				'scope'			=> 'email,read_stream,offline_access,publish_stream,user_status,user_photos',
				'display'=>'popup'
				));
	header('Location: '.$loginurl);
}
?>
<!-- after authentication close the popup  -->