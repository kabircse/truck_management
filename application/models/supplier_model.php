<?php
class Supplier_model extends CI_Model{

	public function insert_supplier(){
	 $data=array(
	            'supplier_type' =>$this->input->post('type'),
	            'supplier_name' => $this->input->post('name'),
	            'organization_name' =>$this->input->post('org_name'),
	            'address' =>$this->input->post('address'),
	            'contact_no' =>$this->input->post('contact_no'),
	            'email_id' =>$this->input->post('email'),
	           
	      	  );

	      $this->db->insert('suppliers',$data); 
		     if($this->db->affected_rows() >0){
		      return true;

	      }

	}

	public function get_suppliers(){

		return $this->db->get('suppliers')->result_array();
	}

	public function grab_supplier($id){

		return $this->db->get_where('suppliers',array('id' => $id))->row_array();
	}
	

	public function update_supplier(){
		$data=array(
	            'supplier_type' =>$this->input->post('type'),
	            'supplier_name' => $this->input->post('name'),
	            'organization_name' =>$this->input->post('org_name'),
	            'address' =>$this->input->post('address'),
	            'contact_no' =>$this->input->post('contact_no'),
	            'email_id' =>$this->input->post('email'),
	        );
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('suppliers',$data); 
		if($this->db->affected_rows() >0){
			return true;
		}
	}

	public function delete_supplier($id){
		$this->db->where('id',$id);
		if($this->db->delete('suppliers')){
			return true;
		}
		else{
		    return false;
		}
	}
	
	public function getSupplier($id){
		$this->db->where('id',$id);
		return $this->db->get('suppliers')->row_array();
	}
    
	public function addPayment($data,$data2,$supplier_id,$paid_amount){
		$this->db->trans_start();
			$this->db->insert('tms_payment_details',$data);
			$this->db->insert('tms_main_account',$data2);
			$this->db->where('id',$supplier_id);
			$paid = $this->db->get('suppliers')->row()->paid;
			$this->db->query("UPDATE suppliers SET paid=$paid+$paid_amount WHERE id=$supplier_id");
		$this->db->trans_complete();
			if($this->db->trans_status()==true)
				return true;
			else
				return false;	
	}
    
    /*public function getSupplierPayment($id){
	$this->db->where('id',$id);
	return $this->db->get('suppliers')->row_array();
    }*/
    
	public function fetchSupplierPayments12(){
		return $this->db->get('suppliers')->row_array();
	}
    
	public function fetchSuppliers($limit,$start){
		$this->db->limit($limit,$start);
		return $this->db->get('suppliers')->result_array();
	}
    
	public function record_count($tbl){
		return $this->db->count_all($tbl);
	}
    
	public function fetchSupplierPayments($limit,$start){
		//$this->db->limit($limit,$start);
		return $this->db->query("SELECT * FROM tms_payment_details tpd INNER JOIN suppliers s ON tpd.supplier_id=s.id ORDER BY date desc  LIMIT $limit OFFSET $start")->result_array();
	}
	
	public function record_count_byid($id){
		return $this->db->query("SELECT * FROM tms_payment_details WHERE supplier_id=$id")->num_rows();
	}
    
	public function getSupplierPayments($limit,$start,$id){
		//$this->db->limit($limit,$start);
		return $this->db->query("SELECT tpd.id,supplier_id,supplier_name,supplier_type,organization_name,paid_amount,remarks,date FROM tms_payment_details tpd INNER JOIN suppliers s ON tpd.supplier_id=s.id WHERE s.id=$id ORDER BY date desc  LIMIT $limit OFFSET $start")->result_array();
	}
    
	public function delete_payment($id){
		$this->db->where('id',$id);
		if($this->db->delete('tms_payment_details'))
			return true;
		else
		return false;
	}	
    
	public function getPayment($id){
		$this->db->where('id',$id);
		return $this->db->get('tms_payment_details')->row_array();
	}
    
	public function addPaymentMainAccount($data){
		return $this->db->insert('tms_main_account',$data);
	}
    
	public function getPaid($id){
		$this->db->where('id',$id);
		return $this->db->get('suppliers')->row()->paid;
	}
    
	public function updateDue($supplier_id,$amount){
		$this->db->where('id',$supplier_id);
		return $this->db->update('suppliers',array('paid'=>$amount));
	}
    
	 public function getSupplierPayment($id){
		$this->db->where('id',$id);
		return $this->db->get('tms_payment_details')->row_array();
	}
    
	public function searchSupplierPayments($limit,$start,$s,$e){
		//$this->db->limit($limit,$start);
		return $this->db->query("SELECT * FROM tms_payment_details tpd INNER JOIN suppliers s ON tpd.supplier_id=s.id AND date BETWEEN '$s' AND '$e' ORDER BY date desc  LIMIT $limit OFFSET $start")->result_array();
	}
    
        public function getSupplierPaymentsDate($limit,$start,$s,$e,$id){
		//$this->db->limit($limit,$start);
		return $this->db->query("SELECT tpd.id,supplier_id,supplier_name,supplier_type,organization_name,paid_amount,remarks,date FROM tms_payment_details tpd INNER JOIN suppliers s ON tpd.supplier_id=s.id WHERE s.id=$id AND date BETWEEN '$s' AND '$e' ORDER BY date desc LIMIT $limit OFFSET $start ")->result_array();
	}

}