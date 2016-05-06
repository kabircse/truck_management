 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Filename:truck.php
*project name:truck_management
*Date created:November 05,2014
*Created by:Kabir
*/
class Truck extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
        $this->load->model('truck_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
    }
	
    public function add_truck_type()
    {
	$data['title'] = 'Add truck type';
        $data['results'] = $this->truck_model->getTruckTypes();
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_truck_type');
        $this->load->view('footer');
    }
    public function submit_truck_type()
    {
        $this->form_validation->set_rules('truck_type','Truck Type','required|trim|xss_clean|is_unique[tms_truck_types.type_name]');
        if($this->form_validation->run()==false){
            $this->add_truck_type();
        }
        else{
            $data = array(
                'type_name'=>$this->input->post('truck_type')
            );
            if($this->truck_model->addTruckType($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/add_truck_type/added');
            }
            else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/add_truck_type/failed');   
            }
        }
    }
    public function update_truck_type()
    {
        $this->form_validation->set_rules('new_name','Type name','required|trim|xss_clean|is_unique[tms_truck_types.type_name]');
        if($this->form_validation->run()==false){
            $this->add_truck_type();
        }
	else{
	    $id = $this->input->post('truck_type2');
	    $new_name = $this->input->post('new_name');
	    if($this->truck_model->update_truck_type($id,$new_name)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/add_truck_type/updated');
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/add_truck_type/failed');
	    }
	}
    }
    public function delete_truck_type($id='')
    {
        if($id>0){
	    if($this->truck_model->delete_truck_type($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/add_truck_type/deleted');   
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/add_truck_type/failed');
	    }
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	    redirect('truck/add_truck_type/failed');
	}
    }
    public function add_truck()
    {
      $data['title'] = 'Add truck';
	$data['results'] = $this->truck_model->getTruckTypes();
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_truck');
        $this->load->view('footer');
    }
    
    public function submit_truck(){
	$this->form_validation->set_rules('truck_type','Truck Type','required|trim|is_natural_no_zero');
	$this->form_validation->set_rules('truck_number','Truck Number','required|trim|xss_clean|is_uniqu[tms_truck_info.truck_number]');
	$this->form_validation->set_rules('engine_number','Engine Number','required|trim|xss_clean|is_uniqe[tms_truck_info.engine_number]');
	$this->form_validation->set_rules('chesis_number','Chesis Number','required|trim|xss_clean|is_unique[tms_truck_info.chesis_number]');
        if($this->form_validation->run()==false){
            $this->add_truck();
        }
        else{
            $data = array(
                'truck_type_id'=>$this->input->post('truck_type'),
		'truck_number'=>$this->input->post('truck_number'),
		'engine_number'=>$this->input->post('engine_number'),
		'chesis_number'=>$this->input->post('chesis_number')
            );
            if($this->truck_model->addTruck($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/truck_list/added');
            }
            else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/add_truck/failed');   
            }
        }
    }

    public function truck_list()
    {
	$limit = 10;
	$config["base_url"] = base_url() . "truck/truck_list";
	$config["total_rows"] = $this->truck_model->record_count('tms_truck_info');
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
	$data['truck_list'] = $this->truck_model->fetchTrucks($limit,$start);
	$data['title'] = 'Truck List';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('truck_list');
        $this->load->view('footer');
    }
    public function edit_truck($id=''){
	if($id>0){
	    $data['results'] = $this->truck_model->getTruckTypes();
	    $data['truck'] = $this->truck_model->getTruck($id);
	    $data['title'] = 'Edit truck';
	    $this->load->view('header', $data);
	    $this->load->view('menu');
	    $this->load->view('edit_truck');
	    $this->load->view('footer');
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	    redirect('truck/truck_list/failed');
	}
    }
    public function update_truck($id=''){
	if($id>0){
	    $this->form_validation->set_rules('truck_type','Truck Type','required|trim|is_natural_no_zero');
	    $this->form_validation->set_rules('truck_number','Truck Number','required|trim|xss_clean');
	    $this->form_validation->set_rules('engine_number','Engine Number','required|trimxss_clean');
	    $this->form_validation->set_rules('chesis_number','Chesis Number','required|trim|xss_clean');
	    if($this->form_validation->run()==false){
	        $this->truck_list();
	    }
	    else{
	        $data = array(
	            'truck_type_id'=>$this->input->post('truck_type'),
			'truck_number'=>$this->input->post('truck_number'),
	        	'engine_number'=>$this->input->post('engine_number'),
	        	'chesis_number'=>$this->input->post('chesis_number')
	        );
	        if($this->truck_model->updateTruck($data,$id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
	            redirect('truck/truck_list/updated');
	        }
	        else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	            redirect('truck/truck_list/failed');   
	        }
	    }
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	    redirect('truck/truck_list/failed');
	}
    }
    public function delete_truck($id='')
    {
        if($id>0){
	    if($this->truck_model->delete_truck($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/truck_list/deleted');   
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('truck/truck_list/failed');
	    }
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	    redirect('truck/truck_list/failed');
	}
    }
    public function add_payment(){
	$data['title'] = 'Add Payment';
	$data['results'] = $this->truck_model->getTruckTypes();
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('add_payment');
        $this->load->view('footer');
    }
    
    public function submit_payment(){
	$this->form_validation->set_rules('truck_type','Truck Type','required|trim|is_natural_no_zero');
	$this->form_validation->set_rules('truck_number','Truck Number','required|trim|xss_clean|is_uniqu[tms_truck_info.truck_number]');
	$this->form_validation->set_rules('engine_number','Engine Number','required|trim|xss_clean|is_uniqe[tms_truck_info.engine_number]');
	$this->form_validation->set_rules('chesis_number','Chesis Number','required|trim|xss_clean|is_unique[tms_truck_info.chesis_number]');
        if($this->form_validation->run()==false){
            $this->add_truck();
        }
        else{
            $data = array(
                'truck_type_id'=>$this->input->post('truck_type'),
		'truck_number'=>$this->input->post('truck_number'),
		'engine_number'=>$this->input->post('engine_number'),
		'chesis_number'=>$this->input->post('chesis_number')
            );
            if($this->truck_model->addTruck($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/truck_list/added');
            }
            else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
                redirect('truck/add_truck/failed');   
            }
        }
    }
    public function fuel_report($truck_id){
	$data['menu'] = 'Supplier'; 
	$limit = 10;
	$config["base_url"] = base_url() . "truck/fuel_report";
	$config["total_rows"] = $this->truck_model->record_count('tms_fuel');
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
	$start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	$data['fuel_list'] = $this->truck_model->fetchTruckFuel($limit,$start,$truck_id);
	$data['i'] = $start+1;
	$data['truck'] = $this->truck_model->getTruckById($truck_id);
	$data['title'] = 'Fuel List';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('fuel_list');
        $this->load->view('footer');
    }

}
/* End of file truck.php */
/* Location: ./application/controller/truck.php */ 