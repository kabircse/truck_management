<?php 

class Trip_model extends CI_Model{

  public function get_points(){

   return $this->db->get('start_end_point')->result_array();


  }	

  public function insert_point(){
   $data=array(
      'points_name' => $this->input->post('point_name'),
   	);

   $this->db->insert('start_end_point',$data);

	    if($this->db->affected_rows() >0){
	       return true;
	    } 
	    else{

	       return false;
	    }


  }

  public function grab_point($id){

  	return $this->db->get_where('start_end_point',array('id' => $id))->row_array();
  }


   public function update_point(){
	 $data=array(
    'points_name' => $this->input->post('point_name')
   	);
    $this->db->where('id',$this->input->post('id'));
    $this->db->update('start_end_point',$data);
    echo $this->db->_error_message();

    if($this->db->affected_rows() >0){
     
      return true;
    }
    else{
    	 return false;

    }
  }
  public function delete_point($data){
    
    $this->db->delete('start_end_point',$data);
    if($this->db->affected_rows()>0){
      return true;
    }
    
  }
  public function insert_transport_goods(){

   $data=array(

    'goods_name' => $this->input->post('goods_name')
   	);

    $this->db->insert('transport_goods_category',$data);

    if($this->db->affected_rows() >0){
     
      return true;
    }
    else{
    	 return false;

    }


  }

 
  
  public function get_goods($id){

   return $this->db->get_where('transport_goods_category',array('id' => $id))->row_array();

  }
  public function update_transport_goods(){

   $data=array(

    'goods_name' => $this->input->post('goods_name')
   	);
    $this->db->where('id',$this->input->post('id'));
    $this->db->update('transport_goods_category',$data);

    if($this->db->affected_rows() >0){
     
      return true;
    }
    else{
    	 return false;

    }


  }

  public function get_end_points(){

  	 $this->db->where('id !=',$this->input->post('start'));
     return $this->db->get('start_end_point')->result_array();



  }

  public function transport_goods_list_num(){
    return $this->db->get('transport_goods_category')->num_rows();
  }
  public function grab_goods($limit,$offset){
           $this->db->limit($limit,$offset);
    return $this->db->get('transport_goods_category')->result_array();

  }
  public function grab_all_goods(){
        
    return $this->db->get('transport_goods_category')->result_array();

  }
  
  public function delete_transport_goods($id){
    
    $this->db->delete('transport_goods_category',array('id' => $id));
    if($this->db->affected_rows() >0){
      return true;
    }
    
  }


  public function insert_trip_fare(){

   $data=array(

     'start_point' => $this->input->post('start_point'),
     'end_point' => $this->input->post('end_point'),
     'goods' => $this->input->post('goods'),
     'st_load' => $this->input->post('st_load'),
     'fare' => $this->input->post('fixed_fare'),
     'extra_load_unit' => $this->input->post('extra_load'),
     'extra_load_charge' => $this->input->post('extra_charge'),
   	);

   $this->db->insert('tms_trip_fare',$data);

     if($this->db->affected_rows() >0){
     
      return true;
    }
    else{
    	 return false;

    }


  }
  
  public function update_trip_fare($data,$id){
    $this->db->where('id',$id);
    $this->db->update('tms_trip_fare',$data);

     if($this->db->affected_rows() >0){
     
      return true;
    }
    else{
    	 return false;

    }
    
  }

  public function grab_trip_fare($id){

   return $this->db->get_where('tms_trip_fare',array('id'=>$id))->row_array();

  }
  public function total_fare_list_num(){
           
    return $this->db->get('tms_trip_fare')->num_rows();
  }

  public function get_trips($limit,$offset){

      $this->db->select('*,tms_trip_fare.id as trip_id,sep.points_name as sp,se.points_name as ep,');
      $this->db->from('tms_trip_fare');
      $this->db->join('start_end_point as sep', 'tms_trip_fare.start_point = sep.id');
      $this->db->join('start_end_point as se','tms_trip_fare.end_point = se.id');
      $this->db->join('transport_goods_category','tms_trip_fare.goods =transport_goods_category.id');
      $this->db->limit($limit,$offset);
      return $this->db->get()->result_array();

    //$sql="select * from tms_trip_fare ttf join start_end_point sep on ttf.start_point=sep.id inner join start_end_point se on ttf.end_point=se.id limit $limit offset $offset ";
    //$this->db->limit($limit,$offset);
   // return $this->db->query($sql)->result_array();
  }


