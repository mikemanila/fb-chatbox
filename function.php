<?php
	include('./config.php');
	
	try {

	
	$chat = new chat();
	$chat->updateLastRequest();
	$getAction = mysql_real_escape_string($_GET['act']);
		switch($getAction) {

			case 'sendMsg':
				$callback = $chat->sendMsg($_POST['msg'],$_POST['sesid']);
			break;

			case 'getMsg':
				$callback = $chat->getMsg($_GET['lastid']);
			break;
			
			case 'banUser':
				$callback = $chat->banUser($_POST['sesid'],$_POST['fbid']);
			break;

			case 'WarnUser':
				$callback = $chat->WarnUser($_POST['sesid'],$_POST['fbid'],mysql_real_escape_string($_POST['reason']));
			break;

			case 'indexReturnInfo':
				$callback = $chat->indexReturnInfo();
			break;

			default:
				$callback = $chat->response(0,'Invalid action');
		
		}
		
		mysql_close($con);
                echo json_encode($callback);
	
	} catch(Exception $e) {
		echo $e;
	}
	
class chat {

	public function getMyAccount() {
	if(isset($_SESSION['ses_id'])) {
		$result = array();
		$query = mysql_query("SELECT `fbid`, `fbname`, `points` FROM scgfx_user_accounts WHERE `ses_id`='".$_SESSION['ses_id']."'");
		while($row = mysql_fetch_assoc($query)) {
			$result[] = $row;
		}
		return $result;
	} else {
		return 'null';
	}
}

	public function getTopChatters() {
		$result = array();
		$query = mysql_query("SELECT `fbid`, `fbname`, `points` FROM scgfx_user_accounts ORDER BY `points` DESC LIMIT 10"); //lagay mo query mo dito kung ano lng dapat ung irereturn mo
		while($row = mysql_fetch_assoc($query)) {
			$result[] = $row;
		}
		return $result;
	}

	public function indexReturnInfo() {
		return array(
			"myAccount" => $this->getMyAccount(),
			"topChatters" => $this->getTopChatters()
		);
	}

