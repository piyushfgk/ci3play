<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		/** Load Model */
        $this->load->model('PostModel', 'PM');
        
    } 

    public function index(){
        $this->load->helper(array('form', 'url'));

        $data = array(
			"page"		=> (object) ["title" => 'Create Post'],
        );        

        
		$this->view('posts', $data);
    }

	public function view($page = 'posts', $data = array()){

		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
    }
    
    public function add(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Post Title', 'required');
        $this->form_validation->set_rules('description', 'Post Description', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                "page"		=> (object) ["title" => 'Create Post'],
            );

            $this->view('posts', $data);
        }
        else
        {
            $status = $this->PM->add();

            $data = array(
                "page"		=> (object) ["title" => 'Post Status'],
                "db"        => (object) [
                                            "status"  => $status === FALSE ? "danger" : "success",
                                            "message" => $status === FALSE ? "Post submission error" : "Post submitted successfully <a href='".base_url('pages/post')."' class=''>Show Posts</a>" ,
                                            "icon"    => $status === FALSE ? "times" : "check" ,

                                        ]
            );

            $this->view('posts', $data);
        }
		
    }
}