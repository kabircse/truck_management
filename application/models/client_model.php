 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Filename:client_model.php
*projectname:truck_management
*Date created:November 05,2014
*Created by:Kabir
*/
class Client_model extends CI_Model{

	public function addClient($data = array()){
		if($this->db->insert('tms_client',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function getClients($limit,$start){
		$this->db->limit($limit,$start);
		$query = $this->db->get("tms_client")->result_array();
	        return $query;
	}
	public function getClient($id){
		$query = $this->db->get_where('tms_client',array('id'=>$id));
	        $result_array = $query->result_array();
	        return $result_array;		
	}
	public function updateClient($data,$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('tms_client',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function delete_client($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('tms_client'))
			return true;
		else
			return false;
	}
	
	public function record_count($tbl){
		return $this->db->count_all($tbl);
	}
	
	
}
/* End of file client_model.php */
/* Location: ./application/controller/client_model.php */ 