<?php
class Servicing extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}	
		$this->load->model('servicing_model');
		$this->load->model('truck_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function add_servicing_category(){
        $data['title'] = 'Add Servicing Category';
        $data['menu'] = 'Servicing';
		$data['categories'] = array();
		$results = $this->servicing_model->getCategories(0);
		foreach ($results as $result)
		{		
			$data['categories'][] = array(
				'id' => $result['id'],
				'name' => $result['name']
			);
		}
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_servicing_category', $data);
        $this->load->view('footer');

	}
	
	
	public function insert_servicing_category()
	{
		$data['title'] = "Create Category";
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('parent_category', 'parent category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('category_name', 'category name', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->add_servicing_category();
		}
		else
		{
			$project_data = array(
				'name' => $this->input->post('category_name'),
				'parent_id' => $this->input->post('parent_category')
			);
			
			if($this->servicing_model->insert_servicing_category($project_data))
				redirect('servicing/add_servicing_category/created');
			else
				redirect('servicing/add_servicing_category/failed');
		}
	}
	
	public function update_servicing_category()
	{
		$data['title'] = "Update Category";
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('project_category', 'parent category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_name', 'New Category', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->servicing_category();
		}
		else
		{
			$project_data = array(
				'name' => $this->input->post('new_name')
			);
			
			if($this->servicing_model->update_servicing_category($this->input->post('project_category'), $project_data))
				redirect('servicing/add_servicing_category/created');
			else
				redirect('servicing/add_servicing_category/failed');
		}
	}
	
	public function delete_servicing_category($id = '')
	{
		$data['title'] = 'Delete Expense';
		if($this->servicing_model->delete_servicing_category($id))
		{
			redirect('servicing/add_servicing_category/deleted');	
		}
		else
			redirect('servicing/add_servicing_category/failed');
		
	}

	public function servicing_info(){
		$data['trucks'] = $this->truck_model->getTrucks();
		$data['servicing_category'] = $this->servicing_model->getCategories(0);
		$data['title'] = 'Add Servicing Info';
		$data['menu'] = 'Servicing';		
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('servicing_info', $data);
		$this->load->view('footer');
	}
	public function submit_servicing_info()	{
		$this->form_validation->set_rules('truck_id', 'Truck No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('servicing_cat[]', 'Servicing Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('garage', 'Garage', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mechanic_cost', 'Mechanic Cost', 'trim|required|xss_clean|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE){
			$this->servicing_info();
		}
		else{
			$serv_cat = implode(',',$this->input->post('servicing_cat'));
			
			$data = array(
				'truck_id' => $this->input->post('truck_id'),
				'servicing_category_id' => $serv_cat,
				'garage' => $this->input->post('garage'),
				'mechanic_cost' => $this->input->post('mechanic_cost'),
				'date'=> date('Y-m-d')
			);
			//print_r($serv_cat);exit;
			if($this->servicing_model->insert_servicing_info($data)){
				$notifications = array(
					'sign' => 'alert alert-success',
					'msg' => 'Added'
				);
				$this->session->set_flashdata($notifications);
				redirect('servicing/servicing_list/added');
			}
			else{
				$notifications = array(
					'sign' => 'alert alert-danger',
					'msg' => 'Failed'
				);
				$this->session->set_flashdata($notifications);
				redirect('servicing/servicing_list/failed');
			}
		}
	}

	public function servicing_list(){
		$limit = 20;
		$config["base_url"] = base_url()."servicing/servicing_list";
		$config["total_rows"] = $this->servicing_model->record_count('tms_servicing_info');
		$config["per_page"] = $limit;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["servicing_info"] = $this->servicing_model->fetchServicingInfo($limit,$start);
		$data['categories'] = $this->servicing_model->getAllCategories();
		$data['trucks'] = $this->truck_model->getTrucks();
		$data["links"] = $this->pagination->create_links();
		$data['title'] = 'Servicing Info List';
		$data['menu'] = 'Servicing'; 	
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('servicing_list', $data);
		$this->load->view('footer');
	}
	
	public function add_servicing_detail($id)
	{
		$data['title'] = 'Add Servicing Details';
		$data['menu'] = 'Servicing';
		$data['truck_id'] = $id;
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('servicing_info_detail');
		$this->load->view('footer');
	}
	
	public function fetch_suppliers()
	{
		$data['results'] = $this->servicing_model->fetch_suppliers();
		$data['field'] = "organization_name";
		$q = $this->load->view('print_dropdown', $data,true);
                echo $q;	
	}
	
	public function fetch_parts()
	{
		$data['results']=$this->servicing_model->fetch_parts();
		$data['field']="products_name";
		$q=$this->load->view('print_dropdown',$data,true);
                echo $q;	
	}
	
	public function insert_servicing_detail()
	{
	  for($i=1;$i<=$this->input->post('num');$i++){
		if($this->input->post('radio'.$i)=='outer'){
		   $data = array(
			       'truck_id' => $this->input->post('truck_id'),
			       'parts_used' => '2',
			       'parts_id' => $this->input->post('parts'.$i),
			       'supplier_id' => $this->input->post('supplier'.$i),
			       'quantity' => $this->input->post('quantity'.$i),
			       'price' => $this->input->post('price'.$i),
			       'remarks' => $this->input->post('remarks'),
			       'date' => date('Y-m-d',strtotime($this->input->post('date'))),
			       );
			
		}
		else{
			$data = array(
			       'truck_id' => $this->input->post('truck_id'),
			       'parts_used' => '1',
			       'parts_id' => $this->input->post('parts'.$i),
			       'supplier_id' => '',
			       'quantity' => $this->input->post('quantity'.$i),
			       'price' => $this->input->post('price'.$i),
			       'remarks' => $this->input->post('remarks'),
			       'date' => date('Y-m-d',strtotime($this->input->post('date'))),
			       );
			
		}
		
		$batch_data[$i] = $data;
	  }
	  if($this->servicing_model->insert_servicing_detail($batch_data)){
		
                 $data['sign']="success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_flashdata($data);
                 redirect('servicing/servicing_list');
		
	  }
	  else{
		
		 $data['sign']="danger";
                 $data['msg']="Insert Failed";
                 $this->session->set_flashdata($data);
                 redirect('servicing/servicing_list');
	  }
	}
	
	public function edit_servicing_info($id)
	{
		$data['servicing_info'] = $this->load->model->getServicingInfo($id); 
		$data['title'] = 'Edit Servicing Info';
		$data['menu'] = 'Servicing'; 	
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('servicing_list');
		$this->load->view('footer');
	}
	
	public function update_servicing_info()
	{
		$this->form_validation->set_rules('project_category', 'parent category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_name', 'New Category', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->servicing_edit();
		}
		else
		{
			$data = array(
				'name' => $this->input->post('new_name')
			);
			
			if($this->servicing_model->update_servicing_info($this->input->post('project_category'), $data)){
				$notifications = array(
					'sign' => 'alert alert-success',
					'msg' => 'Updated'
				);
				$this->session->set_flashdata($notifications);
				redirect('servicing/servicing_list/updated');
			}
			else{
				$notifications = array(
					'sign' => 'alert alert-danger',
					'msg' => 'Failed'
				);
				$this->session->set_flashdata($notifications);
				redirect('servicing/servicing_list/failed');
			}
		}
	}
	
	public function delete_servicing_info($id){
		if($this->servicing_model->delete_servicing_info($id)){
			$notifications = array(
				'sign' => 'alert alert-success',
				'msg' => 'Deleted'
			);
			$this->session->set_flashdata($notifications);
			redirect('servicing/servicing_list/deleted');	
		}
		else{
			$notifications = array(
				'sign' => 'alert alert-danger',
				'msg' => 'Failed'
			);
			$this->session->set_flashdata($notifications);
			redirect('servicing/servicing_list/failed');
		}
		
	}
	
	public function servicing_hisotry($id = ""){
		
		$this->load->library('pagination');
		$limit = 10;
		$config["base_url"] = base_url() . "servicing/servicing_hisotry";
		$config["total_rows"] = $this->servicing_model->record_count_id($id,$tabl='tms_servicing_details');
		$config["per_page"] = $limit;
		$config["uri_segment"] = 4;
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
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data["results"] = $this->servicing_model->fetch_servicing_details($id,$limit,$offset);
		//print_r($data["results"]); exit;
		$data["offset"]=$offset;
		$data["truck_id"]=$id; 
		$data["links"] = $this->pagination->create_links();
		$data['title'] ='Servicing History List'; 
		$data['menu'] = 'Servicing'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('servicing_hisotry');
		$this->load->view('footer');
		
		
	}
	
	public function servicing_hisotry_with_range($id = ""){
		$s = $this->input->get('start_date');
		$e = $this->input->get('end_date');
		$id = $this->input->get('id');
		$this->load->library('pagination');
		$this->load->model('supplier_model');
		$limit = 10;
		$config["base_url"] = base_url() . "servicing/servicing_hisotry_with_range".$id;
		$config["total_rows"] = $this->supplier_model->record_count_byid($id);
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
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data["results"] = $this->servicing_model->fetch_servicing_details($id,$limit,$offset);
		$data["links"] = $this->pagination->create_links();
		$data["truck_id"]=$id; 
		$data['title'] ='Search Result for Supplier Payment List From :'.$s.' To: '.$e; 
		$data['menu'] = 'Supplier'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('view_supplier_payment', $data);
		$this->load->view('footer');
	}

}

?>