  public function fetch_wrok_orders($id){

   return $this->db->get_where('tms_work_order',array('client_name' => $id))->result_array();

  }


  public function fetch_goods(){
      

       $this->db->select('*');
       $this->db->from('tms_trip_fare');
       $this->db->where('start_point',$this->input->post('sp'));
       $this->db->where('end_point',$this->input->post('ep'));
       $this->db->join('transport_goods_category','transport_goods_category.id=tms_trip_fare.goods');
       return $this->db->get()->result_array();
  }
  
  public function fetch_fare(){
       $this->db->select('*');
       $this->db->from('tms_trip_fare');
       $this->db->where('start_point',$this->input->post('sp'));
       $this->db->where('end_point',$this->input->post('ep'));
       $this->db->where('goods',$this->input->post('goods'));
       return $this->db->get()->row_array();
    
  }
  
  public function fetch_available_trucks(){
      $st=strtotime($this->input->post('sd').' '.$this->input->post('st'));
      $et=strtotime($this->input->post('ed').' '.$this->input->post('et'));
      $truck=$this->input->post('truck');
      /*$this->db->select('*,tms_truck_info.truck_id as tid');
      $this->db->from('tms_truck_info');
      $this->db->join('tms_truck_schedule as tts','tts.truck_id=tms_truck_info.truck_id','right outer');
      $this->db->where('tts.start_time not between "$st" and "$et" ');
      $this->db->where('tts.end_time not between "$st" and "$et" ');
      //return $this->db->get()->result_array();
     // return $st;*/
    
    
    $sql="select * from tms_truck_info where truck_id not in(select truck_id from tms_truck_schedule where start_time between '$st' and '$et' and end_time between '$st' and '$et') or truck_id ='$truck' ";
    return $this->db->query($sql)->result_array();
  }
  
  public function insert_bat_trip_(){
    $data=array(
		'start_point' => $this->input->post('start_point'),
		'end_point' => $this->input->post('end_point'),
		'goods' => $this->input->post('goods'),
		);
    $trip=$this->db->get_where('tms_trip_fare',$data)->row_array();
    $data=array(
		'start_date' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_date' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'work_order' => $this->input->post('work_order'),
		'truck_id' => $this->input->post('truck'),
		'trip_fare_id' => $trip['id'],
		'extra_weight' => $this->input->post('extra_weight'),
		'extra_fare' => $this->input->post('extra_fare'),
		'total_load' => $this->input->post('total_load'),
		'total_fare' => $this->input->post('total_fare'),
		'remarks' => $this->input->post('remarks'),
		'entry_date' => date('Y-m-d',strtotime($this->input->post('submit_date'))),
		'is_final' => '0'
		);
    $this->db->insert('tms_bat_trip',$data);
    
    
    $data=array(
		'truck_id' =>$this->input->post('truck'),
		'trip_id' => $this->db->insert_id(),
		'type' => '1',
		'work_order_id' =>$this->input->post('work_order'),
		'start_time' =>strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
		'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
		
		);
    $this->db->insert('tms_truck_schedule',$data);
    
      if($this->db->affected_rows()>0){
	return true;
      }
    
  }
  
  public function bat_trip_finalize($id){
    $time=time();
    $data=array(
		'end_date' => $time,
		'is_final' =>'1'
		);
    $this->db->where('id',$id);
    $this->db->update('tms_bat_trip',$data);
    
    $data=array(
		'end_time' => $time
		);
    	    
    $this->db->where('trip_id',$id);
    $this->db->update('tms_truck_schedule',$data);
    
    if($this->db->affected_rows()>0){
       return true;
    }
    
  }
  
  public function bat_trip_list($limit,$offset){
    $this->db->select('*,tms_bat_trip.id as trip_id');
    $this->db->from('tms_bat_trip');
    $this->db->join('tms_work_order as two','two.id=tms_bat_trip.work_order');
    $this->db->join('tms_truck_info as tti','tti.truck_id=tms_bat_trip.truck_id');
    $this->db->limit($limit,$offset);
    //$this->db->where('tms_bat_trip.is_final','1');
    return $this->db->get()->result_array();
    
    
  }
  
  public function total_bat_trip_num(){
    return $this->db->get('tms_bat_trip')->num_rows();
  }
  
