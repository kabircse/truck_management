<?php
class trip extends CI_Controller{
	public function __construct(){
		parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}
    }
	
    public function add_point() 
	{
	//echo strtotime('08/07/2013 3:10 AM'); exit;
		
        $data['title'] = 'Add Start and End point';
        $data['menu'] = 'Trip';

        $this->load->model('trip_model');
        $data['points'] = $this->trip_model->get_points();
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_point', $data);
        $this->load->view('footer');
      }


    public function insert_point(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('point_name', 'Point Name', 'trim|required|xss_clean');
		
        if($this->form_validation->run() == false){

            $this->add_point();
        }
        else{
            $this->load->model('trip_model');
            if($this->trip_model->insert_point()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');

            }
            else{

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');


            }

        }
    }


    public function edit_point($id){

         $this->load->model('trip_model');
         $data['point'] =$this->trip_model->grab_point($id);
        // print_r($data['point']); exit;

         $data['title'] = 'Edit Start and End point';
         $data['menu'] = 'Trip';
        
            $this->load->view('header', $data);
            $this->load->view('menu');
            $this->load->view('edit_point', $data);
            $this->load->view('footer');
     

    }

    public function update_point(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('point_name', 'Point Name', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->edit_point($this->input->post('id'));
        }
        else{ 

             $this->load->model('trip_model');
            if($this->trip_model->update_point()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');

            }
            else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Update Error";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');

            }

        }


    }
    
     public function delete_point($id){

         $this->load->model('trip_model');
          $data=array(
		      'id' => $id,
		      );
          if($this->trip_model->delete_point($data)){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Deleted";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');

            }
            else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Delete Error";
                 $this->session->set_userdata($data);
                 redirect('trip/add_point');

            }
     

     }



    public function add_trip_fare() 
	{
	$data['title'] = 'Add Trip Fare';
        $data['menu'] = 'Trip';

        $this->load->model('trip_model');
        $data['goods']=$this->trip_model->grab_all_goods();
        $data['points']=$this->trip_model->get_points();
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_trip_fare', $data);
        $this->load->view('footer');
    }

    public function get_end_points(){
         
        $this->load->model('trip_model');
	echo $this->input->post('start');
        $data['results']=$this->trip_model->get_end_points($this->input->post('start'));
	$data['field']='points_name';
        $q=$this->load->view('print_dropdown',$data,true);
        echo $q;

    }

    public function trip_fare_insert(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');
        $this->form_validation->set_rules('st_load', 'Standard Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_load', 'Extra Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('fixed_fare', 'Fixed Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');

        if($this->form_validation->run() == false){

            $this->add_trip_fare();
        }
        else{

           $this->load->model('trip_model');
           if($this->trip_model->insert_trip_fare()){ 
                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('trip/trip_fare_list');

            }
            else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Update Error";
                 $this->session->set_userdata($data);
                 redirect('trip/trip_fare_list');

            }

        }


    }

   public function trip_fare_list() 
	{
		  
        $this->load->library('pagination');
        $this->load->model('trip_model');
        $limit = 20;
        
        $config['base_url'] = base_url()."/trip/trip_fare_list";
        $config['total_rows'] = $this->trip_model->total_fare_list_num(); 
        
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


        $data['title'] = 'Trip Fare List';
        $data['menu'] = 'Trip';
        $data['offset']=$offset;
       
        $data['trips'] = $this->trip_model->get_trips($limit,$offset);
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('trip_fare_list', $data);
        $this->load->view('footer');
    }

    public function edit_trip_fare($id){
        $this->load->model('trip_model');
        $data['goods']=$this->trip_model->grab_all_goods();
        $data['points']=$this->trip_model->get_points();
        $data['trip'] =$this->trip_model->grab_trip_fare($id);
        // print_r($data['point']); exit;

        $data['title'] = 'Edit Trip Fare';
        $data['menu'] = 'Trip';
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_trip_fare', $data);
        $this->load->view('footer');

    }
    
    public function update_trip_fare($id = ""){
	 $this->load->library('form_validation');
        $this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');
        $this->form_validation->set_rules('st_load', 'Standard Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_load', 'Extra Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('fixed_fare', 'Fixed Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');

        if($this->form_validation->run() == false){

            $this->add_trip_fare();
        }
        else{

           $this->load->model('trip_model');
	   $data=array(

		'start_point' => $this->input->post('start_point'),
		'end_point' => $this->input->post('end_point'),
		'goods' => $this->input->post('goods'),
		'st_load' => $this->input->post('st_load'),
		'fare' => $this->input->post('fixed_fare'),
		'extra_load_unit' => $this->input->post('extra_load'),
		'extra_load_charge' => $this->input->post('extra_charge'),
   	   );
	   
           if($this->trip_model->update_trip_fare($data,$id)){ 
                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('trip/trip_fare_list');

            }
            else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Update Error";
                 $this->session->set_userdata($data);
                 redirect('trip/trip_fare_list');

            }

        }
	
    }

   public function add_general_trip(){
	 $this->load->model('trip_model');
         $data['work_orders'] =$this->trip_model->fetch_wrok_orders($id="Others");
         $data['points'] =$this->trip_model->get_points();
         $data['goods'] =$this->trip_model->grab_all_goods();
         $data['title'] = 'Add Trip';
         $data['menu'] = 'Trip';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_general_trip', $data);
        $this->load->view('footer');
    }
    
    public function insert_general_trip(){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('work_order', 'Work Order', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');
	$this->form_validation->set_rules('truck', 'Truck', 'trim|required|xss_clean');
        $this->form_validation->set_rules('total_fare', 'Total Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('total_load', 'Total Load', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');

        if($this->form_validation->run() == false){

            $this->add_general_trip();
        }
	else{
	   $this->load->model('trip_model');
	   $data=array(

		'work_order_id' => $this->input->post('work_order'),
		'truck_id' => $this->input->post('truck'),
		'start_time' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'start_point' => $this->input->post('start_point'),
		'end_point' => $this->input->post('end_point'),
		'goods' => $this->input->post('goods'),
		'total_load' => $this->input->post('total_load'),
		'total_fare' => $this->input->post('total_fare'),
		'remarks' => $this->input->post('remarks'),
		'entry_date' => date('Y-m-d',time()),
		'is_paid' => '0',
		'is_final' => '0'
   	   );
	   
	   if($trip_id=$this->trip_model->insert_general_trip($data)){
		
		$data=array(
		    'truck_id' => $this->input->post('truck'),
		    'work_order_id' => $this->input->post('work_order'),
		    'truck_id' => $this->input->post('truck'),
		    'start_time' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		    'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		    'trip_id' =>$trip_id,
		    'type' =>'2'
	       );
	       
	       if($this->trip_model->insert_truck_schedule($data)){ 
		     $data['type']="alert alert-success";
		     $data['msg']="Successfully Inserted";
		     $this->session->set_userdata($data);
		     redirect('trip/general_trip_list');
    
		}
		else{
    
		     $data['type']="alert alert-danger";
		     $data['msg']="Insert Error";
		     $this->session->set_userdata($data);
		     redirect('trip/general_trip_list');
    
	 	}
		
	  }
      }
        
    }
    
     public function edit_general_trip($id){
	 $this->load->model('trip_model');
         $data['work_orders'] =$this->trip_model->fetch_wrok_orders($flag="Others");
         $data['points'] =$this->trip_model->get_points();
         $data['goods'] =$this->trip_model->grab_all_goods();
	 $data['trip']=$this->trip_model->grab_general_trip($id);
	 //print_r($data['trip']); exit;
         $data['title'] = 'Edit Trip';
         $data['menu'] = 'Trip';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_general_trip', $data);
        $this->load->view('footer');
    }
    
    public function update_general_trip($id){
	
	$this->load->library('form_validation');
	$this->form_validation->set_rules('work_order', 'Work Order', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean');
        $this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');
	$this->form_validation->set_rules('truck', 'Truck', 'trim|required|xss_clean');
        $this->form_validation->set_rules('total_fare', 'Total Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('total_load', 'Total Load', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');

        if($this->form_validation->run() == false){

            $this->edit_general_trip($id);
        }
	else{
	   $this->load->model('trip_model');
	   $data=array(

		'work_order_id' => $this->input->post('work_order'),
		'truck_id' => $this->input->post('truck'),
		'start_time' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'start_point' => $this->input->post('start_point'),
		'end_point' => $this->input->post('end_point'),
		'goods' => $this->input->post('goods'),
		'total_load' => $this->input->post('total_load'),
		'total_fare' => $this->input->post('total_fare'),
		'remarks' => $this->input->post('remarks'),
		
		
   	   );
	   
	   if($this->trip_model->update_general_trip($data,$id)){
		
		$data=array(
		    'truck_id' => $this->input->post('truck'),
		    'work_order_id' => $this->input->post('work_order'),
		    'truck_id' => $this->input->post('truck'),
		    'start_time' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		    'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		    'trip_id' =>$trip_id,
	       );
	       
	       if($this->trip_model->update_truck_schedule($data,$id)){ 
		     $data['type']="alert alert-success";
		     $data['msg']="Successfully Upted";
		     $this->session->set_userdata($data);
		     redirect('trip/general_trip_list');
    
		}
		else{
    
		     $data['type']="alert alert-danger";
		     $data['msg']="Update Error";
		     $this->session->set_userdata($data);
		     redirect('trip/general_trip_list');
    
	 	}
		
	  }
      }
	
	
    }
    
    public function general_trip_list(){
	
	$this->load->library('pagination');
        $this->load->model('trip_model');
        $limit = 20;
        
        $config['base_url'] = base_url()."/trip/general_trip_list";
        $config['total_rows'] = $this->trip_model->total_general_trip_list(); 
        
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
	    
	$data['trips']=$this->trip_model->get_general_trips($limit,$offset);
	//print_r($data['trips']); exit();
	$data['title'] = 'General Trip List';
        $data['menu'] = 'Trip';
	$data['offset'] = $offset;
        $this->load->view('header',$data);
        $this->load->view('menu');
        $this->load->view('general_trip_list');
        $this->load->view('footer');
	
    }
    public function add_trip_bat() 
    {
        $this->load->model('trip_model');
        $data['work_orders'] =$this->trip_model->fetch_wrok_orders($id="BAT");
        $data['points'] =$this->trip_model->get_points();
        $data['goods'] =$this->trip_model->grab_all_goods();
        $data['title'] = 'Add Trip for BAT';
        $data['menu'] = 'Trip';
        
        $this->load->view('header',$data);
        $this->load->view('menu');
        $this->load->view('add_trip_bat');
        $this->load->view('footer');
    }
    
    
    
    public function fetch_goods(){
	$this->load->model('trip_model');
	//echo "sdsd";
	$p=$this->trip_model->fetch_goods();
	//print_r($p); exit;
	echo "<option value=''>Select Please</option>";
	foreach($p as $q){
		echo "<option value='".$q['id']."'>".$q['goods_name']."</option>";
	}
    }
    
     public function fetch_fare(){
	$this->load->model('trip_model');
	//echo "sdsd";
	//echo $this->input->post('goods'); 
	$p=$this->trip_model->fetch_fare();
	///print_r($p); exit;
	$data=array(
		    'fare' => $p['fare'],
		    'st_load' => $p['st_load'],
		    'ex_unit' => $p['extra_load_unit'],
		    'ex_fare' => $p['extra_load_charge'],
		    
		    );
	
	echo json_encode($data);
    }

     public function insert_trip_bat() 
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('work_order', 'Work Order', 'trim|required|xss_clean');
        $this->form_validation->set_rules('truck', 'Truck', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|xss_clean');
	$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|xss_clean');
	$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required|xss_clean');
	$this->form_validation->set_rules('end_time', 'End Time', 'trim|required|xss_clean');
	$this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean|numeric');
	$this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_rules('total_load', 'Total Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_load', 'Extra Load', 'trim|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'trim|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('fare', 'Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
	$this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');

        if($this->form_validation->run() == false){
          // echo "haj"; exit;
            $this->add_trip_bat();
        }
	else{
	   $this->load->model('trip_model');
	   if($this->trip_model->insert_bat_trip_()){
		 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('trip/bat_trip_list');
	   }
	   else{
		 $data['type']="alert alert-danger";
                 $data['msg']="Insert Failed";
                 $this->session->set_userdata($data);
                 redirect('trip/add_trip_bat');
	   }
		
	}


    }
   
    public function check_time(){
	     
	 $sd=strtotime($this->input->post('sd').' '.$this->input->post('st'));
	 $ed=strtotime($this->input->post('ed').' '.$this->input->post('et'));
	 if($sd>=$ed){
		echo "invalid";
	 }
	
	 
	     
    }
    
    public function fetch_available_trucks(){
	
	$this->load->model('trip_model');
	$data['trucks']=  $this->trip_model->fetch_available_trucks();
	// echo $truck=$this->input->post('truck'); exit;
	//echo $this->db->_error_message();
	//print_r($data['trucks']); exit;
	echo $this->load->view('fetch_available_trucks',$data,true);
	
    }
    
    public function edit_bat_trip($id){
        $this->load->model('trip_model');
        $data['work_orders'] =$this->trip_model->fetch_wrok_orders($flag="BAT");
        $data['points'] =$this->trip_model->get_points();
	$data['trip']=$this->trip_model->get_bat_trip($id);
	$data['goods'] =$this->trip_model->grab_all_goods();
	
	//print_r($data['trip']); exit;

        $data['title'] = 'Edit BAT Trip';
        $data['menu'] = 'Trip';
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_bat_trip');
        $this->load->view('footer');

    }
    
    public function update_bat_trip(){
	$this->load->library('form_validation');
        $this->form_validation->set_rules('work_order', 'Work Order', 'trim|required|xss_clean');
        $this->form_validation->set_rules('truck', 'Truck', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|xss_clean');
	$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|xss_clean');
	$this->form_validation->set_rules('start_time', 'Start Time', 'trim|required|xss_clean');
	$this->form_validation->set_rules('end_time', 'End Time', 'trim|required|xss_clean');
	$this->form_validation->set_rules('start_point', 'Start Point', 'trim|required|xss_clean|numeric');
	$this->form_validation->set_rules('end_point', 'End Point', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_rules('total_load', 'Total Load', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_load', 'Extra Load', 'trim|xss_clean|numeric');
        $this->form_validation->set_message('numeric','* Must be Numeric'); 
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'trim|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
        $this->form_validation->set_rules('fare', 'Fare', 'trim|required|xss_clean|numeric'); 
        $this->form_validation->set_message('numeric','* Must be Numeric');
	$this->form_validation->set_rules('goods', 'Goods', 'trim|required|xss_clean');

        if($this->form_validation->run() == false){
          // echo "haj"; exit;
            $this->add_trip_bat();
        }
	else{
		$this->load->model('trip_model');
		if($this->trip_model->update_bat_trip()){
		    $data['type']="alert alert-success";
		    $data['msg']="Successfully Updated";
		    $this->session->set_userdata($data);
		    redirect('trip/bat_trip_list');
		}
		else{
		    $data['type']="alert alert-danger";
                    $data['msg']="Update Failed";
                    $this->session->set_userdata($data);
                    redirect('trip/bat_trip_list');
		}
	}
	

        $data['title'] = 'Edit BAT Trip';
        $data['menu'] = 'Trip';
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_bat_trip', $data);
        $this->load->view('footer');
	
	
    }
    public function bat_trip_finalize($id = ""){
	$this->load->model('trip_model');
	if($this->trip_model->bat_trip_finalize($id)){
		
		    $data['type']="alert alert-success";
		    $data['msg']="Successfully Finalized";
		    $this->session->set_userdata($data);
		    redirect('trip/bat_trip_list');
	}
	else{
		    $data['type']="alert alert-danger";
                    $data['msg']="Finalize Failed";
                    $this->session->set_userdata($data);
                    redirect('trip/bat_trip_list');
	}	
	
	
    }
    
    public function delete_bat_trip($id){
	$this->load->model('trip_model');
	if($this->trip_model->delete_bat_trip($id)){
	     $data['type']="alert alert-success";
	     $data['msg']="Successfully Deleted";
	     $this->session->set_userdata($data);
	     redirect('trip/bat_trip_list');
		
	}
	else{
	    $data['type']="alert alert-danger";
            $data['msg']="Delete Error";
            $this->session->set_userdata($data);
            redirect('trip/bat_trip_list');
	}
	
    }

    
    public function bat_trip_list(){
	$this->load->model('trip_model');
	$this->load->library('pagination');
        $this->load->model('trip_model');
        $limit = 20;
        
        $config['base_url'] = base_url()."/trip/bat_trip_list";
        $config['total_rows'] = $this->trip_model->total_bat_trip_num(); 
        
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
	    
	$data['trips']=$this->trip_model->bat_trip_list($limit,$offset);
	$data['title'] = 'BAT Trip List';
        $data['menu'] = 'Trip';
	$data['offset']=$offset;
		
        $this->load->view('header',$data);
        $this->load->view('menu');
        $this->load->view('bat_trip_list');
        $this->load->view('footer');
	
	
    }

    public function trip_list() 
	{
	 $data['title'] = 'Trip List';
         $data['menu'] = 'Trip';
		
        $this->load->view('header',$data);
        $this->load->view('menu');
        $this->load->view('trip_list');
        $this->load->view('footer');
    }

     public function trip_expense_catgory() 
	{
		$data['title'] = 'Trip List';
         $data['menu'] = 'Trip';
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('trip_expense_catgory', $data);
        $this->load->view('footer');
    }


    public function add_transport_goods_category() 
    {
         $data['title'] = 'Add Transport Goods Category';
         $data['menu'] = 'Trip';
        
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_transport_goods_category', $data);
        $this->load->view('footer');
    }

    public function insert_transport_goods(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('goods_name', 'Goods Name', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->add_transport_goods_category();
        }
        else{
            $this->load->model('trip_model');
            if($this->trip_model->insert_transport_goods()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Inserted";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');

            }
            else{

                 $data['type']="alert alert-success";
                 $data['msg']="Insert Error";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');


            }

        }
        

    }

    public function edit_transport_goods($id=""){
        $this->load->model('trip_model');
        $data['good'] =$this->trip_model->get_goods($id);

        $data['title'] = 'Add Product Category';
        $data['menu'] = 'Trip';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('edit_goods', $data);
        $this->load->view('footer');

    }
     public function delete_transport_goods($id=""){
        $this->load->model('trip_model');
            if($this->trip_model->delete_transport_goods($id)){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Deleted";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');

            }
            else{

                 $data['type']="alert alert-success";
                 $data['msg']="Delete Error";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');


            }


    }


    public function update_transport_goods(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('goods_name', 'Goods Name', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->edit_transport_goods($this->input->post('id'));
        }
        else{
            $this->load->model('trip_model');
            if($this->trip_model->update_transport_goods()){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');

            }
            else{

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Updated";
                 $this->session->set_userdata($data);
                 redirect('trip/transport_goods_list');


            }

        }
        


    }

    public function transport_goods_list() 
    {
       
        $this->load->model('trip_model');	  
        $this->load->library('pagination');
        
        $limit = 20;
        
        $config['base_url'] = base_url()."/trip/transport_goods_list";
        $config['total_rows'] = $this->trip_model->transport_goods_list_num(); 
        
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


        $data['goods'] =$this->trip_model->grab_goods($limit,$offset);
        $data['title'] = 'Goods List';
        $data['menu'] = 'Trip';
	$data['offset']=$offset;
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('transport_goods_list', $data);
        $this->load->view('footer');
    }

    
    public function test_form(){
	$data['title'] = 'Test Form';
        $data['menu'] = 'Test';

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('test_form', $data);
        $this->load->view('footer');
	
    }
    
    public function test_form_output(){
	
	$this->load->model('trip_model');
	$p=$this->trip_model->fetch_available_trucks();
	foreach($p as $q){
		echo $q['truck_number']."<br />";
	}
    }

}

?>