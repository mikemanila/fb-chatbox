$(window).bind("load", function() { 
	var chatHeight = $('#scGFX-chat').height()-90;
	$('.chat-wrapper').css('height', chatHeight);
});
$(document).ready(function(){
	scGFX.init();

	$("#request-butt").click(function(){
		$( "#srViewer" ).fadeIn();
	});

	$(".request-close").click(function(){
		$( "#srViewer" ).fadeOut();
	});

	$("#logmeout").click(function() {
		$('#hello').val($('#hello').val() + 'Thank you po sa lahat! Bye bye.');
		$('#hello').submit();
	});

	$(".smlys").click(function(){
		$('input.composer-text').val($('input.composer-text').val()+$(this).attr("alt"));
		$("input.composer-text").focus();
		$(".smiley-wrapper").hide();
	});
	
	$("input#Smiley").click(function(){ $(".smiley-wrapper").slideToggle(200); });

});

var scGFX = {
	init: function() {
	
		var working = false;
		var lastid = 0;
		var doneAll = 1;
		var activity = 0;

		$("#clear").click( function() {
		   $(".chat-wrapper").children().fadeOut(1000, function() { $(this).children().remove(); });
		});
		
		$('#formComposer').submit(function(e) {
		
			var textVal = $("#hello").val().length;
			  if(textVal < 2) {
				alert('Please enter a longer message.');
				return false;
			  }

			e.preventDefault();
				if(working) return false;
				
				var msg = $('input.composer-text').val();
				
				
				
				working = true;
				
					var tempmsgID = Math.floor(Math.random()*32767);
					userData = {
						msgid		: 'tempmsg-'+tempmsgID,
						fbid		: $('input#fbid').val(),
						name		: $('input#fbname').val(),
						acctype		: $('input#acctype').val(),
						points		: $('input#points').val(),
						gender		: $('input#gender').val(),
						legend		: $('input#legend').val(),
						time		: Math.round(new Date().getTime() / 1000),
						msg			: msg.replace(/</g,'&lt;').replace(/>/g,'&gt;'),
						msgType		: 'normal'
					};
					
				scGFX.addChat(userData); $('input.composer-text').val('').focusout();

				$.ajax({
					type: "POST",
					url: "function.php?act=sendMsg",
					data: "msg="+userData.msg+"&sesid="+$('input#sesid').val(),
					dataType: "jsonEntity",
					success: function(data){
						if(data.status!=1) {
							scGFX.error(data.text);
							$('div.msg-tempmsg-'+tempmsgID).remove();
						}
					}
				});


				var aTimer = null;
	$('#hello').blur();
	$('#hello').val($('#hello').val() + 'Please wait 5 seconds to chat again..').attr('disabled', 'disabled');
	$('.composer-submit3').attr("disabled", true);
		aTimer = setTimeout(function(){
			$('#hello').val('').removeAttr("disabled");
			$('.composer-submit3').removeAttr("disabled", true);
			$("input.composer-text").focus();
		},5000);

				
				working = false;
		});
	
		(function TimeoutFunction(){
			scGFX.liveTime(TimeoutFunction);
		})();

		(function getChatsFunction(){
			scGFX.getChats(getChatsFunction);
		})();
	
	},
	
	addChat: function(userData) {
		
		var ex = $("div.msg-"+userData.msgid);
		if(ex.length) ex.remove();
		
		while($("div.chat-wrapper").children().size()>60) {
			$("div.chat-wrapper > div:last").remove();
		}
		switch(userData.msgType) {			
		
case 'normal':
	var BadWordsToRemove = "titi|puke|leche|tang ina|pota|futa|puta|fuck|bitch|tite|pekpek|bobo|tanga|gago|dede|boobs|suso|nipple|utong";
	var removeBadWord = new RegExp(BadWordsToRemove, 'gi');
	var cleanChat = scGFX.smileys(userData.msg).replace(removeBadWord, '****');
	var current = "rank-1";
		if(userData.points > 0 && userData.points < 100) { current = "rank-1"; }
		else if(userData.points > 100 && userData.points < 250) { current = "rank-2"; }
		else if(userData.points > 250 && userData.points < 450) { current = "rank-3"; }
		else if(userData.points > 450 && userData.points < 650) { current = "rank-4"; }
		else if(userData.points > 650 && userData.points < 1000) { current = "rank-5"; }
		else if(userData.points > 1000 && userData.points < 1300) { current = "rank-6"; }
		else if(userData.points > 1300 && userData.points < 1650) { current = "rank-7"; }
		else if(userData.points > 1650 && userData.points < 2050) { current = "rank-8"; }
		else if(userData.points > 2050 && userData.points < 2500) { current = "rank-9"; }
		else if(userData.points > 2500 && userData.points < 3600) { current = "rank-10"; }
		else if(userData.points > 3600 && userData.points < 4200) { current = "rank-11"; }
		else if(userData.points > 4200 && userData.points < 4850) { current = "rank-12"; }
		else if(userData.points > 4850 && userData.points < 5550) { current = "rank-13"; }
		else if(userData.points > 5550 && userData.points < 6500) { current = "rank-14"; }
		else if(userData.points > 6500 && userData.points < 7300) { current = "rank-15"; }
		else if(userData.points > 7300 && userData.points < 8150) { current = "rank-16"; }
		else if(userData.points > 8150 && userData.points < 9050) { current = "rank-17"; }
		else if(userData.points > 9050 && userData.points < 10000) { current = "rank-18"; }
		else if(userData.points > 10000 && userData.points < 11000) { current = "rank-19"; }
		else if(userData.points > 11000 && userData.points < 12200) { current = "rank-20"; }
		else if(userData.points > 12200 && userData.points < 13600) { current = "rank-21"; }
		else if(userData.points > 13600 && userData.points < 15200) { current = "rank-22"; }
		else if(userData.points > 15200 && userData.points < 17000) { current = "rank-23"; }
		else if(userData.points > 17000 && userData.points < 19000) { current = "rank-24"; }
		else if(userData.points > 19000 && userData.points < 21200) { current = "rank-25"; }
		else if(userData.points > 21200 && userData.points < 23600) { current = "rank-26"; }
		else if(userData.points > 23600 && userData.points < 26200) { current = "rank-27"; }
		else if(userData.points > 26200 && userData.points < 29000) { current = "rank-28"; }
		else if(userData.points > 29000 && userData.points < 32000) { current = "rank-29"; }
		else if(userData.points > 32000 && userData.points < 40000) { current = "rank-30"; }
		else if(userData.points > 40000) { current = "rank-30"; }
		else { current = "rank-1"; }

	var position = "[ Member ]";
		if(userData.acctype == 1) { position = "[ Chatbox Bot ]"; }
		else if(userData.acctype == 2) { position = "[ Owner ]"; }
		else if(userData.acctype == 3) { position = "[ Administrator ]"; }
		else if(userData.acctype == 4) { position = "[ Male Disc Jockey ]"; }
		else if(userData.acctype == 5) { position = "[ Female Disc Jockey ]"; }
		else if(userData.acctype == 6) { position = "[ Moderator ]"; }
		else if (userData.acctype.match(/^pf.*$/)) { position = "[ Pinoy Force ]"; }
		else if (userData.acctype.match(/^emp.*$/)) { position = "[ Emperor Team ]"; }
		else if (userData.acctype.match(/^iag.*$/)) { position = "[ I.A.G Alliance ]"; }
		else if (userData.acctype.match(/^vip.*$/)) { position = "[ VIP Member ]"; }
		else { position = "[ Member ]"; }

	var x = '<div style="width: auto; height: auto; overflow: hidden; margin-bottom: 3px;">';
		x = x+'<div class="msg-'+userData.msgid+'" style="display: block;">';
		x = x+'<table>';
		x = x+'<tr>';
		x = x+'<td style="vertical-align: top; padding-left: 3px; padding-right: 12px;">';
		x = x+'<div class="cb-avabg">';
		var reply = ($('input#fbid').val()!=userData.fbid) ? '<div class="cb-reply" id="'+userData.name+'" onclick="scGFX.addReply('+userData.fbid+',this.id);" title="Reply to '+userData.name+'"></div>': '<div class="cb-reply-blank"></div>';
		var replyMsg = ($('input#fbid').val()!=userData.fbid) ? 'class="cb-reply" id="'+userData.name+'" onclick="scGFX.addReply('+userData.fbid+',this.id);" title="Reply to '+userData.name+'"': 'class="cb-reply-blank"';
		x = x+reply;
		x = x+'<img src="https://graph.facebook.com/'+userData.fbid+'/picture" class="cb-avabg">';
		x = x+'</div>';
		x = x+'</td>';

		x = x+'<td style="vertical-align: top; width: 97%;">';
		x = x+'<div class="cb-info">';
		x = x+'<div style="width: auto; height: 19px; float: left;">';
		x = x+'<div class="cb-name pos-'+userData.acctype+'"><a href="https://www.facebook.com/'+userData.fbid+'" target="_blank">'+userData.name+'</a></div>';
		x = x+'<small class="position"> '+position+' </small>';
		x = "male" == userData.gender ? x + '<div class="male-gender"></div>' : x + '<div class="female-gender"></div>';
		if($('input#acctype').val()>0 && userData.acctype==0) {
			x = x+'<div class="ban" id="'+userData.name+'" onclick="BanUser('+userData.fbid+',this.id)" title="Ban '+userData.name+' ?"></div>';
			x = x+'<div class="warn" id="'+userData.name+'" onclick="WarnUser('+userData.fbid+',this.id)" title="Warn '+userData.name+' ?"></div>';
		}
		x = x+'<div class="clear"></div>';
		x = x+'</div>';

		x = x+'<div style="width: auto; float: right;">';
		x = x+'<div class="cb-time-rank">';
		x = x+'<span class="cb-time" data-unix-time="'+userData.time+'">few seconds ago</span>';
		x = x+'// <b>Rank</b>: </div>';
		x = x+'<div class="cb-rankholder" style="background: url(css/img/cbox/ranks/'+current+'.png) no-repeat;" title="'+userData.points+' Chat Points"></div>';
		x = x+'<div class="clear"></div>';
		x = x+'</div>';
		x = x+'<div class="clear"></div>';
		x = x+'</div>';
		x = x+'<div class="clear"></div>';
		x = x+'<div class="cb-message-box">'+cleanChat+'</div>';
		x = x+'</td>';
		x = x+'</tr>';
		x = x+'</table>';
		x = x+'</div>';
		x = x+'</div>';
break;

case 'global':
	var x = '<div style="width: auto; height: auto; overflow: hidden; margin-bottom: 3px;">';
		x = x+'<div class="msg-'+userData.msgid+'" style="display: block;">';
		x = x+'<table style="width: 98%; margin-left: 2px;">';
		x = x+'<tr><td>';
		x = x+'<div class="cb-global"><div class="cb-global-type">ANNOUNCEMENT</div></div>';
		x = x+'<div class="cb-global-box">'+userData.msg+'</div>';
		x = x+'</td></tr>';
		x = x+'</table>';
		x = x+'</div></div>';	
break;

case 'thanks':
	var x = '<div style="width: auto; height: auto; overflow: hidden; margin-bottom: 3px;">';
		x = x+'<div class="msg-'+userData.msgid+'" style="display: block;">';
		x = x+'<table style="width: 98%; margin-left: 2px;">';
		x = x+'<tr><td>';
		x = x+'<div class="cb-global"><div class="cb-global-type">ADVERTISEMENT</div></div>';
		x = x+'<div class="cb-global-box">'+userData.msg+'</div>';
		x = x+'</td></tr>';
		x = x+'</table>';
		x = x+'</div></div>';	
break;

case 'warn':
	var x = '<div style="width: auto; height: auto; overflow: hidden; margin-bottom: 3px;">';
		x = x+'<div class="msg-'+userData.msgid+'" style="display: block;">';
		x = x+'<table style="width: 98%; margin-left: 2px;">';
		x = x+'<tr><td>';
		x = x+'<div class="cb-global"><div class="cb-global-type">WARNING</div></div>';
		x = x+'<div class="cb-global-box">'+userData.msg+'</div>';
		x = x+'</td></tr>';
		x = x+'</table>';
		x = x+'</div></div>';	
break;

case 'ban':
	var x = '<div style="width: auto; height: auto; overflow: hidden; margin-bottom: 3px;">';
		x = x+'<div class="msg-'+userData.msgid+'" style="display: block;">';
		x = x+'<table style="width: 98%; margin-left: 2px;">';
		x = x+'<tr><td>';
		x = x+'<div class="cb-global"><div class="cb-global-type">BANNED</div></div>';
		x = x+'<div class="cb-global-box">'+userData.msg+'</div>';
		x = x+'</td></tr>';
		x = x+'</table>';
		x = x+'</div></div>';	
break;

		}
		
		$('div.chat-wrapper').prepend(x);
		$('.msg-'+userData.msgid).hide().css({ opacity: 0, marginLeft: "200px"});
		$('.msg-'+userData.msgid).show().animate({ opacity: 1, marginLeft: "0px"}, { duration: 'slow', easing: 'easeOutBack'});
		
	},
	
	getChats: function(getChatsFunction) {
    
    $.ajax({
        type: "GET",
        url: "function.php",
        data: { act: 'getMsg', lastid: scGFX.init.lastid },
        dataType: "json",
        success: function(data) {
            for(var i=0;i<data.msg.length;i++) {
                if(scGFX.init.doneAll) {
                    if(data.msg[i].fbid!=$('input#fbid').val()) {
                        scGFX.addChat(data.msg[i]);
                        scGFX.init.lastid = data.msg[i].msgid;
                    }
                    
                } else {
                    scGFX.addChat(data.msg[i]);
                    scGFX.init.lastid = data.msg[i].msgid;
                }
            }

            var nextRequest = 1000;

            if(data.msg.length > 0) {
                scGFX.init.activity = 0;
            } else {
                scGFX.init.activity++;
            }

            if(scGFX.init.activity > 3) {
                nextRequest = 5000;
            }

            if(scGFX.init.activity > 10) {
                nextRequest = 10000;
            }

            if(scGFX.init.activity > 20) {
                nextRequest = 15000;
            }

            scGFX.init.doneAll = 1;

            setTimeout(getChatsFunction, nextRequest);
        }
    });

},
	addReply: function(uid,un) {
	
		$('#formComposer').append('<input type="hidden" id="replyTo" value="'+uid+'">');
		$('#hello').val($('#hello').val() + 'To '+un+' » ');
		$("input.composer-text").focus();

	},

	smileys: function(msg) {
		var smileys = {
    		'(y)' : '1.gif',
			':p' : '2.gif',
			'*clap*' : '3.gif',
			'*peace*' : '4.gif',
			'*angel*' : '5.gif',
			'*bleh*' : '6.gif',
			'*dance*' : '7.gif',
			':)' : '8.gif',
			':((' : '9.gif',
			'*inlove*' : '10.gif',
			'*laway*' : '11.gif',
			'*shh*' : '12.gif',
			'<3' : '13.gif',
			'*wawa*' : '14.gif',
			'*ninja*' : '15.gif',
			':(' : '16.gif',
			'*green*' : '17.gif',
			'*hearts*' : '18.gif',
			'*kiss*' : '19.gif',
			'*slap*' : '20.gif',
			'*daldal*' : '21.gif',
			':D' : '22.gif',
			'*mwua*' : '23.gif',
			'*kyut*' : '24.gif',
			'*sexy*' : '25.gif',
			'*rockstar*' : '26.gif',
			'*baby*' : '27.gif',
			'*girldancing*' : '28.gif',
			'*sablay*' : '29.gif',
			'*peace2*' : '30.gif',
			'*nganga*' : '31.gif',
			'*wb*' : '32.gif',
			'*hi*' : '33.gif',
			'*number1*' : '34.gif',
			'*reading*' : '35.gif',
			'*bye*' : '36.gif',
			'*lalala*' : '37.gif',
			'*wiggle*' : '38.gif',
			'*tawa*' : '39.gif',
			'*hampas*' : '40.gif',
			'*iyak*' : '41.gif',
			'*palo*' : '42.gif',
			'*gangnam*' : '43.gif',
            '*yosi*' : '44.gif',
            '*bulong*' : '45.gif',
            '*lipad*' : '46.gif',
            '*kulangot*' : '47.gif',
            '*inlove2*' : '48.gif',
            '*search*' : '49.gif',
            '*kaen*' : '50.gif',
            '*loveu*' : '51.gif',
            '*hanap*' : '52.gif',
            '*ligo*' : '53.gif',
            '*ookk*' : '54.gif',
            '*init*' : '55.gif',
            '*alone2*' : '56.gif',
            '*imdead*' : '57.gif',
            '*galit2*' : '58.gif',
            '*hbd*' : '59.gif',
            '*bgkiss*' : '60.gif',
            '*night*' : '61.gif',
            '*ohyeah*' : '62.gif',
            '*rnr*' : '63.gif',
            '*pig*' : '64.gif',
            '*sakit*' : '65.gif',
            '*cold*' : '66.gif',
            '*smile3*' : '67.gif',
            '*dance3*' : '68.gif',
            '*dance4*' : '69.gif',
            '*dance5*' : '70.gif',
            '*shy3*' : '71.gif',
            ':72' : '72.gif',
            ':73' : '73.gif',
            ':74' : '74.gif',
            ':75' : '75.gif',
            ':76' : '76.gif',
            ':77' : '77.gif',
            ':78' : '78.gif',
            ':79' : '79.gif',
            ':80' : '80.gif',
            ':81' : '81.gif',
            ':82' : '82.gif',
            ':83' : '83.gif',
            ':84' : '84.png',
            ':85' : '85.png',
            ':86' : '86.png',
            ':87' : '87.png',
            ':88' : '88.png',
            ':89' : '89.png',
            ':90' : '90.png',
            ':91' : '91.png',
            ':92' : '92.png',
            ':93' : '93.png',
            ':94' : '94.png',
            ':95' : '95.png',
            ':96' : '96.png',
            ':97' : '97.png',
            ':98' : '98.png'
		};

		for (var prop in smileys) {
			for(var x=0;x<=msg.length;x++) {
			  msg = msg.replace(prop,'<img src="css/img/cbox/smileys/'+smileys[prop]+'" class="smlys">');
			}
		}
		
		return msg;
		
	},
	
	liveTime: function(selfTimeout) {
	
		$('.cb-time').each(function() {
		
			var msgTime = $(this).attr('data-unix-time');
			
			var time = Math.round(new Date().getTime() / 1000) - msgTime;

			var day = Math.round(time / (60 * 60 * 24));
			var week = Math.round(day / 7);
			var remainderHour = time % (60 * 60 * 24);
			var hour = Math.round(remainderHour / (60 * 60));
			var remainderMinute = remainderHour % (60 * 60);
			var minute = Math.round(remainderMinute / 60);
			var second = remainderMinute % 60;
			
			var currentTime = new Date(msgTime*1000);
			var currentHours = ( currentTime.getHours() > 12 ) ? currentTime.getHours() - 12 : currentTime.getHours();
			var currentHours = ( currentHours == 0 ) ? 12 : currentHours;
			var realTime = currentHours+':'+currentTime.getMinutes();
			var timeOfDay = ( currentTime.getHours() < 12 ) ? "AM" : "PM";

			if(day > 7) {
				var timeAgo = currentTime.toLocaleDateString();
			} else if(day>=2 && day<=7) {
				var timeAgo =  day+' days ago';
			} else if(day==1) {
				var timeAgo =  'Yesterday '+realTime+' '+timeOfDay;
			} else if(hour>1) {
				var timeAgo =  hour+' hours ago';
			} else if(hour==1) {
				var timeAgo =  'about an hour ago';
			} else if(minute==1) {
				var timeAgo =  'about a minute ago';
			} else if(minute>1) {
				var timeAgo =  minute+' minutes ago';
			} else if(second>1) {
				var timeAgo =  second+' seconds ago';
			} else {
				var timeAgo =  'few seconds ago';
			}
			
			$(this).html(timeAgo);
		
		});
		
		setTimeout(selfTimeout,5000);
		
	},
	
	error: function(txt) {
	
		$('#error').html(txt).stop(true, true).fadeIn(200).delay(3000).fadeOut(1000);
		return false;
		
	}

}

function BanUser(fbid,fbname) {
	var ban = confirm('Are you sure you want to banned '+fbname);
	if(ban) {
		$.ajax({
			type: "POST",
			url: "function.php?act=banUser",
			data: "fbid="+fbid+"&sesid="+$('input#sesid').val(),
			dataType: "json",
			success: function(data){
				if(data.status==1) {
					alert(fbname+' has been succesfully banned!');
					$('span#'+fbname).each(function() { $(this).hide(); });
				} else {
					alert(data.text);
				}
			}
		});
	} else {
		return false;
	}
}

function WarnUser(fbid,fbname) {
	var reason = prompt("You are giving "+fbname+" a warning because?");
	if (reason!=null && reason!="") {
		$.ajax({
				type: "POST",
				url: "function.php?act=WarnUser",
				data: "fbid="+fbid+"&sesid="+$('input#sesid').val()+"&reason="+reason,
				dataType: "json",
				success: function(data){
					if(data.status==1) {
						alert(fbname+' has been warned! Thank you.');
						$('span#'+fbname).each(function() { $(this).hide(); });
					} else {
						alert(data.text);
					}
				}
		});
	} else {
		return false;
	}
}