<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}	
		$this->load->model('creation_model');
	}
	public function unit($flag = '')
	{
		$data['title'] = 'Unit';
		$data['menu'] = 'Create Unit';
		
		$data['flag'] = $flag;
		
		$data['get_creation_data'] = $this->creation_model->get_creation_data();
		
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('unit', $data);
		$this->load->view('footer');
	}
	
	public function unit_creation()
	{
		$data['title'] = 'Create Unit';	
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('unit_name', 'Unit name', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->unit();
		}
		else
		{			
			$unit_data = array(
				'unit_id' => '',
				'unit_name' => $this->input->post('unit_name')
			);
			
			if($this->creation_model->creation($unit_data))
				redirect(base_url().'creation/unit/created');
			else
				redirect(base_url().'creation/unit/failed');
		}
	}
	
	public function edit_unit()
	{
		$data['title'] = "Edit Unit";
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('unitlist', 'Unit name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('update_unit_name', 'New Unit name', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->unit();
		}
		else
		{			
			$unit_id = $this->input->post('unitlist');
			$data = array(
				'unit_name' => $this->input->post('update_unit_name')
			); 
			
			if($this->creation_model->update_creation($data, $unit_id))
				redirect(base_url().'creation/unit/updated');
			else
				redirect(base_url().'creation/unit/failed');
		}
	
	}
	
	public function delete_unit($id = '')
	{
		if($this->creation_model->delete_creation_data($id))
		{
			redirect(base_url().'creation/unit/deleted');
		}
		else
		{
			redirect(base_url().'creation/unit/failed');
		}
	}

}