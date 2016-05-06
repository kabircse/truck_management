<?php
class Inventory extends CI_Controller{
	
	public function __construct() 
	{
        parent::__construct();
			if(!$this->session->userdata('check')){
				redirect('/login');
			}
		$this->load->model('inventory_model');
		$this->load->model('creation_model');
    }

	/*public function add_inventory_category($flag = '')
	{
      	$data['title'] = 'Inventory';
		$data['menu'] = 'Create Category';
		
		$data['categories'] = array();
        $results = $this->inventory_model->getCategories(0);
        foreach ($results as $result) {
            $data['categories'][] = array(
                'id' => $result['id'],
                'name' => $result['name']
            );
        }
		
		$data['flag'] = $flag;
		
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('add_inventory_category', $data);
        $this->load->view('footer');
	}
	
	public function insert_inventory_category()
	 {
        $data['title'] = "Create Category";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('parent_category', 'parent category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('category_name', 'category name', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) 
		{
            $this->add_inventory_category();
        }
		else 
		{
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'parent_id' => $this->input->post('parent_category')
            );

            if ($this->inventory_model->insert_inventory_category($data))
                redirect('inventory/add_inventory_category/created');
            else
                redirect('inventory/add_inventory_category/failed');
        }
    }
	
	public function update_inventory_category()
	 {
        $data['title'] = "Update Category";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('inventory_category', 'parent category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_name', 'category name', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) 
		{
            $this->add_inventory_category();
        } 
		else 
		{
            $cat_data = array(
                'category_name' => $this->input->post('new_name')
            );

            if ($this->inventory_model->update_inventory_category($this->input->post('inventory_category'), $cat_data))
                redirect('inventory/add_inventory_category/updated');
            else
                redirect('inventory/add_inventory_category/failed');
        }
    }

    public function delete_inventory_category($id = '')
	{
        if ($this->inventory_model->delete_inventory_category($id))
            redirect('inventory/add_inventory_category/deleted');
        else
            redirect('inventory/add_inventory_category/failed');
    }*/
	
