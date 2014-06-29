Anatomy of a bare PHP webapp integrated with fb-connect

1) Create chatigniter/application/controllers/pages.php -> this will be your controller for a static page
The first thing you're going to do is set up a controller to handle static pages. A controller is simply a class that helps delegate work. It is the glue of your web application.

<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{

	}
}

Now you've created your first method, it's time to make some basic page templates. We will be creating two "views" (page templates) that act as our page footer and header.

2) Create the header at application/views/templates/header.php and add the following code:
<html>
<head>
	<title><?php echo $title ?> - Follow the rabbit hole</title>
</head>
<body>
	<h1>NEO</h1>
	
3) Now create a footer at application/views/templates/footer.php that includes the following code:	
<strong>&copy; 2011</strong>
<script type="text/javascript">if(!NREUMQ.f){NREUMQ.f=function(){NREUMQ.push(["load",new Date().getTime()]);var e=document.createElement("script");e.type="text/javascript";e.src=(("http:"===document.location.protocol)?"http:":"https:")+"//"+"js-agent.newrelic.com/nr-100.js";document.body.appendChild(e);if(NREUMQ.a)NREUMQ.a();};NREUMQ.a=window.onload;window.onload=NREUMQ.f;};NREUMQ.push(["nrfj","beacon-5.newrelic.com","eb488e72a1","3758250","NgEEZBYHDUFWVk0KWg9LJUUXEgxfGFZWB1AIAwhZEAMRHR0=",0,101,new Date().getTime(),"","","","",""]);</script></body>
</html>
