<?php

class Driver extends CI_Controller {

    public function __construct() 
	{
        parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
    }

    public function index() 
	{
	
    }
	
	public function add_driver() 
	{
		$data['menu']="Driver Info.";
		$data['title'] = 'Add Driver';
		
        $this->load->view('header',$data);
        $this->load->view('menu',$data);
        $this->load->view('add_driver',$data);
        $this->load->view('footer');
    }

    public function driver_list() 
    {
	 $this->load->model('driver_model');  
        $this->load->library('pagination');
        
        $limit = 20;
        
        $config['base_url'] = base_url()."/trip/driver_list";
        $config['total_rows'] = $this->driver_model->driver_list_num(); 
        
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


	
	
	
	
        $data['title'] = 'Driver List';
        $data['menu']="Driver Info.";
        $data['offset']=$offset;
        $data['drivers'] =$this->driver_model->get_drivers($limit,$offset);
        
        
        $this->load->view('header',$data);
        $this->load->view('menu',$data);
        $this->load->view('driver_list',$data);
        $this->load->view('footer');
    }


    public function insert_driver()
	{
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Driver Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean|is_unique[drivers.id]');
		$this->form_validation->set_rules('phn_number', 'Phone Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phn_number', 'Phone Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == false){

			$this->add_driver();
		}
		else{
          $this->load->model('driver_model');
         
          
                    $ext=$_FILES['img_file']['name'];
				    $ext=explode(".",$ext);
     
				     
				      $config['upload_path'] = "./uploads/drivers";
				      $config['allowed_types'] = 'gif|jpg|png';
					  //$config['max_size']	= '100';
					  // $config['max_width']  = '1024';
				      //$config['max_height']  = '768';
					  $config['file_name']  = $this->input->post('id').".".$ext[1];

					  $this->load->library('upload', $config);
					  if($this->upload->do_upload('img_file')){

                        if($this->driver_model->insert_driver_info($config['file_name'])){
                            $data['type']="alert alert-success";
                            $data['msg']="Successfully Inserted";
                            $this->session->set_userdata($data);

                            redirect('driver/driver_list');

                         }
                        else{
                             $data['type']="alert alert-danger";
                             $data['msg']="Insert Error";
                             $this->session->set_userdata($data);

                            redirect('driver/driver_list');

                         }

					  }
                      			
            

		}

    }

    public function edit_driver($id=""){
        $data['menu']="Driver Info.";
        $data['title'] = 'Edit Driver'; 


        $this->load->model('driver_model');
        $data['driver'] =$this->driver_model->grab__driver($id);
       // print_r($data['driver']); exit();
        
        $this->load->view('header',$data);
        $this->load->view('menu',$data);
        $this->load->view('edit_driver',$data);
        $this->load->view('footer');

    }

    public function edit_driver_validation(){


        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Driver Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phn_number', 'Phone Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phn_number', 'Phone Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){

            $this->add_driver();
        }
        else{
          $this->load->model('driver_model');
          if($this->driver_model->driver_check($this->input->post('old_id'))){

                  if($ext=$_FILES['img_file']['name']){
                        $ext=explode(".",$ext);
         
                         
                          $config['upload_path'] = "./uploads/drivers";
                          $config['allowed_types'] = 'gif|jpg|png';
                          //$config['max_size'] = '100';
                          // $config['max_width']  = '1024';
                          //$config['max_height']  = '768';
                          $config['overwrite']=true;
                          $config['file_name']  = $this->input->post('id').".".$ext[1];

                          $this->load->library('upload', $config);
                          $this->upload->do_upload('img_file');
                          $q=$this->driver_model->update_driver($config['file_name']);
                    }
                    else{
                         $q=$this->driver_model->update_driver();

                    }
          
                    if($q){

                         $data['type']="alert alert-success";
                         $data['msg']="Successfully Updated";
                         $this->session->set_userdata($data);

                         redirect('driver/driver_list');

                    }
                    else{

                         $data['type']="alert alert-danger";
                         $data['msg']="Update Error";
                         $this->session->set_userdata($data);

                         redirect('driver/driver_list');
         
                    }

          }
          else{
            echo "<script>alert('ID is already in use.');</script>";
            $this->edit_driver($this->input->post('old_id'));
          }

       }

    }


    public function delete_driver($id){

       $this->load->model('driver_model');
          if($this->driver_model->delete_driver($id)){

                 $data['type']="alert alert-success";
                 $data['msg']="Successfully Deleted";
                 $this->session->set_userdata($data);
                 redirect('driver/driver_list');

           }
           else{

                 $data['type']="alert alert-danger";
                 $data['msg']="Delete Error";
                 $this->session->set_userdata($data);
                 redirect('driver/driver_list');

           }

    }



}

?>
