 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Filename:expense_model.php
*projectname:truck_management
*Date created:November 05,2014
*Created by:Kabir
*/
class Expense_model extends CI_Model{
	public function getExpenseCategory($parent_id=0){
	        $category_data = array();
		$this->db->where('parent_id', $parent_id);
		$query = $this->db->get('tms_regular_expense_category');
		$result_array = $query->result_array();
		foreach ($result_array as $result) {
		    $category_data[] = array(
			'id' => $result['id'],
			'name' => $this->getPath($result['id']),
			'is_delete' => $result['is_delete']
		     );
		    $category_data = array_merge($category_data, $this->getExpenseCategory($result['id']));
		}	
		return $category_data;
	}
	public function getPath($category_id)
	{
		$this->db->where('id', $category_id);
		$query = $this->db->get('tms_regular_expense_category');
		$result = $query->row_array();
	
		if ($result['parent_id']) {
		    return $this->getPath($result['parent_id']) . ' > ' . $result['category_name'];
		}
		else {
		    return $result['category_name'];
		}
	}
	
	public function addExpenseCategory($data = array())
	{
		if($this->db->insert('tms_regular_expense_category',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getIsDelete($parent_id){
		$this->db->where('tms_regular_expense_category.id',$parent_id);
		return $this->db->get('tms_regular_expense_category')->row()->is_delete;	
	}
	public function updateExpenseCategory($id,$new_name)
	{
		$this->db->where('tms_regular_expense_category.id',$id);
		if($this->db->update('tms_regular_expense_category',array('category_name'=>$new_name))){
			return true;
		}
		else{
			return false;
		}
	}

	public function delete_expense_category($id)
	{
		$this->db->where('tms_regular_expense_category.id',$id);
		$p_id = $this->db->get('tms_regular_expense_category')->row()->parent_id;
		$this->db->query("UPDATE tms_regular_expense_category SET parent_id=$p_id WHERE parent_id=$id");
		$this->db->where('tms_regular_expense_category.id',$id);
		if($this->db->delete('tms_regular_expense_category'))
			return true;
		else
			return false;
	}
	public function submitExpense($data = array()){
		return $this->db->insert('tms_regular_expense',$data);
	}
	public function getExpenses($limit,$start){
		$this->db->limit($limit,$start);
		return $this->db->query('SELECT tme.*,category_name FROM tms_regular_expense tme INNER JOIN tms_regular_expense_category tm ON tm.id=tme.category_id')->result_array();
	}
	
	public function getExpense($id){
		return $this->db->query("SELECT tme.*,category_name FROM tms_regular_expense tme INNER JOIN tms_regular_expense_category tm ON tm.id=tme.category_id WHERE tme.id=$id")->result_array();
	}
	
	public function updateExpense($id,$data)
	{
		$this->db->where('tms_regular_expense.id',$id);
		if($this->db->update('tms_regular_expense',$data)){
			return true;
		}
		else{
			return false;
		}
	}

	public function delete_expense($id)
	{
		$this->db->where('tms_regular_expense.id',$id);
		if($this->db->delete('tms_regular_expense'))
			return true;
		else
			return false;
	}
	
	public function getSuppliers(){
		$this->db->where('supplier_type','1');
		return $this->db->get('suppliers')->result_array();
	}
	
	public function getTrucks(){
		return $this->db->get('tms_truck_info')->result_array();
	}
	
	public function addFuelExpense($data,$price,$supplier_id)
	{
		$this->db->trans_start();
			$total = $this->db->get_where('suppliers',array('id'=>$supplier_id))->row()->total;
			$this->db->query("Update suppliers SET total=$total+$price WHERE id=$supplier_id");
			$this->db->insert('tms_fuel',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==true)
			return true;
		else
			return false;
	}
	public function fetchFuelExpenses($limit,$start){
		$this->db->limit($limit,$start);
		return $this->db->query("SELECT tf.*,tt.truck_number as truck_number,sp.supplier_name as supplier_name FROM tms_fuel tf
				INNER JOIN tms_truck_info tt ON tf.truck_id=tt.truck_id
				INNER JOIN suppliers sp ON tf.supplier_id=sp.id
				ORDER BY tf.date
			")->result_array();
	}
	
	public function getFuelExpense($id){
		return $this->db->query("SELECT tf.*,tt.truck_number as truck_number,sp.supplier_name as supplier_name FROM tms_fuel tf
				INNER JOIN tms_truck_info tt ON tf.truck_id=tt.truck_id
				INNER JOIN suppliers sp ON tf.supplier_id=sp.id
				WHERE tf.id=$id
			")->result_array();
	}
	
	public function updateFuelExpense($id,$data){
		$this->db->where('id',$id);
		if($this->db->update('tms_fuel',$data))
			return true;
		else
			return false;
	}
	public function delete_fuel_expense($id){
		$this->db->where('tms_fuel.id',$id);
		if($this->db->delete('tms_fuel'))
			return true;
		else
			return false;
	}
	public function record_count($tb) {
		return $this->db->count_all($tb);
	}
	
	public function fetch_countries($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("Country");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else
			return false;
	}
}
/* End of file expense_model.php */
/* Location: ./application/model/expense_model.php */ 