	public function add_product($flag = '')
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Add Product Into Inventory';
		$data['flag'] = $flag;
		$data['get_creation_data'] = $this->creation_model->get_creation_data();
		$data['get_product'] = $this->inventory_model->get_product();
		
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_product', $data);
        $this->load->view('footer');

	}
	
	public function insert_product_name()
	{
		$data['title'] = "Create Category";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'parent category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('unit_name', 'category name', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) 
		{
            $this->add_product();
        }
		else 
		{
            $data = array(
                'products_name' => $this->input->post('product_name'),
                'unit_type' => $this->input->post('unit_name')
            );

            if ($this->inventory_model->insert_product_name($data))
                redirect('inventory/add_product/success');
            else
                redirect('inventory/add_product/failed');
        }
	}
	
	public function get_product_information()
	{
		if($this->input->post('product_id'))
		{
			$get_data = $this->inventory_model->get_product_information($this->input->post('product_id'));
			if($get_data)
			{
				echo json_encode($get_data);
			}
			else
			{
				echo 'false';
			}
		}
		else
		{
			echo 'false';
		}
	}
	
	public function update_product_name()
	{
		$data['title'] = "Update Product Name";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('productlist', 'product Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_name', 'New name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('unitlist', 'Unit Name', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) 
		{
            $this->add_product();
        } 
		else 
		{
            $data = array(
                'products_name' => $this->input->post('new_name'),
                'unit_type' => $this->input->post('unitlist')
            );

            if ($this->inventory_model->update_product_name($this->input->post('productlist'), $data))
                redirect('inventory/add_product/updated');
            else
                redirect('inventory/add_product/failed');
        }
	}
	
	public function inventory_in($flag = '')
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Add Inventory';
		$data['flag'] = $flag;
		
		$data['get_product'] = $this->inventory_model->get_product();
		$data['get_creation_data'] = $this->creation_model->get_creation_data();
		$data['get_supplier'] = $this->inventory_model->get_supplier();
		//print_r($data['get_supplier']);exit();
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('inventory_in', $data);
        $this->load->view('footer');
	}
	
	public function addtoCart() 
	{
        if ($this->input->post()) 
		{
			$this->load->library('form_validation');
            $this->form_validation->set_rules('productlist', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			
            if ($this->form_validation->run() === FALSE) 
			{
                $this->inventory_in();
            } 
			else 
			{
                $product_id = $this->input->post('productlist');
                $unit_price = $this->input->post('price') / $this->input->post('quantity');
				
                $get_name = $this->inventory_model->get_product_information($product_id);
				//print_r($get_name);
                $data = array(
                    'id' => $this->input->post('productlist'),
                    'qty' => 1,
                    'price' => 25,
                    'name' => $get_name['products_name'],
                    'options' => array('unit_price' => $unit_price, 'quantity' => $this->input->post('quantity'),'unit' => $get_name['unit_name'],'stock' => $get_name['stock'],'price' => $this->input->post('price'))
                );
				 //print_r($data);
				 //exit();
				 
                if ($this->cart->insert($data)) 
				{
                    redirect(base_url().'inventory/inventory_in/insert');
                } 
				else 
				{
                    redirect(base_url().'inventory/inventory_in/failed');
                }
            }
        } 
		else 
		{
            show_404();
        }
    }
	
	public function deleteCart($id = '') 
	{
        $data = array(
            'rowid' => $id,
            'qty' => 0
        );
        $this->cart->update($data);
        redirect(base_url().'inventory/inventory_in/deleted');
    }
	
	public function insert_entry()
	{
		if ($this->input->post()) 
		{
			$this->load->library('form_validation');
            //$this->form_validation->set_rules('chalan', 'Chalan', 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('is_new', 'New OR Old', 'trim|required|xss_clean');
            //this->form_validation->set_rules('supplierlist', 'Supplier', 'trim|required|xss_clean');
			
            if ($this->form_validation->run() === FALSE) 
			{
                $this->inventory_in('failed');
            } 
			else 
			{
				//$date = date("Y-m-d", strtotime($this->input->post('date')));
				//echo $new_dateorig; exit();
				
                foreach ($this->cart->contents() as $cart) 
				{
                    $id = $cart['id'];
                    $stock = $cart['options']['quantity'] + $cart['options']['stock'];
					
                    $data_array = array(
                        'stock' => $stock,
                    );
					
                    //this model is for updating data in tms_products_inventory table
                    $this->inventory_model->update_inventory_stock_data($id, $data_array);
					
                    $new_array = array(
                        'product_id' => $id,
                        'quantity' => $cart['options']['quantity'],
                        'purchase_price' => $cart['options']['price'],
                        'supplier_id' => $this->input->post('supplierlist'),
                        'remarks' => $this->input->post('remarks'),
                        'date' => $this->input->post('date'),
                        'chalan_id' => $this->input->post('chalan'),
						'in_out_type' => 1,
						'is_new' => $this->input->post('is_new')
                    );
                    $this->inventory_model->insert_product_in_out($new_array);
					
					if($this->input->post('supplierlist') != '')
					{
						$data_supplier = array(
							'due' => $cart['options']['price']
						);
					   $this->inventory_model->insert_supplier_due_amount($data_supplier,$this->input->post('supplierlist'));
					}
                }
                $this->cart->destroy();
                redirect(base_url() . 'inventory/inventory_in/success');
            }
        } 
		else 
		{
            show_404();
        }
	}
	
	public function inventory_list($flag = '')
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Product List';
		$data['flag'] = $flag;
		
		$data['get_product'] = $this->inventory_model->get_product();
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('inventory_list', $data);
        $this->load->view('footer');
	}
	
	public function get_product_report($product_id = '')
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Product Report';
		
		$data['product_id'] = $product_id;
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('inventory_report', $data);
        $this->load->view('footer');
	}
	
	public function submit_date_for_report($product_id = '')			// This function for product/inventory in out report
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Product Report';
		
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$data['get_in_out_report'] = $this->inventory_model->get_product_in_out_report($start_date, $end_date, $product_id);
		/*echo '<pre>';
		print_r($data['get_in_out_report']);
		echo '</pre>';
		exit();*/
		
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['product_id'] = $product_id;
		
        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('inventory_report_show', $data);
        $this->load->view('footer');
	}
	
	public function print_in_out_report($start_date = '', $end_date = '',$product_id = '')
	{
		$data['title'] = 'Inventory';
		$data['menu'] = 'Product Report';
		
		$data['get_in_out_report'] = $this->inventory_model->get_product_in_out_report($start_date, $end_date, $product_id);
		/*echo '<pre>';
		print_r($data['get_in_out_report']);
		echo '</pre>';
		exit();*/
		$this->load->view('header', $data);
        $this->load->view('print_in_out_report', $data);
	}
	
	public function delete_inventory_product($product_id = '')
	{
		if($this->inventory_model->delete_inventory_product($product_id))
		{
			redirect(base_url() . 'inventory/inventory_list/deleted');
		}
		else
		{
			redirect(base_url() . 'inventory/inventory_list/failed');	
		}
	}
	
}
?>