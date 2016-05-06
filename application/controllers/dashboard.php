<?php

class Dashboard extends CI_Controller {

    public function __construct() 
	{
        parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
    }

    public function index() 
	{
		$data['title'] = 'Dashboard';
		$data['menu'] = 'Dashboard';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('dashboard', $data);
        $this->load->view('footer');
    }

}

?>
