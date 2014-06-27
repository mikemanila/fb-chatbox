<?php
header('Content-Type: text/html; charset=utf-8');
include('./config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<link rel="stylesheet" href="css/cbox.css?rev=1203242014" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/mggfx-v8.js?rev=12133222014"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="js/oauthpopup.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
	    $('input#fbconnect').click(function(e){
	        $.oauthpopup({
	            path: 'fb/fbConnect.php',
				width:600,
				height:300,
	            callback: function(){
	                window.location.reload();
	            }
	        });
			e.preventDefault();
	    });
	});

	</script>
</head>

<body>


<div id="scGFX-chat">

	<div id="scGFX-composer">
		<?php if(isset($_SESSION['ses_id']) && (!$_SESSION['name'] == '')) { ?>
		<div class="composer-wrapper">
			<a href="#" class="composer-user-pic">
				<img src="https://graph.facebook.com/<?php echo $_SESSION['fbid']; ?>/picture">
			</a>
			<div class="composer-input">
				<form id="formComposer">
				<div class="composer-text">
					<input type="text" name="msg" id="hello" class="composer-text" autocomplete="off" value="" required>
					<input type="hidden" id="sesid" value="<?php echo $_SESSION['ses_id']; ?>">
					<input type="hidden" id="fbid" value="<?php echo $_SESSION['fbid']; ?>">
					<input type="hidden" id="fbname" value="<?php echo $_SESSION['name']; ?>">
					<input type="hidden" id="acctype" value="<?php echo $_SESSION['acctype']; ?>">
					<input type="hidden" id="points" value="<?php echo $_SESSION['points']; ?>">
					<input type="hidden" id="gender" value="<?php echo $_SESSION['gender']; ?>">
					<input type="hidden" id="legend" value="<?php echo $_SESSION['legend']; ?>">
				</div>
<input type="submit" class="send-butt" title="Send Chat" value="Send" />
				</form>
				<div class="composer-buttons">
					<input type="submit" id="Smiley" class="butt" title="Add Emoticons" value="Emoticons" style="margin-left: 5px;"/>
					<input type="submit" id="refresh" onClick="history.go()" class="butt" title="Clear Chat" value="Refresh" />
					<input type="submit" id="logout" onClick="location.href='logout.php'" class="butt" title="Clear Chat" value="Sign Out" />

					<div class="smiley-wrapper">

						<img src="css/img/cbox/smileys/1.gif" class="smlys" alt="(y)"/>
						<img src="css/img/cbox/smileys/2.gif" class="smlys" alt=":p"/>
						<img src="css/img/cbox/smileys/3.gif" class="smlys" alt="*clap*"/>
						<img src="css/img/cbox/smileys/4.gif" class="smlys" alt="*peace*"/>
						<img src="css/img/cbox/smileys/5.gif" class="smlys" alt="*angel*"/>
						<img src="css/img/cbox/smileys/6.gif" class="smlys" alt="*bleh*"/>
						<img src="css/img/cbox/smileys/7.gif" class="smlys" alt="*dance*"/>
						<img src="css/img/cbox/smileys/8.gif" class="smlys" alt=":)"/>
						<img src="css/img/cbox/smileys/9.gif" class="smlys" alt=":(("/>
						<img src="css/img/cbox/smileys/10.gif" class="smlys" alt="*inlove*"/>
						<img src="css/img/cbox/smileys/11.gif" class="smlys" alt="*laway*"/>
						<img src="css/img/cbox/smileys/12.gif" class="smlys" alt="*shh*"/>
						<img src="css/img/cbox/smileys/13.gif" class="smlys" alt="<3"/>
						<img src="css/img/cbox/smileys/14.gif" class="smlys" alt="*wawa*"/>
						<img src="css/img/cbox/smileys/15.gif" class="smlys" alt="*ninja*"/>
						<img src="css/img/cbox/smileys/16.gif" class="smlys" alt=":("/>
						<img src="css/img/cbox/smileys/17.gif" class="smlys" alt="*green*"/>
						<img src="css/img/cbox/smileys/18.gif" class="smlys" alt="*hearts*"/>
						<img src="css/img/cbox/smileys/19.gif" class="smlys" alt="*kiss*"/>
						<img src="css/img/cbox/smileys/20.gif" class="smlys" alt="*slap*"/>
						<img src="css/img/cbox/smileys/21.gif" class="smlys" alt="*daldal*"/>
						<img src="css/img/cbox/smileys/22.gif" class="smlys" alt=":D"/>
						<img src="css/img/cbox/smileys/23.gif" class="smlys" alt="*mwua*"/>
						<img src="css/img/cbox/smileys/24.gif" class="smlys" alt="*kyut*"/>
						<img src="css/img/cbox/smileys/25.gif" class="smlys" alt="*sexy*"/>
						<img src="css/img/cbox/smileys/26.gif" class="smlys" alt="*rockstar*"/>
						<img src="css/img/cbox/smileys/27.gif" class="smlys" alt="*baby*"/>
						<img src="css/img/cbox/smileys/28.gif" class="smlys" alt="*girldancing*"/>
						<img src="css/img/cbox/smileys/29.gif" class="smlys" alt="*sablay*"/>
						<img src="css/img/cbox/smileys/30.gif" class="smlys" alt="*peace2*"/>
						<img src="css/img/cbox/smileys/31.gif" class="smlys" alt="*nganga*"/>
						<img src="css/img/cbox/smileys/32.gif" class="smlys" alt="*wb*"/>
						<img src="css/img/cbox/smileys/33.gif" class="smlys" alt="*hi*"/>
						<img src="css/img/cbox/smileys/34.gif" class="smlys" alt="*number1*"/>
						<img src="css/img/cbox/smileys/35.gif" class="smlys" alt="*reading*"/>
						<img src="css/img/cbox/smileys/36.gif" class="smlys" alt="*bye*"/>
						<img src="css/img/cbox/smileys/37.gif" class="smlys" alt="*lalala*"/>
						<img src="css/img/cbox/smileys/38.gif" class="smlys" alt="*wiggle*"/>
						<img src="css/img/cbox/smileys/39.gif" class="smlys" alt="*tawa*"/>
						<img src="css/img/cbox/smileys/40.gif" class="smlys" alt="*hampas*"/>
						<img src="css/img/cbox/smileys/41.gif" class="smlys" alt="*iyak*"/>
						<img src="css/img/cbox/smileys/42.gif" class="smlys" alt="*palo*"/>
						<img src="css/img/cbox/smileys/43.gif" class="smlys" alt="*gangnam*"/>
                        <img src="css/img/cbox/smileys/44.gif" class="smlys" alt="*yosi*"/>  
                        <img src="css/img/cbox/smileys/45.gif" class="smlys" alt="*bulong*"/>  
                        <img src="css/img/cbox/smileys/46.gif" class="smlys" alt="*lipad*"/>   
                        <img src="css/img/cbox/smileys/47.gif" class="smlys" alt="*kulangot*"/>   
                        <img src="css/img/cbox/smileys/48.gif" class="smlys" alt="*inlove2*"/>   
                        <img src="css/img/cbox/smileys/49.gif" class="smlys" alt="*search*"/>   
                        <img src="css/img/cbox/smileys/50.gif" class="smlys" alt="*kaen*"/>   
                        <img src="css/img/cbox/smileys/51.gif" class="smlys" alt="*loveu*"/>   
                        <img src="css/img/cbox/smileys/52.gif" class="smlys" alt="*hanap*"/>   
                        <img src="css/img/cbox/smileys/53.gif" class="smlys" alt="*ligo*"/>   
                        <img src="css/img/cbox/smileys/54.gif" class="smlys" alt="*ookk*"/>   
                        <img src="css/img/cbox/smileys/55.gif" class="smlys" alt="*init*"/>   
                        <img src="css/img/cbox/smileys/56.gif" class="smlys" alt="*alone2*"/>   
                        <img src="css/img/cbox/smileys/57.gif" class="smlys" alt="*imdead*"/>   
                        <img src="css/img/cbox/smileys/58.gif" class="smlys" alt="*galit2*"/>   
                        <img src="css/img/cbox/smileys/59.gif" class="smlys" alt="*hbd*"/>   
                        <img src="css/img/cbox/smileys/60.gif" class="smlys" alt="*bgkiss*"/>   
                        <img src="css/img/cbox/smileys/61.gif" class="smlys" alt="*night*"/>   
                        <img src="css/img/cbox/smileys/62.gif" class="smlys" alt="*ohyeah*"/>   
                        <img src="css/img/cbox/smileys/63.gif" class="smlys" alt="*rnr*"/>   
                        <img src="css/img/cbox/smileys/64.gif" class="smlys" alt="*pig*"/>   
                        <img src="css/img/cbox/smileys/65.gif" class="smlys" alt="*sakit*"/>   
                        <img src="css/img/cbox/smileys/66.gif" class="smlys" alt="*cold*"/>   
                        <img src="css/img/cbox/smileys/67.gif" class="smlys" alt="*smile3*"/>   
                        <img src="css/img/cbox/smileys/68.gif" class="smlys" alt="*dance3*"/>   
                        <img src="css/img/cbox/smileys/69.gif" class="smlys" alt="*dance4*"/>   
                        <img src="css/img/cbox/smileys/70.gif" class="smlys" alt="*dance5*"/>   
                        <img src="css/img/cbox/smileys/71.gif" class="smlys" alt="*shy3*"/>   
                        <img src="css/img/cbox/smileys/72.gif" class="smlys" alt=":72"/>   
                        <img src="css/img/cbox/smileys/73.gif" class="smlys" alt=":73"/>    
                        <img src="css/img/cbox/smileys/74.gif" class="smlys" alt=":74"/>
                        <img src="css/img/cbox/smileys/75.gif" class="smlys" alt=":75"/>
                        <img src="css/img/cbox/smileys/76.gif" class="smlys" alt=":76"/>
                        <img src="css/img/cbox/smileys/77.gif" class="smlys" alt=":77"/>
                        <img src="css/img/cbox/smileys/78.gif" class="smlys" alt=":78"/>   
                        <img src="css/img/cbox/smileys/79.gif" class="smlys" alt=":79"/>
                        <img src="css/img/cbox/smileys/80.gif" class="smlys" alt=":80"/>
                        <img src="css/img/cbox/smileys/81.gif" class="smlys" alt=":81"/>
                        <img src="css/img/cbox/smileys/82.gif" class="smlys" alt=":82"/>
                        <img src="css/img/cbox/smileys/83.gif" class="smlys" alt=":83"/>
                        <img src="css/img/cbox/smileys/84.png" class="smlys" alt=":84"/>   
                        <img src="css/img/cbox/smileys/85.png" class="smlys" alt=":85"/>
                        <img src="css/img/cbox/smileys/86.png" class="smlys" alt=":86"/>   
                        <img src="css/img/cbox/smileys/87.png" class="smlys" alt=":87"/>   
                        <img src="css/img/cbox/smileys/88.png" class="smlys" alt=":88"/>
                        <img src="css/img/cbox/smileys/89.png" class="smlys" alt=":89"/>
                        <img src="css/img/cbox/smileys/90.png" class="smlys" alt=":90"/>
                        <img src="css/img/cbox/smileys/91.png" class="smlys" alt=":91"/>   
                        <img src="css/img/cbox/smileys/92.png" class="smlys" alt=":92"/>   
                        <img src="css/img/cbox/smileys/93.png" class="smlys" alt=":93"/>
                        <img src="css/img/cbox/smileys/94.png" class="smlys" alt=":94"/>
                        <img src="css/img/cbox/smileys/95.png" class="smlys" alt=":95"/>
                        <img src="css/img/cbox/smileys/96.png" class="smlys" alt=":96"/>
                        <img src="css/img/cbox/smileys/97.png" class="smlys" alt=":97"/>
                        <img src="css/img/cbox/smileys/98.png" class="smlys" alt=":98"/>

					</div>
				</div>

			</div>
		</div>

		<?php } else { ?>
		<div class="composer-wrapper fbc">
<input type="submit" value="Connect to Facebook" onClick="post2wall2();" id="fbconnect" class="composer-submit">


		</div>
		<?php } ?>
	</div>
	<div id="scGFX-container">
		
			 
		<div class="chat-wrapper" style="height: 500px">
		</div>
	</div>

</div>

<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
FB.init({appId: "", status: true, cookie: true});
var post2wall = function(){    
    // calling the API ...
    var obj = {
        message: '',
        link: 'http://cr8tivemanila.com',
        picture: '',
        name: 'DJ Mike | Online Radio',
        caption: 'radyo ng ofw pilipino',
        description: 'The only Radio Station that brings you the best songs 24/7! San ka pa? Tambay na!  | DJ Mike'
    };

    
    FB.api("/me/feed", "post", obj, function(response){
        return;
    });
}
</script>
</body>
</html>