 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Filename:truck_model.php
*projectname:truck_management
*Date created:November 05,2014
*Created by:Kabir
*/
class Truck_model extends CI_Model{

	public function addTruckType($data = array()){
		if($this->db->insert('tms_truck_types',$data)){
			return true;
		}
		else{
			return false;
		}
	}

        public function getTruckTypes()
	{
		$query = $this->db->get('tms_truck_types');
		$result_array = $query->result_array();
		return $result_array;
        }
    
        public function update_truck_type($id,$new_name){
		$this->db->where('type_id',$id);
		$data = array('type_name'=>$new_name);
		if($this->db->update('tms_truck_types',$data)){
			return true;
		}
		else{
			return false;
		}
	}
        public function delete_truck_type($id)
	{
		$this->db->where('type_id',$id);
		if($this->db->delete('tms_truck_types'))
			return true;
		else
			return false;
	}
	public function addTruck($data = array()){
		if($this->db->insert('tms_truck_info',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function record_count($tbl){
		return $this->db->count_all($tbl);
	}
	public function fetchTrucks($limit,$start){
		$this->db->limit($limit,$start);
		$query = $this->db->query("SELECT * FROM tms_truck_info ti
					INNER JOIN tms_truck_types tt ON tt.type_id=ti.truck_id
		");
	        $result_array = $query->result_array();
	        return $result_array;
	}
	public function getTrucks(){
		$query = $this->db->query("SELECT * FROM tms_truck_info");
	        $result_array = $query->result_array();
	        return $result_array;
	}
	public function getTruck($id){
		$query = $this->db->query("SELECT * FROM tms_truck_info ti
			INNER JOIN tms_truck_types tt ON tt.type_id=ti.truck_id
			WHERE ti.truck_id='$id'
		");
	        $result_array = $query->result_array();
	        return $result_array;		
	}
	public function updateTruck($data,$id)
	{
		$this->db->where('truck_id',$id);
		if($this->db->update('tms_truck_info',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function delete_truck($id){
		$this->db->where('truck_id',$id);
		if($this->db->delete('tms_truck_info'))
			return true;
		else
			return false;
	}
	
	public function fetchTruckFuel($limit,$start,$id){
		$query = $this->db->query("SELECT * FROM tms_fuel tf
				INNER JOIN tms_truck_info ti ON tf.truck_id=ti.truck_id
				INNER JOIN suppliers s ON s.id= tf.supplier_id
				WHERE tf.truck_id=$id ORDER BY date DESC LIMIT $limit OFFSET $start")->result_array();
	        return $query;
	}
	
	/*public function getSupplier($truck_id){
		$this->db->where('truck_id',$id);
		return $this->db->get('tms_fuel')->row()->supplier_id;
	}*/
	
	public function getTruckById($id){
		$query = $this->db->query("SELECT * FROM tms_truck_info ti
			INNER JOIN tms_truck_types tt ON tt.type_id=ti.truck_id
			WHERE ti.truck_id='$id'
		");
	        $result_array = $query->row_array();
	        return $result_array;		
	}
	
	
}
/* End of file truck_model.php */
/* Location: ./application/model/truck_model.php */ 