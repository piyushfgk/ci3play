<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
	} 

	public function index()
	{
		$data = array(
			"page"		=> (object) ["title" => 'Home'],
			"heading"	=> "Hi, Welcome to CI3 playground !"
		);

		$this->view('home', $data);
	}

	public function view($page = 'home', $data = array()){

		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	public function post($post_number = NULL){
		
		$posts[] = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, explicabo iure.";
		$posts[] = "adipisci dolorem esse maiores! Autem, eligendi corrupti commodi veritatis odit ipsa nobis dolorum";
		$posts[] = "Vel velit, vero doloribus voluptatem aspernatur cumque necessitatibus.";
		$posts[] = "Quod laboriosam maiores omnis consequuntur eos, accusantium, atque ea temporibus tenetur";
		$posts[] = "dolore sint nostrum maxime optio recusandae, voluptatum mollitia";
		$posts[] = "Repudiandae aliquid est voluptatem voluptatibus blanditiis";

		if($post_number > (count($posts) - 1) || empty($post_number) ) $post_number = 0;

		$data = array(
			"page"		=> (object) ["title" => 'Posts'],
			"heading"	=> "Your posts will show here !",
			"post"		=> "This is post number {$posts[$post_number]}"
		);

		$this->view('home', $data);
	}	
}
