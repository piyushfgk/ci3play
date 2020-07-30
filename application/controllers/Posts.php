<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct(){
		parent::__construct();

        // $this->load->helper(array('form', 'url'));
        
        if(!$this->session->userdata('user_id')) redirect(base_url('pages/login'),'refresh');

		/** Load Model */
        $this->load->model('PostModel', 'PM');
        
    } 

	protected function view($page = 'posts', $data = array()){

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
        
        /** You can not use space between pipes | 
         * Rules must be adjacent to one another seperated by pipes only
         * */ 
        $this->form_validation->set_rules('title', 'Post Title', 'required|min_length[5]|max_length[100]', array(
            "min_length"   => "%s must be at least 5 characters long",
            "max_length"   => "%s can not be greater than 100 characters",
        ));
        
        $this->form_validation->set_rules('description', 'Post Description', 'required|min_length[30]', array(
            "required" => "%s can not left blank !", 
            "min_length" => "%s must be at least 30 characters long")
        );
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

            $this->session->set_flashdata('db_status', (object) array(
                "status"  => $status === FALSE ? "danger" : "success",
                "message" => $status === FALSE ? "Post submission error" : "New post added successfully" ,
                "icon"    => $status === FALSE ? "times" : "check" ,
            ));

            //$this->view('home', $data));
            redirect(base_url(), 'refresh');
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

            $this->session->set_flashdata('db_status', (object) array(
                "status"  => $status === FALSE ? "danger" : "success",
                "message" => $status === FALSE ? "Post updation error" : "Post updated successfully" ,
                "icon"    => $status === FALSE ? "times" : "check" ,
            ));
            
            // $this->view('home', $data);
            redirect(base_url(), 'refresh');
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
            if($this->input->post('action') === 'delete') $status = $this->PM->delete($id);
            if($this->input->post('action') === 'hard_delete') $status = $this->PM->delete($id, TRUE);
            
            $this->session->set_flashdata('db_status', (object) array(
                "status"  => $status === FALSE ? "danger" : "success",
                "message" => $status === FALSE ? "Post deletion error" : "Post deleted successfully" ,
                "icon"    => $status === FALSE ? "times" : "check" ,
            ));
            
            // $this->view('home', $data);
            redirect(base_url(), 'refresh');
        }
    }

}