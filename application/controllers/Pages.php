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
			"heading"	=> "Hi, Welcome to CI3 playground ! <p class='h6 bg-info text-light py-2 mt-2 text-center'>Add a new post using <a class=\"text-secondary\" href=\"".base_url('post')."\">Posts</a> menu !</p>",
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

	public function login($data = array()){

		if(empty($data)){
			$data = array(
				"page"		=> (object) ["title" => 'Login'],
				"form"		=> (object) array(
					"email" => (object) array("autofocus" => true)
				)
			);
		}
		
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
		
			if($result->status == 'R'){

				$status = "info";
				$message = "You have been registered on ".indate($result->added_on)." Hrs. Please verify your email to login !";
				$icon = "exclamation-triangle";

			}elseif($result->status == 'A' && password_verify($this->input->post('password'), $result->password)){
				
				$this->session->set_userdata('user_tabid', $result->user_id);
				$this->session->set_userdata('user_id', $result->email);
				$this->session->set_userdata('user_name', $result->name);

				redirect(base_url());
			}else{
				$status = "danger";
				$message = "Incorrect login credentials !";
				$icon = "times";
			}
				
			$this->session->set_flashdata('db_status', (object) array(
				"status"  => $status,
				"message" => $message,
				"icon"    => $icon,
			));

			$this->login(array(
				"page"		=> (object) ["title" => 'Login'],
				"form"		=> (object) array(
					"password" => (object) array("autofocus" => true)
				)
			));
			
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
				"message" => $status === FALSE ? "Registration error" : "Registration successfull! Please check your email to verify &amp; activate your login !" ,
				"icon"    => $status === FALSE ? "times" : "check" ,
			));

			if($status){
				/** Send email if registration is successfull */

				$user =  $this->UM->get($this->input->post('email'));
				$verify_link = base_url('email_verify/'.$user->token);

				$subject = 'Please verify your email - ci3play.home.in';
				$message = '
							<p>Hello, '.$user->name.'</p>
							<p>Welcome to&nbsp;<a href="http://ci3play.home.in">ci3play.home.in</a>&nbsp;, please click below button link to verify your email.</p>
							<p>&nbsp;</p>
							<p style="padding-left: 50px;"><a href="'.$verify_link.'" style="background-color: #b80c4d; border: #2e6da4; font-family: Arial, Geneva, Arial, Helvetica,  sans-serif; padding: 8px 12px; font-size: 21px; color: #fff; border-radius: 4px; text-decoration: none;">Verify Email</a></p>
							<p>&nbsp;</p>
							<p><span style="color: #666699; font-size: 10px;">If above link did not work use copy and paste below link in the browser to verify your email</span>&nbsp;<br />&nbsp;'.$verify_link.'</p>
							<p>&nbsp;</p>
							<p>Thanking You,</p>
							<p><span style="color: #808080;"><strong>Yours Truly</strong></span><br /><span style="color: #808080;"><strong>Piyush Sachan</strong></span></p>
						';
				
				$this->send($user->email, $subject, $message);
			}
			
			redirect(base_url('pages/login'), 'refresh');
		}
		 
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function email_verify($token){

		// If user already logged in then destroy current session
		if($this->session->userdata('user_id')){
			$this->session->sess_destroy();
		} 

		$result = $this->UM->check_token($token);

		if(!empty($result->token)){

			if($result->status == 'R'){
				$status = $this->UM->user_activate($result->user_id);

				if($status){
					$status = "success";
					$message = 'Email successfully verified, Please login !';
					$icon = "check";
				
				}else{
					$status = "danger";
					$message = "There is some problem verifying your email please try again later !";
					$icon = "exclamation-triangle";
				}
			}else{
				$status = "info";
				$message = "Email already verified. Please login !";
				$icon = "exclamation-triangle";
			}

			$this->session->set_flashdata('db_status', (object) array(
				"status"  => $status,
				"message" => $message,
				"icon"    => $icon,
			));

			$this->login();
			
		}else{

			$this->session->set_flashdata('db_status', (object) array(
				"status"  => 'danger',
				"message" => 'Invalid Token Error! Email verification failed, Please check your link.',
				"icon"    => 'exclamation-triangle',
			));

			$data = array(
				"page"		=> (object) ["title" => 'Email Verify'],
			);
			
			$this->view('verify_email', $data);
			
		}

	}

	protected function send($to, $subject, $message) {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
}
