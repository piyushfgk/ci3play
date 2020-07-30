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
		
		/** Load Models */
		$this->load->model('PostModel', 'PM');
		$this->load->model('UserModel', 'UM');
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

	public function login(){
		$data = array(
			"page"		=> (object) ["title" => 'Login'],
		);

		$this->view('login', $data);
	}

	public function do_login(){

		$this->load->library('form_validation');
        
        /** You can not use space between pipes | 
         * Rules must be adjacent to one another seperated by pipes only
         * */ 
		
		$user_list = array();

		foreach($this->UM->get() as $user){
			$user_list[] = $user->email;
		}
		
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[50]|in_list['.implode(",",$user_list).']', array(
			"min_length" => "%s must be at least 10 characters long",
			"max_length" => "%s can not be more than 100 characters",
			"in_list" => "%s is not registered with us, please <strong>Sign Up!</strong>")
		);

		$this->form_validation->set_rules('password', 'Password', 'trim|required');
 
		if ($this->form_validation->run() == FALSE)
		{
			$this->login();
		}
		else
		{
			$result = $this->UM->get($this->input->post('email'));
			
			if(password_verify($this->input->post('password'), $result->password)){
				
				$this->session->set_userdata('user_tabid', $result->user_id);
				$this->session->set_userdata('user_id', $result->email);
				$this->session->set_userdata('user_name', $result->name);

				redirect(base_url());
			}else{
				
				$this->session->set_flashdata('db_status', (object) array(
					"status"  => "danger",
					"message" => "Incorrect login credentials !",
					"icon"    => "times" ,
				));

				$this->login();
			}
		}
		 
	}

	public function registration(){
		$data = array(
			"page"		=> (object) ["title" => 'Registration'],
		);
		
		$this->view('registration', $data);
	}

	public function do_register(){

		$this->load->library('form_validation');
        
        /** You can not use space between pipes | 
         * Rules must be adjacent to one another seperated by pipes only
         * */ 
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]{2,}$/]', array(
            "min_length"   => "%s must be at least 2 characters long",
			"max_length"   => "%s can not be greater than 50 characters",
			"regex_match"	=> "%s is not valid !"
        ));
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[50]|is_unique[users.email]', array(
			"min_length" => "%s must be at least 10 characters long",
			"max_length" => "%s can not be more than 100 characters",
			"is_unique" => "%s email ID is already registered, Please login !")
		);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[10]|max_length[20]|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\'_]).{10,20}$/]', array(
			"regex_match" => "%s must contain at least one small and capital letter, number & symbol #?!@$%^&*_'"
		)
		);

		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
 
		if ($this->form_validation->run() == FALSE)
		{
			$this->registration();
		}
		else
		{
			$status = $this->UM->register();

			$this->session->set_flashdata('db_status', (object) array(
				"status"  => $status === FALSE ? "danger" : "success",
				"message" => $status === FALSE ? "Registration error" : "Registration successfull! Please login" ,
				"icon"    => $status === FALSE ? "times" : "check" ,
			));
			
			redirect(base_url('pages/login'), 'refresh');
		}
		 
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
