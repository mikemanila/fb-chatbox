Anatomy of a bare PHP webapp integrated with fb-connect

1) Create chatigniter/application/controllers/pages.php -> this will be your controller for a static page
The first thing you're going to do is set up a controller to handle static pages. A controller is simply a class that helps delegate work. It is the glue of your web application.

<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{
        	$this->load->view('pages/'.$page); //this enables you to view the page: /index.php/pages/view/home      
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

4) Now modify the pages.php controller:
public function view($page = 'home')
{

	if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}

	$data['title'] = ucfirst($page); // Capitalize the first letter

	$this->load->view('templates/header', $data);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/footer', $data);

}

++++++++++++++
<br>
Database
4) Create application/models/news_model.php
<?php
class News_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get_news($slug = FALSE) {
	if ($slug === FALSE)
	{
		$query = $this->db->get('news');
		return $query->result_array();
	}

	$query = $this->db->get_where('news', array('slug' => $slug));
	return $query->row_array();
	}
}

5) application/controllers/news.php
<?php
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	public function index()
	{
		$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News archive';
	
		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug)
	{
		$data['news_item'] = $this->news_model->get_news($slug);
	
		if (empty($data['news_item']))
		{
			show_404();
		}
	
		$data['title'] = $data['news_item']['title'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->view('templates/footer');
	}

}

6) application/views/news/index.php
<?php foreach ($news as $news_item): ?>

    <h2><?php echo $news_item['title'] ?></h2>
    <div class="main">
        <?php echo $news_item['text'] ?>
    </div>
    <p><a href="news/<?php echo $news_item['slug'] ?>">View article</a></p>

<?php endforeach ?>

