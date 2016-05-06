<?php

class Creation_model extends CI_Model{
	
	public function creation($data = array())
	{
		if($this->db->insert('tms_unit', $data))
			return true;
		else
			return false;
	}
	
	public function update_creation($data = array(), $id = '')
	{
		$this->db->where('tms_unit.unit_id', $id);
		if($this->db->update('tms_unit', $data))
			return true;
		else
			return false;
	}
	
	
	public function get_creation_data()
	{
		$this->db->select('*');
		$this->db->from('tms_unit');
		$get_data = $this->db->get();
		
		if($get_data->num_rows() > 0)
		{
			return $get_data->result_array();
		}
		else
		{
			return false;
		}
	}
	
	public function delete_creation_data($cr_id = '')
	{
		$this->db->where('unit_id', $cr_id);
		if($this->db->delete('tms_unit'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
}