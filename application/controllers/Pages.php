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

		$this->load->helper('url');
		/** Load Model */
		$this->load->model('PostModel', 'PM');
	} 

	public function index()
	{
		$data = array(
			"page"		=> (object) ["title" => 'Home'],
			"heading"	=> "Hi, Welcome to CI3 playground ! <p class='h6 mt-2 text-center'>All your new posts will show here !</p>",
			"posts"		=> $this->PM->get()
		);

		if(!$this->session->userdata('user_id')){
			redirect(base_url('pages/login'), 'refresh');
		}else{
			$this->view('home', $data);
		}
		
	}

	protected function view($page = 'home', $data = array()){

		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	public function delete($id){

		$this->PM->delete($id);

		$this->post();
	}	

	public function login(){
		$data = array(
			"page"		=> (object) ["title" => 'Login'],
		);
		
		$this->view('login', $data);
	}

	public function registration(){
		$data = array(
			"page"		=> (object) ["title" => 'Registration'],
		);
		
		$this->view('registration', $data);
	}
}
