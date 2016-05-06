<?php
class client extends CI_Controller{
/*
*Filename:client.php
*project name:truck_management
*Date created:November 07,2014
*Created by:Kabir
*/
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
		$this->load->library('form_validation');
		$this->load->model('client_model');
		$this->load->library('pagination');
	}

	public function add_client()
	{
		$data['title'] = 'Add Client';	
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('add_client', $data);
		$this->load->view('footer');
	}
	public function submit_client()
	{
	    $this->form_validation->set_rules('client_type','Client Type','required|trim');
	    $this->form_validation->set_rules('client_name','Client Name','required|trim|xss_clean');
	    $this->form_validation->set_rules('org_name','Organization Name','required|trim|xss_clean');
	    $this->form_validation->set_rules('address','Address','required|trim|xss_clean|min_length[15]');
	    $this->form_validation->set_rules('contact_no','Contact No','required|trim|xss_clean|min_length[6]');
	    $this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email');
	    if($this->form_validation->run()==false){
		$this->add_client();
	    }
	    else{
		$data = array(
		    'client_type'=>$this->input->post('client_type'),
		    'client_name'=>$this->input->post('client_name'),
		    'organization_name'=>$this->input->post('org_name'),
		    'address'=>$this->input->post('address'),
		    'contact_no'=>$this->input->post('contact_no'),
		    'email'=>$this->input->post('email')
		);
		if($this->client_model->addClient($data)){
			$notifications = array(
				'sign' => 'alert alert-success',
				'msg' => 'Added'
			);
			$this->session->set_flashdata($notifications);
			redirect('truck/client_list/added');
		}
		else{
			$notifications = array(
				'sign' => 'alert alert-danger',
				'msg' => 'Failed'
			);
			$this->session->set_flashdata($notifications);
		    redirect('truck/add_client/failed');   
		}
	    }
	}
  
	public function client_list()
	{
		$limit = 10;
		$config["base_url"] = base_url() . "client/client_list/";
		$config["total_rows"] = $this->client_model->record_count('tms_client');
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		
		$this->pagination->initialize($config);
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['i'] = $start+1;
		$data['title'] = 'Client List';
		$data['clients'] = $this->client_model->getClients($limit,$start);
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('client_list', $data);
		$this->load->view('footer');	
	}
	
	public function edit_client($id)
	{
		$data['clients'] = $this->client_model->getClient($id);
		$data['title'] = 'Edit Client';
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('edit_client', $data);
		$this->load->view('footer');
	}
	
	public function update_client($id)
	{
		$this->form_validation->set_rules('client_type','Client Type','required|trim');
		$this->form_validation->set_rules('client_name','Client Name','required|trim|xss_clean');
		$this->form_validation->set_rules('org_name','Organization Name','required|trim|xss_clean');
		$this->form_validation->set_rules('address','Address','required|trim|xss_clean|min_length[15]');
		$this->form_validation->set_rules('contact_no','Contact No','required|trim|xss_clean|min_length[6]');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email');
		echo validation_errors();
		if($this->form_validation->run()==false){
			$this->edit_client($id);
		}
		else{
			
			$data = array(
			    'client_type'=>$this->input->post('client_type'),
			    'client_name'=>$this->input->post('client_name'),
			    'organization_name'=>$this->input->post('org_name'),
			    'address'=>$this->input->post('address'),
			    'contact_no'=>$this->input->post('contact_no'),
			    'email'=>$this->input->post('email')
			);
		        if($this->client_model->updateClient($data,$id)){
				$notifications = array(
					'sign' => 'alert alert-success',
					'msg' => 'Updated'
				);
				$this->session->set_flashdata($notifications);
				redirect('client/client_list/updated');
			}
			else{
				$notifications = array(
					'sign' => 'alert alert-danger',
					'msg' => 'Failed'
				);
				$this->session->set_flashdata($notifications);
				redirect('client/edit_client/failed');   
			}
		}
	}
	
	public function delete_client($id)
	{
		if($this->client_model->delete_client($id)){
			$notifications = array(
				'sign' => 'alert alert-success',
				'msg' => 'Deleted'
			);
			$this->session->set_flashdata($notifications);
			redirect('client/client_list/deleted');   
		}
		else{
		    	$notifications = array(
				'sign' => 'alert alert-success',
				'msg' => 'Failed'
			);
			$this->session->set_flashdata($notifications);
			redirect('client/client_list/failed');
		}
	}
}

?>