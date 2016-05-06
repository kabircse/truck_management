<?php 
class Driver_model extends CI_Model{
	
   public function get_drivers($limit,$offset){
      $this->db->limit($limit,$offset);
    $res=$this->db->get('drivers');
    return $res->result_array();

  }

  public function driver_check($id){

     $this->db->where('id', $this->input->post('id'));
     $this->db->where_not_in('id',$id);
     $res=$this->db->get('drivers');
     if($res->num_rows() == 0){
      return true;

     }
     else{
     	return false; 
     }

  }
  

 public function driver_list_num(){
   
   return $this->db->get('drivers')->num_rows();
 }

  public function insert_driver_info($img){

    $data=array(
            'name' =>$this->input->post('name'),
            'id' => $this->input->post('id'),
            'phone_no' =>$this->input->post('phn_number'),
            'address' =>$this->input->post('address'),
            'image_link' =>"drivers/".$img,
            'insert_date' =>time(),
            'last_update' =>time(),

      	  );

      $this->db->insert('drivers',$data); 
     if($this->db->affected_rows() >0){
      return true;

     }

  }
  
  public function update_driver($img=""){

    $data=array(
            'name' =>$this->input->post('name'),
            'id' => $this->input->post('id'),
            'phone_no' =>$this->input->post('phn_number'),
            'address' =>$this->input->post('address'),
            'last_update' =>time(),
          );
       if($img){
        $data['image_link']="drivers/".$img;
       }


      $this->db->where('id', $this->input->post('old_id'));
      $this->db->update('drivers',$data); 
     if($this->db->affected_rows() >0){
      return true;

     }

  }

  public function grab__driver($id){

   return $this->db->get_where('drivers',array('id' =>$id))->row_array();


  }


  public function delete_driver($id){
      
     $this->db->where('id',$id);
     $this->db->delete('drivers');
       if($this->db->affected_rows()>0){
          return true;
       }
       else{
           return false;

       }

   }

}

?>