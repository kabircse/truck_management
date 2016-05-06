<?php	

class Work_order_model extends CI_Model{
	
   public function insert_work_order()
   {
    
    $data = array(
      'client_name' => $this->input->post('client_name'),
      'order_id' => $this->input->post('order_id'),
      'description' => $this->input->post('description'),
      'quantity' => $this->input->post('quantity'),
      'unit_price' => $this->input->post('unit_price'),
      'total_price' => $this->input->post('total_price'),
      'order_date' => date('Y-m-d',strtotime($this->input->post('order_date'))),
      'delivery_date' => date('Y-m-d',strtotime($this->input->post('delivery_date'))),
      'date' => date('Y-m-d',time())

    	);
      if($this->input->post('client_name') == "BAT"){
		$data['client_type'] = '1';
      }
      else{
		$data['client_type'] = '2';
      }
  	 $this->db->insert('tms_work_order',$data);

   echo $this->db->_error_message();
   if($this->db->affected_rows()>0){
     return true;
   }
   else{
      return false;

   }

   }
  
  public function work_order_list_num()
  {
   return $this->db->get('tms_work_order')->num_rows();
  }
  public function get_work_order($limit,$offset)
  {
        $this->db->limit($limit,$offset);     
		$this->db->order_by('tms_work_order.order_date', 'DESC');
   		return $this->db->get('tms_work_order')->result_array();
  }
   
  public function grab_work_order($id)
  {
    return $this->db->get_where('tms_work_order',array('id' => $id))->row_array();
  }


   public function update_work_order()
   {
    
    $data=array(
      'client_name' => $this->input->post('client_name'),
      'order_id' => $this->input->post('order_id'),
      'description' => $this->input->post('description'),
      'quantity' => $this->input->post('quantity'),
      'unit_price' => $this->input->post('unit_price'),
      'total_price' => $this->input->post('total_price'),
      'order_date' => date('Y-m-d',strtotime($this->input->post('order_date'))),
      'delivery_date' => date('Y-m-d',strtotime($this->input->post('delivery_date'))),

      );
      if($this->input->post('client_name') == "BAT"){
		$data['client_type']='1';
      }
      else{
	$data['client_type']='2';
      }

     $this->db->where('id',$this->input->post('id'));
     $this->db->update('tms_work_order',$data);
     //echo $this->db->_error_message();
     if($this->db->affected_rows()>0){
        return true;
     }
     else{
         return false;

     }

  }

   public function delete_work_order($id){
      
     $this->db->where('id',$id);
     $this->db->delete('tms_work_order');
       if($this->db->affected_rows()>0){
          return true;
       }
       else{
           return false;

       }

   }
   
   public function fetch_trips($id,$table){
      $this->db->select('*,'.$table.'.id as trip_id');
      $this->db->from($table);
      $this->db->join('tms_trip_fare as ttf','ttf.id='.$table.'.trip_fare_id');
      $this->db->join('tms_truck_info as tti','tti.truck_id='.$table.'.truck_id');
      $this->db->where($table.".work_order",$id);
      return $this->db->get()->result_array();
      // $this->db->_error_message();
      
      
   }
   
   public function fetch_payment_info($id){
      
      $this->db->select_sum('paid_amount');
      $this->db->from('tms_work_order_payment_info');
      $this->db->where('work_order',$id);
      $q=$this->db->get();
      if($q->num_rows() >0){
	 return $q->row_array();
      }
      else{
	  return $id=0;
      }
      
   }
  
   public function work_order($id){
     return $this->db->get_where('tms_work_order',array('id' =>$id))->row_array();
   }
   
   public function insert_payment(){
      $data=array(
		  'work_order' => $this->input->post('work_order'),
		  'paid_amount' => $this->input->post('amount'),
		  'date' => date('Y-m-d',time()),
		  );
      $this->db->insert('tms_work_order_payment_info',$data);
      $amount=$this->input->post("amount");
      $sql="update tms_main_account set amount=amount+'$amount' where type='3' ";
      $this->db->query($sql);
      if($this->db->affected_rows()>0){
	 return true;
      }
      else{
	 return false;
      }
     
   }
   
   
   public function payment_list($id){
      
      return $this->db->get_where('tms_work_order_payment_info',array('work_order' => $id))->result_array();
      
   }
   
   public function edit_payment_info($id){
      
      return $this->db->get_where('tms_work_order_payment_info',array('id' =>$id))->row_array();
      
   }
   
   public function update_payment($change,$data,$id){
      
      $this->db->where('id',$id);
      $this->db->update('tms_work_order_payment_info',$data);
      
      $sql="update tms_main_account set amount=amount + '$change' where type='3' ";
      $this->db->query($sql);
      if($this->db->affected_rows()>0){
	 return true;
      }
      else{
	 return false;
      }
      
   }
   
   public function delete_payment($id){
       $q=$this->db->get_where('tms_work_order_payment_info',array('id' =>$id))->row_array();
       $amount=$q['paid_amount'];
      $sql="update tms_main_account set amount=amount - '$change' where type='3' ";
     
       $this->db->trans_start();
         $this->db->query($sql);   
       $this->db->trans_complete();
       
       if ($this->db->trans_status() === TRUE)
	 {
	    $this->db->delete('tms_work_order_payment_info', array('id' => $id)); 
	 }
	 
	 if($this->db->affected_rows() >0){
	    return true;
	 }
	 else{
	    return false;
	 }
     
      
      
   }
   

}

?>