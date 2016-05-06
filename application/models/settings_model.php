 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Filename:settings_model.php
*projectname:truck_management
*Date created:November 11,2014
*Created by:Kabir
*/
class Settings_model extends CI_Model{

	public function addUser($data){
		if($this->db->insert('tms_user',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function record_count($tbl){
		return $this->db->count_all($tbl);
	}
	
	public function fetchUsers($limit,$start){
		$this->db->limit($limit,$start);
		$query = $this->db->get('tms_user')->result_array();
	        return $query;
	}
	
	public function getUser($id){
		$query = $this->db->get_where('tms_user',array('id'=>$id));
	        $result_array = $query->result_array();
	        return $result_array;		
	}
	
	public function updateUser($id,$data){
		$this->db->where('id',$id);
		if($this->db->update('tms_user',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function delete_user($id){
		$this->db->where('id',$id);
		if($this->db->delete('tms_user'))
			return true;
		else
			return false;
	}
	
	public function activate_user($id){
		$this->db->where('id',$id);
		if($this->db->update('tms_user',array('is_active'=>'1')))
			return true;
		else
			return false;
	}
	
	public function deactivate_user($id){
		$this->db->where('id',$id);
		if($this->db->update('tms_user',array('is_active'=>'0')))
			return true;
		else
			return false;
	}
	
	
}
/* End of file settings_model.php */
/* Location: ./application/models/settings_model.php */ 