  public function get_bat_trip($id){
    $this->db->select('*,tms_bat_trip.id as trip_id,tti.truck_id as tid,tgc.id as gid');
    $this->db->from('tms_bat_trip');
    $this->db->join('tms_work_order as two','two.id=tms_bat_trip.work_order');
    $this->db->join('tms_trip_fare as ttf','ttf.id=tms_bat_trip.trip_fare_id');
    $this->db->join('start_end_point sep','sep.id=ttf.start_point');
    $this->db->join('start_end_point ssep','ssep.id=ttf.end_point');
     $this->db->join('transport_goods_category tgc','tgc.id=ttf.goods');
    $this->db->join('tms_truck_info as tti','tti.truck_id=tms_bat_trip.truck_id');
    $this->db->where('tms_bat_trip.id',$id);
    return $this->db->get()->row_array();
    
    
  }
  
  
  public function update_bat_trip(){
    
  $data=array(
		'start_point' => $this->input->post('start_point'),
		'end_point' => $this->input->post('end_point'),
		'goods' => $this->input->post('goods'),
		);
    $trip=$this->db->get_where('tms_trip_fare',$data)->row_array();
    $data=array(
		'start_date' => strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_date' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'work_order' => $this->input->post('work_order'),
		'truck_id' => $this->input->post('truck'),
		'trip_fare_id' => $trip['id'],
		'extra_weight' => $this->input->post('extra_weight'),
		'extra_fare' => $this->input->post('extra_fare'),
		'total_load' => $this->input->post('total_load'),
		'total_fare' => $this->input->post('total_fare'),
		'remarks' => $this->input->post('remarks'),
		'entry_date' => date('Y-m-d',strtotime($this->input->post('submit_date'))),
		);
    $this->db->where('id',$this->input->post('id'));
    $this->db->update('tms_bat_trip',$data);
    
    $data=array(
		'truck_id' =>$this->input->post('truck'),
		'work_order_id' =>$this->input->post('work_order'),
		'start_time' =>strtotime($this->input->post('start_date').' '.$this->input->post('start_time')),
		'end_time' => strtotime($this->input->post('end_date').' '.$this->input->post('end_time')),
		'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
		'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
		
		);
    
    $this->db->where('trip_id',$this->input->post('id'));
    $this->db->update('tms_truck_schedule',$data);
    
      if(!$this->db->_error_message()){
	return true;
      }
      
    
    
  }
  
  
  public function delete_bat_trip($id){
    
    $this->db->delete('tms_bat_trip',array('id' => $id));
    $this->db->delete('tms_truck_schedule',array('trip_id' => $id));
    if($this->db->affected_rows()>0){
	return true;
      }
  }
  
  public function insert_general_trip($data){
    
     if($this->db->insert('tms_general_trip',$data)){
       return $this->db->insert_id();
     }
  }
  public function total_general_trip_list(){
    return $this->db->get('tms_general_trip')->num_rows();
  }
  public function get_general_trips($limit,$offset){
    $this->db->limit($limit,$offset);
    $this->db->select('*,tms_general_trip.id as trip_id');
    $this->db->from('tms_general_trip');
    $this->db->join('tms_truck_info as tti','tti.truck_id=tms_general_trip.truck_id');
    $this->db->join('tms_work_order as two','two.id=tms_general_trip.work_order_id');
    return $this->db->get()->result_array();
  
  
  }
  
  public function insert_truck_schedule($data){
    if($this->db->insert('tms_truck_schedule',$data)){
      return true;
    }
    
    
  }
  
  public function grab_general_trip($id){
    $this->db->select('*,tms_general_trip.id as trip_id,tti.truck_id as tid');
    $this->db->from('tms_general_trip');
    $this->db->join('tms_truck_info as tti','tti.truck_id=tms_general_trip.truck_id');
    $this->db->join('tms_work_order as two','two.id=tms_general_trip.work_order_id');
    $this->db->where('tms_general_trip.id',$id);
    return $this->db->get()->row_array();
  }
  
  public function update_general_trip($data,$id){
    $this->db->where('id',$id);
    if($this->db->update('tms_general_trip',$data)){
      return true;
    }
    
  }
  
  public function update_truck_schedule($data,$id){
    $this->db->where('trip_id',$id);
    if($this->db->update('tms_truck_schedule',$data)){
      return true;
    }
  }
 

}

?>