<?php

class Supplier extends CI_Controller{
	public function __construct(){
		parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}
    }
	
	public function add_supplier(){

     $data['title'] = 'Add Supplier';
     $data['menu'] = 'Supplier';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_supplier', $data);
        $this->load->view('footer');

	}
  
    public function supplier_list(){
	$this->load->library('pagination');
	$this->load->model('supplier_model');
	$limit = 10;
	$config["base_url"] = base_url() . "supplier/supplier_list";
	$config["total_rows"] = $this->supplier_model->record_count('suppliers');
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
	$data["suppliers"] = $this->supplier_model->fetchSuppliers($limit,$start);
	$data["links"] = $this->pagination->create_links();
        $data['title'] = 'Suppler List';
	$data['menu'] = 'Supplier';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('supplier_list', $data);
        $this->load->view('footer');

	}
 
  


    public function insert_supplier(){

       $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'Supplier Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('org_name', 'Organization Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->add_supplier();
        }
        else{
             $this->load->model('supplier_model');
             if($this->supplier_model->insert_supplier()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

             }
             else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Inserted Error";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

             }

        }

    }

    public function edit_supplier($id=""){

        $this->load->model('supplier_model');
        $data['supplier']=$this->supplier_model->grab_supplier($id);
        $data['title'] ='Edit Supplier'; 
        $data['menu'] = 'Supplier'; 
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_supplier', $data);
        $this->load->view('footer');

    }


    public function update_supplier(){
       
       $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'Supplier Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('org_name', 'Organization Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->edit_supplier($this->input->post('id'));
        }
        else{

             $this->load->model('supplier_model');
             if($this->supplier_model->update_supplier()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

             }
             else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Update Error";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

             }


        }


    }

    public function delete_supplier($id=""){
     
            $this->load->model('supplier_model');
          if($this->supplier_model->delete_supplier($id)){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Deleted";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

           }
           else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Delete Error";
                 $this->session->set_userdata($data);
                 redirect('supplier/supplier_list');

           }
	}
        public function add_payment($id){
		$this->load->model('supplier_model');
		$data['getSupplier'] = $this->supplier_model->getSupplier($id);
		$data['title'] = "Add Payment";
		$data['menu'] = 'Supplier';
		$this->load->view('header',$data);
		$this->load->view('menu');
		$this->load->view('add_payment');
		$this->load->view('footer');
	}
    
	public function submit_payment(){
		$id = $this->input->post('supplier_id');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('total_due','Total Due','required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('payment_amount','Payment Amount','required|trim|xss_clean|is_natural_no_zero');
		$this->form_validation->set_rules('remarks','Remarks','required|trim|xss_clean|min_length[5]|max_length[100]|');
		$this->form_validation->set_rules('date','Date','required|trim|xss_clean');
		if($this->form_validation->run()==false){
			$this->add_payment($id);
		}
		else{
			$supplier_id = $this->input->post('supplier_id');
			$paid_amount = $this->input->post('payment_amount');
			$data = array(
				'supplier_id' => $supplier_id,
				'paid_amount' =>  $paid_amount,
				'remarks' => $this->input->post('remarks'),
				'date' => $this->input->post('date')
			);
			$data2 = array(
				'type' => $this->input->post('supplier_type'),
				'amount' =>  (0-$paid_amount),
				'date' => $this->input->post('date')
			);
			$this->load->model('supplier_model');
                if($this->supplier_model->addPayment($data,$data2,$supplier_id,$paid_amount)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('supplier/supplier_list/added');
                }
                else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
                   redirect('supplier/supplier_list/failed');  
                }
           } 
        }
	
	public function supplier_payment_list(){
		$this->load->library('pagination');
		$this->load->model('supplier_model');
		$limit = 10;
		$config["base_url"] = base_url() . "supplier/supplier_payment_list";
		$config["total_rows"] = $this->supplier_model->record_count('tms_payment_details');
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
		$data["suppliers_payment"] = $this->supplier_model->fetchSupplierPayments($limit,$start);
		$data["links"] = $this->pagination->create_links();
		$data['title'] ='Supplier Payment List'; 
		$data['menu'] = 'Supplier'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('supplier_payment_list', $data);
		$this->load->view('footer');
	}
	
	public function supplier_payment_search(){
		$s = $this->input->get('start_date');
		$e = $this->input->get('end_date');
		$this->load->library('pagination');
		$this->load->model('supplier_model');
		$limit = 10;
		$config["base_url"] = base_url() . "supplier/supplier_payment_list";
		$config["total_rows"] = $this->supplier_model->record_count('tms_payment_details');
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
		$data["suppliers_payment"] = $this->supplier_model->SearchSupplierPayments($limit,$start,$s,$e);
		$data['title'] ='Search Result of Supplier Payment List From :'.$s.' To: '.$e; 
		$data['menu'] = 'Supplier'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('supplier_payment_list', $data);
		$this->load->view('footer');
	}
	
	public function view_supplier_payment($id){
		$this->load->library('pagination');
		$this->load->model('supplier_model');
		$limit = 10;
		$config["base_url"] = base_url() . "supplier/view_supplier_payment/".$id;
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
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["supplier_payments"] = $this->supplier_model->getSupplierPayments($limit,$start,$id);
		$data["links"] = $this->pagination->create_links();
		$data['title'] ='Supplier Payments'; 
		$data['menu'] = 'Supplier'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('view_supplier_payment', $data);
		$this->load->view('footer');
	}
	
	public function view_supplier_payments(){
		$s = $this->input->get('start_date');
		$e = $this->input->get('end_date');
		$id = $this->input->get('id');
		$this->load->library('pagination');
		$this->load->model('supplier_model');
		$limit = 10;
		$config["base_url"] = base_url() . "supplier/view_supplier_payments/".$id;
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
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["supplier_payments"] = $this->supplier_model->getSupplierPaymentsDate($limit,$start,$s,$e,$id);
		$data["links"] = $this->pagination->create_links();
		$data['title'] ='Search Result for Supplier Payment List From :'.$s.' To: '.$e; 
		$data['menu'] = 'Supplier'; 
		$this->load->view('header', $data);
		$this->load->view('menu');
		$this->load->view('view_supplier_payment', $data);
		$this->load->view('footer');
	}
	
	public function delete_payment($id){
            $this->load->model('supplier_model');
	    $payment = $this->supplier_model->getPayment($id);
	    //echo $payment['paid_amount'];exit;
	    $paid = $this->supplier_model->getPaid($payment['supplier_id']);
	  	    
	    if($this->supplier_model->delete_payment($id)){
		$data = array(
			'type'=>$payment['supplier_id'],
			'amount'=>$payment['paid_amount'],
			'date'=>date('Y-m-d')
		);
		if($this->supplier_model->addPaymentMainAccount($data)){
			$rest = $paid-$payment['paid_amount'];
			if($this->supplier_model->updateDue($payment['supplier_id'],$paid-$payment['paid_amount'],$rest)){
				$notifications = array(
					'sign' => 'alert alert-success',
					'msg' => 'Deleted'
				);
				$this->session->set_flashdata($notifications);
				redirect('supplier/supplier_list');		
			}
			else{
				$notifications = array(
					'sign' => 'alert alert-danger',
					'msg' => 'Failed'
				);
				$this->session->set_flashdata($notifications);
				redirect('supplier/supplier_list');
			}
		}
		else{
			redirect('supplier/supplier_list');
		}
           }
           else{
		redirect('supplier/supplier_list');
           }
	}
	public function view_memo($id){
		$this->load->model('supplier_model');
		$res = $this->supplier_model->getSupplierPayment($id);
		$data["supplier_payment"] = $res;
		//echo $res['supplier_id'];exit;
		$data['supplier'] = $this->supplier_model->getSupplier($res['supplier_id']);
		$data['title'] = "Payment Invoice";
		$data['menu'] = 'Supplier';
		$this->load->view('header',$data);
		$this->load->view('menu');
		$this->load->view('view_memo');
		$this->load->view('footer');
	}

}
