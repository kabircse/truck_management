<?php

class settings extends CI_Controller{
    public function __construct(){
      parent:: __construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
      $this->load->library('form_validation');
      $this->load->library('pagination');
      $this->load->model('settings_model');
    }
    
    public function create_user(){
	$data['title'] = 'Create User';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('create_user');
        $this->load->view('footer');
    }
    
    public function submit_user(){
	    $this->form_validation->set_rules('name','Name','required|trim|xss_clean');
	    $this->form_validation->set_rules('user_name','user Name','required|trim|xss_clean|alpha_dash');
	    $this->form_validation->set_rules('email','Email','required|trim|xss_clean|max_length[30]|valid_email');
	    $this->form_validation->set_rules('password','Password','required|trim|xss_clean|min_length[5]|max_length[20]');
	    $this->form_validation->set_rules('cnf_password','Confirm Password','required|trim|xss_clean|matches[password]');
	    $this->form_validation->set_rules('user_type','User Type','required|trim|xss_clean');
	    if($this->form_validation->run()==false){
		$this->create_user();
	    }
	    else{
		$data = array(
		    'name'=>$this->input->post('name'),
		    'user_name'=>$this->input->post('user_name'),
		    'email'=>$this->input->post('email'),
		    'password'=>md5($this->input->post('password')),
		    'user_type'=>$this->input->post('user_type'),
		    'date'=>date('Y-m-d'),
		    'is_active'=> '1'
		);
		if($this->settings_model->addUser($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/added');
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/failed');   
		}
	    }
	}
  
	public function user_list()
	{
  	        $limit = 20;
		$config["base_url"] = base_url() . "settings/user_list";
		$config["total_rows"] = $this->settings_model->record_count('tms_user');
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
		$data["users"] = $this->settings_model->fetchUsers($limit,$start);
		$data["links"] = $this->pagination->create_links();
		$data['title'] = 'User List';
	        $this->load->view('header', $data);
	        $this->load->view('menu');
	        $this->load->view('user_list', $data);
	        $this->load->view('footer');	
	}
	
	public function edit_user($id)
	{
		$data['user'] = $this->settings_model->getUser($id);
		$data['title'] = 'Edit User';
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('edit_user');
		$this->load->view('footer');
	}
	
	public function update_user(){
	    $id = $this->input->post('id');
	    $this->form_validation->set_rules('name','Name','required|trim|xss_clean');
	    $this->form_validation->set_rules('user_name','user Name','required|trim|xss_clean|alpha_dash');
	    $this->form_validation->set_rules('email','Email','required|trim|xss_clean|max_length[30]');
	    $this->form_validation->set_rules('password','Password','required|trim|xss_clean|min_length[5]|max_length[20]');
	    $this->form_validation->set_rules('cnf_password','Confirm Password','required|trim|xss_clean|matches[password]');
	    $this->form_validation->set_rules('user_type','User Type','required|trim|xss_clean');
	    if($this->form_validation->run()==false){
		$this->edit_user($id);
	    }
	    else{
		$data = array(
		    'name'=>$this->input->post('name'),
		    'user_name'=>$this->input->post('user_name'),
		    'email'=>$this->input->post('email'),
		    'password'=>md5($this->input->post('password')),
		    'user_type'=>$this->input->post('user_type')
		);
		if($this->settings_model->updateUser($id,$data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/updated');
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/failed');  
		}
	    }
	}
	
	public function delete_user($id){
		if($this->settings_model->delete_user($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/deleted');   
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/failed');
		}
	}
	
	public function activate_user($id){
		if($this->settings_model->activate_user($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Activated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/activated');   
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/failed');
		}
	}
	
	public function deactivate_user($id){
		if($this->settings_model->deactivate_user($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deactivated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/deactivated');   
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('settings/user_list/failed');
		}
	}
  }