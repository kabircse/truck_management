<?php class Servicing_model extends CI_Model{
	
	public function getCategories($parent_id = 0)
	{
		$category_data = array();
		$this->db->where('tms_servicing_category.parent_id', $parent_id);
		$query = $this->db->get('tms_servicing_category');
		
		$result_array = $query->result_array();
	
		foreach ($result_array as $result)
		{
			$category_data[] = array(
				'id'	=> $result['id'],
				'name'	=> $this->getPath($result['id'])
			);
			
			$category_data = array_merge($category_data, $this->getCategories($result['id']));
		}
		
		return $category_data;
	}
	
	public function getPath($category_id)
	{
		$this->db->where('tms_servicing_category.id', $category_id);
		$query = $this->db->get('tms_servicing_category');
		$result = $query->row_array();
		
		if ($result['parent_id']) {
			return $this->getPath($result['parent_id']) .' > '. $result['name'];
		} else {
			return $result['name'];
		}
	}
	
	
	public function insert_servicing_category($data = array())
	{
		if($this->db->insert('tms_servicing_category', $data))
			return true;
		else
			return false;
	}
	
	public function update_servicing_category($cat_id = '', $data = array())
	{
		$this->db->where('tms_servicing_category.id', $cat_id);
		if($this->db->update('tms_servicing_category', $data))
			return true;
		else
			return false;
	}
	
	
	public function delete_servicing_category($id = '')
	{
		$this->db->where('tms_servicing_category.id', $id);
		if($this->db->delete('tms_servicing_category'))
			return true;
		else
			return false;
	}
	
	public function record_count($tbl){
		return $this->db->count_all($tbl);
	}
	
	public function getAllCategories(){
		return $this->db->get('tms_servicing_category')->result_array();
	}
	
	public function fetchServicingInfo($limit,$start){
		$this->db->limit($limit,$start);
		return $this->db->query("SELECT * FROM tms_servicing_info si
				INNER JOIN tms_truck_info ti ON si.truck_id=ti.truck_id
			")->result_array();
	}
	
	public function insert_servicing_info($data){
		if($this->db->insert('tms_servicing_info', $data))
			return true;
		else
			return false;
	}
	
	public function getServicingInfo($id){
		return $this->db->query("SELECT * FROM tms_servicing_info si
				INNER JOIN tms_truck_info ti ON si.truck_id=ti.truck_id
				INNER JOIN tms_servicing_category sc ON si.servicing_category_id = sc.id
			")->row_array();	
	}
	
	public function update_servicing_info($id,$data){
		$this->db->where('tms_servicing_info.id',$id);
		if($this->db->update('tms_servicing_info', $data))
			return true;
		else
			return false;
	}
		
	public function delete_servicing_info($id){
		$this->db->where('tms_servicing_info.id', $id);
		if($this->db->delete('tms_servicing_info'))
			return true;
		else
			return false;
	}
	
	public function fetch_suppliers()
	{
		$this->db->where('suppliers.supplier_type = 2');
		return $this->db->get('suppliers')->result_array();
		
	}
	
	public function fetch_parts(){
		
		return $this->db->get('tms_products_inventory')->result_array();
		
	}
         
        public function insert_servicing_detail($batch_data){
		$this->db->insert_batch('tms_servicing_details',$batch_data);
		if($this->db->affected_rows() >0){
			
			return true;
		}
		
		
	}
	
	public function record_count_id($id,$table){
		
		return $this->db->get_where($table,array('truck_id' => $id))->num_rows();
		
	}
	
	public function fetch_servicing_details($id,$limit,$offset){
		
		$this->db->select('*');
		$this->db->from('tms_servicing_details');
		$this->db->join('suppliers as sp','sp.id=tms_servicing_details.supplier_id');
		$this->db->join('tms_products_inventory as tpi','tpi.id=tms_servicing_details.parts_id');
		$this->db->where('tms_servicing_details.truck_id',$id);
		return $this->db->get()->result_array();
	}
}?>