<?php
class Inventory_model extends CI_Model {

    public function getCategories($parent_id = 0)
	 {
        $category_data = array();

        $this->db->where('parent_id', $parent_id);
        $query = $this->db->get('tms_inventory_category');

        $result_array = $query->result_array();

        foreach ($result_array as $result) {
            $category_data[] = array(
                'id' => $result['category_id'],
                'name' => $this->getPath($result['category_id'])
            );

            $category_data = array_merge($category_data, $this->getCategories($result['category_id']));
        }

        return $category_data;
    }

    public function getPath($category_id)
	{
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('tms_inventory_category');
        $result = $query->row_array();

        if ($result['parent_id']) {
            return $this->getPath($result['parent_id']) . ' > ' . $result['category_name'];
        } else {
            return $result['category_name'];
        }
    }
	
	public function insert_inventory_category($data = array())
	{
		if ($this->db->insert('tms_inventory_category', $data))
            return true;
        else
            return false;
	}
	
	public function update_inventory_category($cat_id = '', $data = array()) 
	{
        $this->db->where('category_id', $cat_id);
        if ($this->db->update('tms_inventory_category', $data))
            return true;
        else
            return false;
    }

    public function delete_inventory_category($id = '') 
	{
		$this->db->where('category_id', $id);
		$get_data = $this->db->get('tms_inventory_category')->row_array();
		
		$data_array = array(
			'parent_id' => $get_data['parent_id'] 
		);
		$this->db->where('parent_id', $id);
		if($this->db->update('tms_inventory_category', $data_array))
		{
			$this->db->where('category_id', $id);
			if ($this->db->delete('tms_inventory_category'))
				return true;
			else
				return false;
		}
		else
			return false;
    }
	
	public function insert_product_name($data = array())
	{
		if ($this->db->insert('tms_products_inventory', $data))
            return true;
        else
            return false;
	}
	
	public function get_product()
	{
		$this->db->from('tms_products_inventory');
		$this->db->join('tms_unit','tms_unit.unit_id = tms_products_inventory.unit_type');
		$get_data = $this->db->get();
		if ($get_data->num_rows > 0)
			return $get_data->result_array();
		else
			return false;
	}
	
	public function get_product_information($product_id = '')
	{
		$this->db->where('tms_products_inventory.id', $product_id);
		$this->db->from('tms_products_inventory');
		$this->db->join('tms_unit','tms_unit.unit_id = tms_products_inventory.unit_type');
		$get_data = $this->db->get();
		if ($get_data->num_rows > 0)
			return $get_data->row_array();
		else
			return false;
	}
	
	public function update_product_name($id = '', $data = array()) 
	{
        $this->db->where('tms_products_inventory.id', $id);
        if ($this->db->update('tms_products_inventory', $data))
            return true;
        else
            return false;
    }
	
	public function get_supplier()
	{
		$this->db->where('suppliers.supplier_type = 2');	
		$get_data = $this->db->get('suppliers');
		if ($get_data->num_rows > 0)
			return $get_data->result_array();
		else
			return false;
	}
	
	public function update_inventory_stock_data($id = '', $data = array())
	{
		$this->db->where('tms_products_inventory.id', $id);
        if ($this->db->update('tms_products_inventory', $data))
            return true;
        else
            return false;
	}
	
	public function insert_product_in_out($data = array())
	{
		if ($this->db->insert('tms_inventory_in_out', $data))
            return true;
        else
            return false;
	}
	
	public function insert_supplier_due_amount($data = array(), $supplier_id = '')
	{
		$this->db->where('suppilers.id', $supplier_id);
		$get_data = $this->db->get('suppilers')->row_array();
		
		$data_array = array(
			'total' => $get_data['total'] + $data['due']
		);
		$this->db->where('suppilers.id', $supplier_id);
		if($this->db->update('suppilers',$data_array))
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	public function get_product_in_out_report($start_date = '', $end_date = '', $product_id = '')
	{
		/*$qurey = $this->db->query("SELECT tms_inventory_in_out.*, SUM(tms_inventory_in_out.quantity) as qty,  tms_products_inventory.products_name, tms_products_inventory.unit_type, tms_unit.unit_name FROM `tms_inventory_in_out` INNER JOIN `tms_products_inventory`
            ON  (tms_products_inventory.id = tms_inventory_in_out.product_id) INNER JOIN `tms_unit` ON (tms_unit.unit_id = tms_products_inventory.unit_type) WHERE tms_inventory_in_out.date BETWEEN '$start_date' AND '$end_date' AND tms_inventory_in_out.product_id = $product_id GROUP BY tms_inventory_in_out.date ORDER BY `date` DESC");*/
        
        //echo "SELECT raw_material_in_out.*, SUM(raw_material_in_out.raw_quantity) as qty,  raw_material.raw_material_name, raw_material.raw_material_unit_type, unit.unit_name FROM `raw_material_in_out` INNER JOIN `raw_material`
            //ON  (raw_material.raw_material_id = raw_material_in_out.raw_id) INNER JOIN `unit` ON (unit.unit_id = raw_material.raw_material_unit_type) WHERE raw_material_in_out.raw_date BETWEEN '$sdate' AND '$edate' AND raw_material_in_out.raw_id = $raw_id GROUP BY raw_material_in_out.raw_date ORDER BY `raw_date` DESC";exit;
			
		
		$dateRange = "date BETWEEN '$start_date%' AND '$end_date%'";
		$this->db->where('tms_inventory_in_out.product_id', $product_id);
		$this->db->where($dateRange, NULL, FALSE); 
		$this->db->from('tms_inventory_in_out');
		$this->db->join('tms_products_inventory','tms_products_inventory.id = tms_inventory_in_out.product_id');
		$this->db->join('tms_unit','tms_unit.unit_id = tms_products_inventory.unit_type');
		$get_data = $this->db->get();
        if ($get_data->num_rows() > 0) 
			return $get_data->result_array();
		else
			return false;
	}
	
	public function delete_inventory_product($product_id = '')
	{
		$this->db->where('tms_products_inventory.id', $product_id);
		if($this->db->delete('tms_products_inventory'))
		{
			$this->db->where('tms_inventory_in_out.product_id', $product_id);
			if($this->db->delete('tms_inventory_in_out'))
			{
				return true;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;
		}
	}

    

}