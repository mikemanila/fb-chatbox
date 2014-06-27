<html>
<head>

	<title>Radio Virtual FM - Ang Sarap DIto!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content="Radio Virtual FM - Ang Sarap DIto!">
	<meta name="author" content="RVFM">
	<meta property="og:url" content="http://radiovirtualfm975.blogspot.com/">
	<meta property="og:title" content="RVFM">
	<meta property="og:description" content="Radio Virtual FM - Ang Sarap DIto!">
	<meta property="og:image" content="logo.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="icon" type="image/png" href="favicon.png">
	<!--[if IE]><link rel="SHORTCUT ICON" href="favicon.ico"/><![endif]-->
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/mggfx.imusicfm.js?v=1.0.0"></script>
	<script type="text/javascript" src="js/jquery.tickertype.js"></script>
    <script src="css/javascript/fw.js" type="text/javascript"></script>
    
<link type="text/css" rel="stylesheet" href="chrome-extension://cpngackimfmofbokmjmljamhdncknpmg/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://cpngackimfmofbokmjmljamhdncknpmg/js/page_context.js"></script></head>

<body>
<div class="mgGfx-defContent margBott-10" style="width: 270px;">
							<ul class="online-users"><style>
::-webkit-scrollbar {
    width: 5px;
	margin-right: 5px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(5,90,170,0.3);
}
 
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 2px;
    background: #890D10; 
    -webkit-box-shadow: inset 0 0 6px #333); 
}

::-webkit-scrollbar-thumb:window-inactive {
	background: #0E0E0E; 
}
</style>





<?php
require_once('config.php');
?>
<div class="rightTitle">ONLINE USERS</div>
					<div class="rightCont">
						<?php
							$tG_Query = mysql_query("SELECT * FROM scgfx_user_accounts WHERE active > 0 ORDER BY fbname") or die(mysql_error());
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
					
					
</body>					
</html>