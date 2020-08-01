<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $template = array();
    public $data = array();

    public function __construct()
    {

        parent::__construct();

    }

    /**
     * Global website layout function
     */
    protected function siteLayout()
    {

        $this->page = 'pages/' . $this->body;

        if (!file_exists(APPPATH . "views/{$this->page}" . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        // Passing true in view function will return its content
        $this->template['header'] = $this->load->view("templates/header", $this->data, TRUE);
        $this->template['body'] = $this->load->view($this->page, $this->data, TRUE);
        $this->template['footer'] = $this->load->view("templates/footer", $this->data, TRUE);

        $this->load->view('layouts/main', $this->template);

    }
}