	public function sendMsg($msg,$sesid) {
	
		if($this->checkSesid($sesid)) {
			$fbuid = $this->checkSesid($sesid);
			if(!$this->checkBan($fbuid)) {
				return $this->response(0,'You banned lol!');
			}
			
			if(empty($msg) || ctype_space($msg)) {
				return $this->response(0,'Empty Message!');
			}

			$mainMsg = $this->esc($msg);

			$reg_exUrl = "/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			if(preg_match($reg_exUrl, $mainMsg, $url)) {
			$blockLink = preg_replace($reg_exUrl, '<font color="red">***</font>', $mainMsg);
			mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES('','".$blockLink."','".$this->checkSesid($sesid)."','normal','".time()."')");

			$getName = mysql_query("SELECT fbid,fbname FROM `".DB_PREFIX."user_accounts` WHERE fbid='".$this->checkSesid($sesid)."'");
			$getNameRow = mysql_fetch_array($getName);
			
			mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES('','<b>".$getNameRow['fbname']."</b>, Please be reminded of the rules!<br/>Your chat may have contained inappropriate link which is strictly not allowed.','0','warn','".time()."')");
			}
			else {
			mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES('','".$this->esc($msg)."','".$this->checkSesid($sesid)."','normal','".time()."')");
			}


			$acctyp = "vip";
                        mysql_query("UPDATE `".DB_PREFIX."user_accounts` SET `points` = `points` + .60, `active` = '1' WHERE `fbid` = ".$fbuid." AND acctype LIKE '%$acctyp%'");
                        mysql_query("UPDATE `".DB_PREFIX."user_accounts` SET `points` = `points` + .10, `active` = '1' WHERE `fbid` = ".$fbuid."");


			if($this->getlastmsgid()%20==0) {
				mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES('','".GLOBAL_MESSAGE."','0','global','".time()."')");
			}

			return $this->response(1,'Sent');
		} else {
			return $this->response(0,'Fail');
		}
		
	}
	
	public function getMsg($msgid) {
	
		if(!isset($msgid) || $msgid==0) {
			$msgid = $this->getlastmsgid()-15;
		}
	
		$sql="SELECT * FROM `".DB_PREFIX."chats` WHERE msg_id > '".$this->esc($msgid)."' ORDER BY msg_id ASC";

		$result=mysql_query($sql);

		$arr = array();
		while($row = mysql_fetch_assoc($result)) {
			$x = $this->getUserInfo($row['fbid']);
			$newRow = array(
				'msgid'	 => $row['msg_id'],
				'msg'		=> $row['msg'],
				'fbid'		=> $row['fbid'],
				'name'		=> $x['fbname'],
				'acctype'	=> $x['acctype'],
				'points'	=> $x['points'],
				'legend'	=> $x['legend'],
				'gender'	=> $x['gender'],
				'time'		=> $row['time'],
				'msgType'	=> $row['msg_type']
			);
			$arr[] = $newRow;
		}

		$newArr = array("msg" => $arr);
		return $newArr;
		
	}
	
	public function getUserInfo($q) {
	
		$sql = mysql_query("SELECT * FROM `".DB_PREFIX."user_accounts` WHERE `fbid`='".$q."'");
		if(mysql_num_rows($sql)>0) {
			return mysql_fetch_assoc($sql);
		} else {
			return $this->response(0,'User not found!');
		}
	
	}
	
	public function getlastmsgid() {
		$getLastmsgid = mysql_query("SELECT * FROM `".DB_PREFIX."chats` ORDER BY msg_id DESC LIMIT 1");
		$getLastmsgid = mysql_fetch_assoc($getLastmsgid);
		return $getLastmsgid['msg_id'];
	}
	
	public function checkSesid($sesid) {
	
		$chk = mysql_query("SELECT * FROM `".DB_PREFIX."user_accounts` WHERE `ses_id`='".$this->esc($sesid)."'");
		if(mysql_num_rows($chk)>0) {
			while($data=mysql_fetch_array($chk)) {
				return $data['fbid'];
			}
		} else {
			return false;
		}
	
	}
	
	public function checkBan($fbid) {
		$chkban = mysql_query("SELECT * FROM `".DB_PREFIX."ban_list` WHERE `fbid`='".$fbid."'");
		if(mysql_num_rows($chkban)>0) {
			return false; //if banned
		} else {
			return true; //not banned
		}
	}
	
	public function banUser($sesid,$fbid) {
		if($this->checkSesid($sesid)) {
			if($this->checkBan($fbid)) {
				$x = $this->getUserInfo($this->checkSesid($sesid));
				$y = $this->getUserInfo($fbid);
				if($x['acctype']>0) {
					mysql_query("INSERT INTO `".DB_PREFIX."ban_list` VALUES('','".$fbid."','".$y['fbname']."','".$x['fbname']."')");
					mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES ('','A Ban has been issued to <b style=\'color: red;\'>".$y['fbname']."</b> by ".$x['fbname']."','0','ban','".time()."')");
					return $this->response(1,'User banned!');
				} else {
					return $this->response(0,'Intruder alert!');
				}				
			} else {
				return $this->response(0,'User already banned!');
			}
		} else {
			return $this->response(0,'Intruder alert!');
		}
	}

	public function WarnUser($sesid,$fbid) {
		if($this->checkSesid($sesid)) {
			$x = $this->getUserInfo($this->checkSesid($sesid));
			$y = $this->getUserInfo($fbid);
			
				if($x['acctype']>0) {
					mysql_query("INSERT INTO `".DB_PREFIX."chats` VALUES ('','A Warning has been issued to <b style=\'color: red;\'>".$y['fbname']."</b> by <b>".$x['fbname']."</b><br/><b>Reason</b>: <i>".$_POST['reason']."</i><br/>Please be reminded of the rules.','0','warn','".time()."')");
					return $this->response(1,'User banned!');
				} else {
					return $this->response(0,'Intruder alert!');
				}				
		} else {
			return $this->response(0,'Intruder alert!');
		}
	}

	
	public function updateLastRequest() {
		if(isset($_SESSION['ses_id'])) {
			$_SESSION['ses_id'] = $_SESSION['ses_id'];
			$x = $this->getUserInfo($this->checkSesid($_SESSION['ses_id']));
			mysql_query("UPDATE `".DB_PREFIX."user_accounts` SET `last_request_time`='".time()."' WHERE `ses_id`='".$_SESSION['ses_id']."'");
		}
	}

	
	public function esc($str){
		return mysql_real_escape_string(htmlspecialchars($str));
	}

	public function response($status,$text) {
		return array(
			'status'	=> $status,
			'text'		=> $text
		);
	}
	
}
?>