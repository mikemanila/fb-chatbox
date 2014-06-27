<?php
	include("config.php");
mysql_query("UPDATE scgfx_user_accounts SET active='0' WHERE ses_id = '".$_SESSION['ses_id']."'") or die(mysql_error());
	unset($_SESSION['ses_id']);
        session_destroy();
	header("Location:./index.php");
?>