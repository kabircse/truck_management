<?php

class Income extends CI_Controller{
	public function __construct(){
		parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}
    }
	
    public function create_income_category()
	{
      	$data['title'] = 'Create Income Category';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('create_income_category', $data);
        $this->load->view('footer');

	}
  	public function add_income()
  	{
   
        $data['title'] = 'Add Income Category';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_income', $data);
        $this->load->view('footer');

  	}

  	public function income_list()
	{
   
        $data['title'] = 'Add Income Category';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('income_list', $data);
        $this->load->view('footer');

  }
}
?>