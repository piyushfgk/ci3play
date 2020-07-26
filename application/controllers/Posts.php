<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct(){
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		/** Load Model */
        $this->load->model('PostModel', 'PM');
        
    } 

    public function index(){

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
    
    private function validate_form(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Post Title', 'required');
        $this->form_validation->set_rules('description', 'Post Description', 'required');
    }

    public function add(){

       $this->validate_form();

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
                "page"		=> (object) ["title" => 'Posts'],
                "db"        => (object) [
                    "status"  => $status === FALSE ? "danger" : "success",
                    "message" => $status === FALSE ? "Post submission error" : "New post added successfully" ,
                    "icon"    => $status === FALSE ? "times" : "check" ,

                ],
                "posts"		=> $this->PM->get()
            );
            
            $this->view('home', $data);
        }
		
    }

    public function edit($id){

        $this->validate_form();

        if ($this->form_validation->run() == FALSE)
        {
            $single_post = $this->PM->get($id);

            $data = array(
                "page"		=> (object) ["title" => 'Edit Post']
            );

            set_to_post($single_post); // Set data to post because form_validation custom array set_data not working as expected

            $this->view('posts', $data);
           
        }
        else
        {
            $status = $this->PM->update($id);

            $data = array(
                "page"		=> (object) ["title" => 'Posts'],
                "db"        => (object) [
                    "status"  => $status === FALSE ? "danger" : "success",
                    "message" => $status === FALSE ? "Post updation error" : "Post updated successfully" ,
                    "icon"    => $status === FALSE ? "times" : "check" ,

                ],
                "posts"		=> $this->PM->get()
            );
            
            $this->view('home', $data);
        }
    }

    public function delete($id){

        $this->validate_form();

        if ($this->form_validation->run() == FALSE)
        {
            $single_post = $this->PM->get($id);

            $data = array(
                "page"		=> (object) ["title" => 'Delete Post'],
                "inputs"    => (object) ["readonly" => TRUE]
            );

            set_to_post($single_post); // Set data to post because form_validation custom array set_data not working as expected

            $this->view('posts', $data);
           
        }
        else
        {
            if(isset($_POST['delete'])) $status = $this->PM->delete($id);
            if(isset($_POST['hard_delete'])) $status = $this->PM->delete($id, TRUE);
            
            $data = array(
                "page"		=> (object) ["title" => 'Posts'],
                "db"        => (object) [
                    "status"  => $status === FALSE ? "danger" : "success",
                    "message" => $status === FALSE ? "Post deletion error" : "Post deleted successfully" ,
                    "icon"    => $status === FALSE ? "times" : "check" ,

                ],
                "posts"		=> $this->PM->get()
            );
            
            $this->view('home', $data);
        }
    }

}