<?php 
class Work_order extends CI_Controller{
	public function __construct(){
		parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}
    }

       public function add_work_order(){
        
		$data['title'] = 'Add Work Order'; 
        $data['menu'] = 'Work Order'; 
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_work_order', $data);
        $this->load->view('footer');
    
       }

       public function work_order_list(){
        
		$this->load->model('work_order_model');	  
        $this->load->library('pagination');
        
        $limit =20;
        
        $config['base_url'] = base_url()."/work_order/work_order_list";
        $config['total_rows'] = $this->work_order_model->work_order_list_num(); 
        
        $config['per_page'] = $limit;
        $config['num_links'] = 10;
        $config['first_links'] = "First";
        $config['last_link'] = "Last"; 
        $config['uri_segment'] = 3;
        $config['anchor_class'] = 'class="number"';
        
        $this->pagination->initialize($config);
        
            if($this->uri->segment(3) > 0){ 
            
                $offset = $this->uri->segment(3);   
            }
            else{
                
                $offset = 0;
            }

	
		$data['title'] = 'Work Order List';
        $data['menu'] = 'Work Order';
		$data['offset']=$offset;
        $this->load->model('work_order_model');
        $data['work_orders']=$this->work_order_model->get_work_order($limit,$offset);
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('work_order_list');
        $this->load->view('footer');
    
       }

    public function insert_work_order()
	{

        $this->load->library('form_validation');
        $this->form_validation->set_rules('client_name', 'Client Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order Number', 'trim|required|xss_clean|is_unique[tms_work_order.order_id]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean|integer');
        $this->form_validation->set_message('integer','Quantity must be an Integer');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','Unit price must be an Numeric');
        $this->form_validation->set_rules('total_price', 'Total Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_date', 'Purchase Order Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->add_work_order();
        }
        else{
              $this->load->model('work_order_model');
             if($this->work_order_model->insert_work_order()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

             }
             else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Inserted Error";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

             }


        }


    }

    public function edit_wrok_order($id = ""){

        $this->load->model('work_order_model');
        $data['work_order']=$this->work_order_model->grab_work_order($id);
        $data['title'] = 'Add Work Order'; 
        $data['menu'] = 'Work Order'; 
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_work_order', $data);
        $this->load->view('footer');

    }


    public function update_work_order($id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('client_name', 'Client Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean|integer');
        $this->form_validation->set_message('integer','Quantity must be an Integer');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','Unit price must be an Numeric');
        $this->form_validation->set_rules('total_price', 'Total Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_date', 'Purchase Order Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->edit_work_order($id);
        }
        else{ 

             $this->load->model('work_order_model');
             if($this->work_order_model->update_work_order()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

             }
             else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Update Error";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

             }


        }


    }
   

    public function delete_work_order($id){

          $this->load->model('work_order_model');
          if($this->work_order_model->delete_work_order($id)){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Deleted";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

           }
           else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Delete Error";
                 $this->session->set_userdata($data);
                 redirect('work_order/work_order_list');

           }

    }

    
    public function view_trips($id="",$table=""){
      
       $this->load->model('work_order_model');
       $data['trips']=$this->work_order_model->fetch_trips($id,$table);
       $data['title'] = 'Trip List'; 
       $data['menu'] = 'Work Order';
       //print_r($data['trips']); exit();
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('wo_trip_list', $data);
        $this->load->view('footer');

    }
    
     
     public function payment($id){
       $this->load->model('work_order_model');
       $data['payments']= $this->work_order_model->fetch_payment_info($id);
       $data['work_order']= $this->work_order_model->work_order($id);
       $data['title'] = 'Trip List'; 
       $data['menu'] = 'Work Order';
       //print_r($data['trips']); exit();
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('payment', $data);
        $this->load->view('footer');

     }
     
     public function insert_payment(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('work_order', 'Work Order', 'trim|required|xss_clean');
      $this->form_validation->set_rules('paid', 'Total Paid', 'trim|xss_clean');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric');
      $this->form_validation->set_message('numeric','Must be Numeric');
      if($this->form_validation->run() == false){
       
        $this->payment($this->input->post('work_order'));
      }
      else{
          $this->load->model('work_order_model');
	  $q=$this->work_order_model->insert_payment();
	  if($q){
	     $data['type']="alert alert-success";
             $data['msg']="Inserted Deleted";
             $this->session->set_userdata($data);
             redirect('work_order/work_order_list');
	  }
	  else{
	      $data['type']="alert alert-danger";
              $data['msg']="Insert Error";
              $this->session->set_userdata($data);
              redirect('work_order/work_order_list');
	  }
       
      }
     }
     
     public function payment_list($id){
       
       $this->load->model('work_order_model');
       $data['title'] = 'Trip List'; 
       $data['menu'] = 'Work Order';
       $data['payments']=$this->work_order_model->payment_list($id);
        
	$this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('payment_list');
        $this->load->view('footer');
       
       
     }
     
     public function edit_payment($id){
        $this->load->model('work_order_model');
       $data['payment']= $this->work_order_model->edit_payment_info($id);
      
       $data['title'] = 'Trip List'; 
       $data['menu'] = 'Work Order';
       //print_r($data['trips']); exit();
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_payment', $data);
        $this->load->view('footer');
       
       
       
     }
     
     public function update_payment(){
       $this->load->model('work_order_model');
       $change=$this->input->post('new_amount') - $this->input->post('pre_amount');
       $data=array(
		   'paid_amount' => $this->input->post('new_amount') 
		   );
       $q= $this->work_order_model->update_payment($change,$data,$this->input->post('id'));
      if($q){
	     $data['type']="alert alert-success";
             $data['msg']="Update Successfully";
             $this->session->set_userdata($data);
             redirect('work_order/work_order_list');
	  }
	  else{
	      $data['type']="alert alert-danger";
              $data['msg']="Update Failed";
              $this->session->set_userdata($data);
              redirect('work_order/work_order_list');
	  }
       
       
     }
     
     public function delete_payment($id=""){
       $this->load->model('work_order_model');
       $q=$this->work_order_model->delete_payment($id);
       if($q){
	     $data['type']="alert alert-success";
             $data['msg']="Successfully Deleted";
             $this->session->set_userdata($data);
             redirect('work_order/work_order_list');
	  }
	  else{
	      $data['type']="alert alert-danger";
              $data['msg']="Insert Error";
              $this->session->set_userdata($data);
              redirect('work_order/work_order_list');
	  }
       
       
     }


}
?>