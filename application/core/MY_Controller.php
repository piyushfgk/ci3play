<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $template = array();
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->bs4_pagination_config();
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

	protected function bs4_pagination_config()
	{
		/** Basic pagination structure by codeignitor
		 * « First  < 1 2 3 4 5 >  Last »
		*/
		// Load pagination class - Must be set in the base controller to avoid overhead
		// $this->load->library('pagination');

		// Base pagination URL - Must be set in the base controller
		// $this->paginationConfig['base_url'] = base_url('page');

		// Total number of rows - Must be set in the base controller
		// $this->paginationConfig['total_rows'] = count($this->PM->get());

		// Per page - Can be set in the base controller
		// $this->paginationConfig['per_page'] = $limit;

		// How many page links to show between current
		// $this->paginationConfig['num_links'] = 2; // CI3 default is 2

		// This must be used
		$this->paginationConfig['use_page_numbers'] = TRUE;
		// All numbered links
		$this->paginationConfig['attributes'] = array('class' => 'page-link');
		$this->paginationConfig['num_tag_open'] = '<li class="page-item">';
		$this->paginationConfig['num_tag_close'] = '</li>';

		// 'First' item element
		$this->paginationConfig['first_link'] = 'First';
		$this->paginationConfig['first_tag_open'] = '<li class="page-item">';
		$this->paginationConfig['first_tag_close'] = '</li>';

		// This should be set if default page in route not set
		$this->paginationConfig['first_url'] = base_url('page/1');

		// 'Last' item element
		$this->paginationConfig['last_link'] = 'Last';
		$this->paginationConfig['last_tag_open'] = '<li class="page-item">';
		$this->paginationConfig['last_tag_close'] = '</li>';

		// Main pagination class element
		$this->paginationConfig['full_tag_open'] = '<ul class="pagination">';
		$this->paginationConfig['full_tag_close'] = '</ul>';

		// Next link element
		$this->paginationConfig['next_link'] = '<i class="fas fa-chevron-right"></i>';
		$this->paginationConfig['next_tag_open'] = '<li class="page-item" data-toggle="tooltip" title="Next">';
		$this->paginationConfig['next_tag_close'] = '</li>';

		// Previous link element
		$this->paginationConfig['prev_link'] = '<i class="fas fa-chevron-left"></i>';
		$this->paginationConfig['prev_tag_open'] = '<li class="page-item" data-toggle="tooltip" title="Prev">';
		$this->paginationConfig['prev_tag_close'] = '</li>';

		// Current link element
		$this->paginationConfig['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
		$this->paginationConfig['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

		// Set parameters to pagination class - Must be set in the base controller
		// $this->pagination->initialize($this->paginationConfig);

		// All created links - Must be set in the base controller to use in views
		// $this->pagination->create_links();
	}
}