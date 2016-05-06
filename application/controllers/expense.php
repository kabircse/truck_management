<?php
class Expense extends CI_Controller{
/*
*Filename:Expense.php
*project name:truck_management
*Date created:November 08,2014
*Created by:Kabir
*/
    public function __construct(){
	parent::__construct();
		if(!$this->session->userdata('check')){
			redirect('/login');
		}
	$this->load->library('form_validation');
	$this->load->library('pagination');
	$this->load->model('expense_model');
	
	
    }
    public function create_expense_category(){
	$data['title'] = 'Create Expense Category';
	$data['expense_category'] = $this->expense_model->getExpenseCategory(0);
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('create_expense_category');
        $this->load->view('footer');
    }

    public function submit_expense_category(){
	    $this->form_validation->set_rules('parent_category','Parent Category','required|trim|xss_clean');
	    $this->form_validation->set_rules('category_name','Category Name','required|trim|xss_clean|min_length[4]|is_unique[tms_regular_expense_category.category_name]');
	    if($this->form_validation->run()==false){
		$this->create_expense_category();
	    }
	    else{
		$parent_id = $this->input->post('parent_category');
		$is_delete = $this->expense_model->getIsDelete($parent_id);
		if($is_delete == 0)
		   $stat = 0;
		else
		  $stat = 1;
		$data = array(
		    'category_name' => $this->input->post('category_name'),
		    'parent_id' => $parent_id,
		    'is_delete' => $stat
		);
		if($this->expense_model->addExpenseCategory($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/create_expense_category/added');
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/create_expense_category/failed');   
		}
	    }
    }
    public function delete_expense_category($id=''){
    {
        if($id>0){
	    if($this->expense_model->delete_expense_category($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/create_expense_category/deleted');   
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/create_expense_category/failed');
	    }
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	    redirect('expense/create_expense_category/failed');
	}
	}
    }
    public function update_expense_category(){
	$id = $this->input->post('parent_category2');
	$new_name = $this->input->post('new_name');
	$this->form_validation->set_rules('parent_category2','Parent Category','required|trim|xss_clean');
	$this->form_validation->set_rules('new_name','Category Name','required|trim|xss_clean|min_length[4]|is_unique[tms_regular_expense_category.category_name]');
	    if($this->form_validation->run()==false){
		$this->create_expense_category();
	    }
	    else{
		if($this->expense_model->updateExpenseCategory($id,$new_name)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/create_expense_category/updated');
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/create_expense_category/failed');   
		}
	    }
    }

    public function add_expense(){
	$data['title'] = 'Add expense';
	$data['expense_category'] = $this->expense_model->getExpenseCategory(0);
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_expense', $data);
        $this->load->view('footer');
    }

    public function submit_expense()
    {
	$this->form_validation->set_rules('category_id','Category','required|trim|xss_clean');
	$this->form_validation->set_rules('amount','Amount','required|trim|xss_clean');
	$this->form_validation->set_rules('remarks','Remarks','required|trim|xss_clean');
	$this->form_validation->set_rules('start','Date','required|trim|xss_clean');
	if($this->form_validation->run()==false){
	    $this->add_expense();
	}
	else{
	    $data = array(
		'category_id' => $this->input->post('category_id'),
		'amount' => $this->input->post('amount'),
		'remarks' => $this->input->post('remarks'),
		'date' => date('Y-m-d',strtotime($this->input->post('start')))
	    );
	    if($this->expense_model->submitExpense($data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/expense_list/added');
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/add_expense/failed');
	    }
	}
	
    }
    public function delete_expense($id=''){
    {
        if($id>0){
	    if($this->expense_model->delete_expense($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/expense_list/deleted');   
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/expense_list/failed');
	    }
	}
	else{
		$notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		);
		$this->session->set_flashdata($notifications);
	    redirect('expense/expense_list/failed');
	    }
	}
    }
    public function edit_expense($id){
	if($id>0){
	    $data['title'] = 'Edit Expense';
	    $data['expense_category'] = $this->expense_model->getExpenseCategory(0);
	    $data['expense'] = $this->expense_model->getExpense($id);
	    $this->load->view('header', $data);
	    $this->load->view('menu');
	    $this->load->view('edit_expense', $data);
	    $this->load->view('footer');
	}
	else{
	    $notifications = array(
		'sign' => 'alert alert-danger',
		'msg' => 'Failed'
	    );
	    $this->session->set_flashdata($notifications);
	   redirect('expense/expense_list/failed');
	}
    }
    public function update_expense(){
	$id = $this->input->post('id');
	$this->form_validation->set_rules('category_id','Category','required|trim|xss_clean');
	$this->form_validation->set_rules('amount','Amount','required|trim|xss_clean');
	$this->form_validation->set_rules('remarks','Remarks','required|trim|xss_clean');
	$this->form_validation->set_rules('start','Date','required|trim|xss_clean');
	    if($this->form_validation->run()==false){
		$this->edit_expense();
	    }
	    else{
		$data = array(
		    'category_id' => $this->input->post('category_id'),
		    'amount' => $this->input->post('amount'),
		    'remarks' => $this->input->post('remarks'),
		    'date' => date('Y-m-d',strtotime($this->input->post('start')))
		);
		if($this->expense_model->updateExpense($id,$data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/expense_list/updated');
		}
		else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
		    redirect('expense/expense_list/failed');   
		}
	    }
    }
    public function expense_list(){
	$limit = 10;
        $config["base_url"] = base_url() . "expense/expense_list";
        $config["total_rows"] = $this->expense_model->record_count('tms_regular_expense');
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
        $data["expenses"] = $this->expense_model->getExpenses($limit,$start);
        $data["links"] = $this->pagination->create_links();
	$data['i'] = $start+1;
	$data['title'] = 'Expense List';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('expense_list', $data);
        $this->load->view('footer');
    }
    public function fuel_expense(){
	$data['title'] = 'Add Fuel Expenses';
	$data['suppliers'] = $this->expense_model->getSuppliers();
	$data['trucks'] = $this->expense_model->getTrucks();
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('fuel_expense');
        $this->load->view('footer');
    }
    public function submit_fuel_expense(){
	$this->form_validation->set_rules('supplier_id','Supplier Name','required|trim|xss_clean');
	$this->form_validation->set_rules('truck_id','Truck No','required|trim|xss_clean');
	$this->form_validation->set_rules('chalan_no','Chalan No','required|trim|xss_clean');
	$this->form_validation->set_rules('quantity','Quantity','required|trim|xss_clean|is_natural_no_zero');
	$this->form_validation->set_rules('unit_price','Unit Price','required|trim|xss_clean|numeric');
	$this->form_validation->set_rules('total_price','Total Price','required|trim|xss_clean|numeric');
	$this->form_validation->set_rules('start','Date','required|trim|xss_clean');
	if($this->form_validation->run()==false){
	    $this->fuel_expense();
	}
	else{
	    $price = $this->input->post('total_price');
	    $supplier_id = $this->input->post('supplier_id');
	    $data = array(
		'supplier_id' => $this->input->post('supplier_id'),
		'truck_id' => $this->input->post('truck_id'),
		'quantity' => $this->input->post('quantity'),
		'unit_price' => $this->input->post('unit_price'),
		'total_price' => $this->input->post('total_price'),
		'date' => date('Y-m-d',strtotime($this->input->post('start'))),
		'chalan_no' => $this->input->post('chalan_no')
	    );
	    if($this->expense_model->addFuelExpense($data,$price,$supplier_id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Added'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/fuel_expense_list/added');
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/fuel_expense_list/failed');   
	    }
	}
    }
    public function fuel_expense_list(){
	$limit = 20;
        $config["base_url"] = base_url() . "expense/fuel_expense_list";
        $config["total_rows"] = $this->expense_model->record_count('tms_fuel');
        $config["per_page"] = $limit;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["fuel_expenses"] = $this->expense_model->fetchFuelExpenses($limit,$start);
        $data["links"] = $this->pagination->create_links();
	
	$data['title'] = 'Fuel Expense List';
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('fuel_expense_list', $data);
        $this->load->view('footer');
    }
    public function delete_fuel_expense($id){
    {
        if($id>0){
	    if($this->expense_model->delete_fuel_expense($id)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Deleted'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/fuel_expense_list/deleted');   
	    }
	    else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	        redirect('expense/fuel_expense_list/failed');
	    }
	}
	else{
	    	    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	    redirect('expense/fuel_expense_list/failed');
	    }
	}
    }
    public function edit_fuel_expense($id){
	if($id>0){
	    $data['title'] = 'Edit Expense';
	    $data['suppliers'] = $this->expense_model->getSuppliers();
	    $data['trucks'] = $this->expense_model->getTrucks();
	    $data['fuel_expense'] = $this->expense_model->getFuelExpense($id);
	    $this->load->view('header', $data);
	    $this->load->view('menu');
	    $this->load->view('edit_fuel_expense', $data);
	    $this->load->view('footer');
	}
	else{
		    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
	   redirect('expense/fuel_expense_list/failed');
	}
    }
    public function update_fuel_expense(){
	$id = $this->input->post('id');
	$this->form_validation->set_rules('supplier_id','Supplier Name','required|trim|xss_clean');
	$this->form_validation->set_rules('truck_id','Truck No','required|trim|xss_clean');
	$this->form_validation->set_rules('chalan_no','Chalan No','required|trim|xss_clean');
	$this->form_validation->set_rules('quantity','Quantity','required|trim|xss_clean|is_natural_no_zero');
	$this->form_validation->set_rules('unit_price','Unit Price','required|trim|xss_clean|numeric');
	$this->form_validation->set_rules('total_price','Total Price','required|trim|xss_clean|numeric');
	$this->form_validation->set_rules('start','Date','required|trim|xss_clean');
	if($this->form_validation->run()==false){
	    $this->edit_fuel_expense($id);
	}
	else{
	    //$parent_id = $this->input->post('parent_category');
	    $data = array(
		'supplier_id' => $this->input->post('supplier_id'),
		'truck_id' => $this->input->post('truck_id'),
		'quantity' => $this->input->post('quantity'),
		'unit_price' => $this->input->post('unit_price'),
		'total_price' => $this->input->post('total_price'),
		'date' => date('Y-m-d',strtotime($this->input->post('start'))),
		'chalan_no' => $this->input->post('chalan_no')
	    );
	    if($this->expense_model->updateFuelExpense($id,$data)){
		    $notifications = array(
			'sign' => 'alert alert-success',
			'msg' => 'Updated'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/fuel_expense_list/updated');
	    }
	    else{
	    	    $notifications = array(
			'sign' => 'alert alert-danger',
			'msg' => 'Failed'
		    );
		    $this->session->set_flashdata($notifications);
		redirect('expense/fuel_expense_list/failed');   
	    }
	}
    }
}
/* End of file expense.php */
/* Location: ./application/controller/expense.php */ 