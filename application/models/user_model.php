<?php
class User_model extends CI_Model{
    
	public function __construct() 
	{
        parent::__construct();
    }
	
	public function check_email($email = '')
	{
		$this->db->where('email', $email);
		$get_email = $this->db->get('tms_user');
		if($get_email->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
    public function insert_user($data_array)
	{
        if($this->db->insert('tms_user', $data_array)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
	
	public function get_total_user_list()
	{
		$this->db->select('*');
		$get = $this->db->get('tms_user');
		if($get->num_rows() > 0)
			return $get->num_rows();
		else
			return false;
	}
	
    public function get_user_list($limit=5, $offset=0)
	{
		$this->db->select('*');
		$this->db->limit($limit, $offset);
        $qurey = $this->db->get('tms_user');
        if($qurey->num_rows()>0){
            return $qurey;
        }
        else{
            return FALSE;
        }
    }
	
    public function delete_user($id){
        $this->db->where('id', $id);
        if($this->db->delete('tms_user')){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    public function get_user_info($id){
        $this->db->where('id', $id);
        $this->db->select('*');
        $this->db->from('tms_user');
        $qurey = $this->db->get();
        if($qurey->num_rows()>0){
            return $qurey;
        }
        else{
            return FALSE;
        }
    }
    public function update_user($data_array, $id){
        $this->db->where('id', $id);
        if($this->db->update('tms_user', $data_array)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    public function check($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->select('*');
        $this->db->from('tms_user');
        $qurey = $this->db->get();
        if($qurey->num_rows() == 1){
            return $qurey;
        }
        else{
            return FALSE;
        }
    }
	
	public function get_cash()
	{
		$this->db->select('*');
		$get_data = $this->db->get('acc_cash_amount');
		if($get_data->num_rows() > 0)
		{
			return true;
		}
		else
			return false;
	}
}

?>
