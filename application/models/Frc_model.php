<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frc_model extends CI_Model {


      public function insert($data,$table){
      $this->db->insert($table,$data);
      return $this->db->insert_id();
    }

      function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }
    function update($action, $id,$column, $table){
        $this->db->where($id,$column);
        $this->db->update($table,$action);
    // print_r($this->db->last_query());
    // exit;
        return;
    }

 

 public function get_fabric_name()
 {
   $this->db->select('id ,fabricType, fabricName, fabricCode');
   $this->db->from('fabric');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }

public function get($data)
 {
   $this->db->select("fabric_challan.*,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
   $this->db->from('fabric_challan');
   $this->db->where("challan_type", $data['type']);
   if($data['from']==$data['to']){
    $this->db->where('fabric_challan.challan_date ', $data['from']); 
   }else{
    $this->db->where('fabric_challan.challan_date >=', $data['from']);
   $this->db->where('fabric_challan.challan_date <=', $data['to']);
   }
   $this->db->where('fabric_challan.deleted', 0); 
  $this->db->join('sub_department sb1','sb1.id=fabric_challan.challan_from  ','left');
 $this->db->join('sub_department sb2','sb2.id=fabric_challan.challan_to  ','left');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
   
 }
 public function get_summary($data)
 {
   
   $this->db->select("fabric_type as fabtype,sum(total_quantity) as qty,sum(total_amount) as amount,sum(total_tc) as tc");
   $this->db->from('fabric_challan');
   $this->db->where("challan_type", $data['type']);
   if($data['from']==$data['to']){
    $this->db->where('fabric_challan.challan_date ', $data['from']); 
   }else{
    $this->db->where('fabric_challan.challan_date >=', $data['from']);
   $this->db->where('fabric_challan.challan_date <=', $data['to']);
   }
   $this->db->where('fabric_challan.deleted', 0); 
  $this->db->group_by('fabric_type');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
   
 }
 public function get_frc_by_id($id)
 {
   $this->db->select("fabric_challan.*,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
   $this->db->from('fabric_challan');
   
   $this->db->where("fc_id", $id);
  $this->db->join('sub_department sb1','sb1.id=fabric_challan.challan_from  ','left');
  $this->db->join('sub_department sb2','sb2.id=fabric_challan.challan_to  ','left');
  $this->db->where('fabric_challan.deleted ', 0); 
    $query = $this->db->get();
    $query = $query->result_array();
    return $query;
   
 }
public function get_by_id($id)
 {
    $this->db->select('fabric_stock_received.fsr_id AS fsr_id,
    fabric_stock_received.parent_barcode AS parent_barcode,
    fabric_stock_received.parent AS parent,
    fabric_stock_received.fabric_type AS fabric_type,
    fabric.fabHsnCode AS hsn,
    fabric_stock_received.stock_quantity AS stock_quantity,
    fabric_stock_received.current_stock AS current_stock,
    fabric_stock_received.stock_unit AS stock_unit,
    fabric_stock_received.challan_no AS challan_no,
    fabric_stock_received.unit_id AS unit_id,
    fabric_stock_received.color_name AS color_name,
    fabric_stock_received.ad_no AS ad_no,
    fabric_stock_received.purchase_code AS purchase_code,
    fabric_stock_received.purchase_rate AS purchase_rate,
    fabric_stock_received.total_value AS total_value,
    fabric_stock_received.tc AS tc,
    fabric_stock_received.challan_type AS challan_type,
    fabric_stock_received.created_date AS created_date,
    fabric.fabricName AS fabricName,
 ');
    $this->db->from('fabric_stock_received');
    $this->db->join('fabric', 'fabric.id=fabric_stock_received.fabric_id', 'inner');
 
   $this->db->where("fabric_challan_id", $id);
   $this->db->where('fabric_stock_received.deleted', 0); 
 
 
   $query = $this->db->get();//echo"<pre>"; print_r($query);exit;
   $query = $query->result_array();
   return $query;
   
 }

 public function get_stock($data)
 {
   //pre($data);
   $this->db->select("*");
   
   
   $this->db->from('fabric_stock_view');
  
   if($data['from']==$data['to']){
    $this->db->where('created_date ', $data['from']); 
   }else{
    $this->db->where('created_date >=', $data['from']);
   $this->db->where('created_date <=', $data['to']);
   }
   if(isset($data['cat'])){
      if (!is_array($data['cat'])) {
        if ($data['cat'] != "") {
          $this->db->where($data['cat'], $data['Value']);
        }
      } else {
        $count = count($data['cat']);
        for ($i = 0; $i < $count; $i++) {
          $this->db->like($data['cat'][$i], $data['Value'][$i]);
        }
      }
   }
   
    if (isset($data['fabric']) ) {
      $this->db->where('fabricName', $data['fabric']);
    }
 $this->db->order_by('length(parent_barcode),parent_barcode'); 
   $query['data'] = $this->db->get();
    // echo"<pre>"; print_r($query);exit;
   $query['data'] = $query['data']->result_array();
   $this->db->select("fabric_type,fabricName,count(fabricName) as pcs,sum(current_stock) as qty,sum(total_value) as total");
   
   
   $this->db->from('fabric_stock_view');
    if (isset($data['cat'])) {
      if (!is_array($data['cat'])) {
        if ($data['cat'] != "") {
          $this->db->where($data['cat'], $data['Value']);
        }
      } else {
        $count = count($data['cat']);
        for ($i = 0; $i < $count; $i++) {
          $this->db->like($data['cat'][$i], $data['Value'][$i]);
        }
      }
    }
   if($data['from']==$data['to']){
    $this->db->where('created_date ', $data['from']); 
   }else{
    $this->db->where('created_date >=', $data['from']);
   $this->db->where('created_date <=', $data['to']);
   }
    if (isset($data['fabric'])) {
      $this->db->where('fabricName', $data['fabric']);
    }
 $this->db->group_by('fabric_type,fabricName');
   $query['summary'] = $this->db->get();
   $query['summary'] = $query['summary']->result_array();
  $this->db->select('distinct(fabric_type) as type');
  $this->db->from('fabric_stock_view');
  if($data['from']==$data['to']){
      $this->db->where('created_date ', $data['from']); 
    }else{
      $this->db->where('created_date >=', $data['from']);
    $this->db->where('created_date <=', $data['to']);
    }
    if (isset($data['cat'])) {
      if (!is_array($data['cat'])) {
        if ($data['cat'] != "") {
          $this->db->where($data['cat'], $data['Value']);
        }
      } else {
        $count = count($data['cat']);
        for ($i = 0; $i < $count; $i++) {
          $this->db->like($data['cat'][$i], $data['Value'][$i]);
        }
      }
    }
    if (isset($data['fabric'])) {
      $this->db->where('fabricName', $data['fabric']);
    }
      $query['type'] = $this->db->get();
    $query['type'] = $query['type']->result_array();
    return $query;
   
 }
 
  public function get_tc()
 {
   $this->db->select("*");
   $this->db->from('tc_view');
   
   $query = $this->db->get();
   //echo"<pre>"; print_r($query);exit;
   $query = $query->result_array();
   return $query;
   
 }
 public function tc_summary()
 {
   
   $this->db->select("fabric_type as fabtype, fabricName as fabric,sum(current_stock)  as qty, sum(tc) as tc ");
   $this->db->from('tc_view');
    
    $this->db->group_by('fabricName','fabric_type');
    
    
   $query = $this->db->get();
   //echo"<pre>"; print_r($query);exit;
   $query = $query->result_array();
   return $query;
   
 }

 
 public function search($data)
 {
   //echo"<pre>";	print_r( $data); exit;
                if($data['type']=="recieve" || $data['type']=="return" ){
                  $this->db->select("fabric_challan.*,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
                $this->db->from('fabric_challan');
                if(!is_array($data['cat']) ){
                  if($data['cat']!=""){
                    $this->db->where($data['cat'], $data['Value']);
                  }
                  
                }else{
                  $count =count($data['cat']);
                  for($i=0;$i<$count;$i++){
                    $this->db->like($data['cat'][$i], $data['Value'][$i]);
                  }
                }
                      if($data['from']==$data['to']){
                  $this->db->where('fabric_challan.challan_date ', $data['from']); 
                  }else{
                  $this->db->where('fabric_challan.challan_date >=', $data['from']);
                  $this->db->where('fabric_challan.challan_date <=', $data['to']);
                  }
                $this->db->where("challan_type", $data['type']);
                  $this->db->join('sub_department sb1','sb1.id=fabric_challan.challan_from  ','left');
                $this->db->join('sub_department sb2','sb2.id=fabric_challan.challan_to  ','left');
                $this->db->where('deleted ', 0);
                }elseif($data['type']=="stock"){
                  $this->db->select('*');
                $this->db->from('fabric_stock_view');
                if($data['from']==$data['to']){
                  $this->db->where('created_date ', $data['from']); 
                }else{
                  $this->db->where('created_date >=', $data['from']);
                $this->db->where('created_date <=', $data['to']);
                }
                if(!is_array($data['cat']) ){
                  if($data['cat']!=""){
                    $this->db->where($data['cat'], $data['Value']);
                  }
                  
                }else{
                  $count =count($data['cat']);
                  for($i=0;$i<$count;$i++){
                    $this->db->like($data['cat'][$i], $data['Value'][$i]);
                  }
                }
                if($data['from']==$data['to']){
                  $this->db->where('created_date ', $data['from']); 
                }else{
                  $this->db->where('created_date >=', $data['from']);
                $this->db->where('created_date <=', $data['to']);
                }
               
                }elseif($data['type']=="pbc"){
                  $this->db->select('*');
                $this->db->from('second_pbc_view');
                if(!is_array($data['cat']) ){
                  if($data['cat']!=""){
                    $this->db->where($data['cat'], $data['Value']);
                  }
                  
                }else{
                  $count =count($data['cat']);
                  for($i=0;$i<$count;$i++){
                    $this->db->like($data['cat'][$i], $data['Value'][$i]);
                  }
                }
                if($data['from']==$data['to']){
                  $this->db->where('created_date ', $data['from']); 
                }else{
                  $this->db->where('created_date >=', $data['from']);
                $this->db->where('created_date <=', $data['to']);
                }
                
                $this->db->order_by('parent_barcode'); 
                }elseif($data['type']=="tc") {
                  $this->db->select("*");
                $this->db->from('tc_view');
                 if(!is_array($data['cat']) ){
                  if($data['cat']!=""){
                    $this->db->where($data['cat'], $data['Value']);
                  }
                  
                }else{
                  $count =count($data['cat']);
                  for($i=0;$i<$count;$i++){
                    $this->db->like($data['cat'][$i], $data['Value'][$i]);
                  }
                }
              if($data['from']==$data['to']){
                  $this->db->where('created_date ', $data['from']); 
                }else{
                  $this->db->where('created_date >=', $data['from']);
                $this->db->where('created_date <=', $data['to']);
                }
                  $this->db->group_by('parent_barcode');
                  }
   
   $rec=$this->db->get();
 //print_r($this->db->last_query());exit;
   return $rec->result_array();
  
 }
 

public function select($table)
 {
   $this->db->select('*');
   $this->db->from($table);
   
   $rec=$this->db->get();
   return $rec->result_array();
 

 }
  public function get_fabric_recieve($id)
  {
    $this->db->select('*');
    $this->db->from('fabric_challan');
    $this->db->where('fc_id',$id);
    $this->db->join('sub_department','sub_department.id=fabric_challan.challan_from','inner');
    $this->db->where('deleted ', 0);
    $rec=$this->db->get();
    
    // print_r($this->db->last_query());
    return $rec->result_array();
  }
 public function select_PBC($data)
 {
   $this->db->select('*');
   $this->db->from('second_pbc_view');
    if ($data['from'] == $data['to']) {
      $this->db->where('created_date ', $data['from']);
    } else {
      $this->db->where('created_date >=', $data['from']);
      $this->db->where('created_date <=', $data['to']);
    }
   $rec=$this->db->get();
   //echo $this->db->last_query();exit;
   return $rec->result_array();
 

 }
  public function PBC_summary($data)
  {

    $this->db->select("fabricName,count(fabricName) as pcs,sum(current_stock) as qty,sum(tc) as tc");
    $this->db->from('second_pbc_view');

    $this->db->group_by('fabricName', 'fabric_type');

    if ($data['from'] == $data['to']) {
      $this->db->where('created_date ', $data['from']);
    } else {
      $this->db->where('created_date >=', $data['from']);
      $this->db->where('created_date <=', $data['to']);
    }
    $this->db->group_by('fabricName');
    $query = $this->db->get();
    //echo"<pre>"; print_r($query);exit;
    $query = $query->result_array();
    return $query;
  }

 public function select_PBC_by_id($pbc)
 {
   $this->db->select('*');
   $this->db->from('fabric_stock_received');
   $this->db->where("fsr_id",$pbc);
  $this->db->where('deleted ', 0);
   $rec=$this->db->get();
  //  echo $this->db->last_query();exit;
   return $rec->result_array();
 

 }
public function getPBC_deatils($id)
 {
   $this->db->select('*');
   $this->db->from("fabric_stock_received");
   $this->db->where("parent_barcode",$id);
   $this->db->where("isStock",1);
   $this->db->where('deleted ', 0);
   $this->db->join('fabric','fabric.id=fabric_stock_received.fabric_id','inner');
   $rec=$this->db->get(); 
   return $rec->result_array();
 

 }
 public function getPBC_by_godown($id,$from)
 {
   $this->db->select('*');
   $this->db->from("fabric_stock_received");
   $this->db->where("parent_barcode",$id);
   $this->db->where("isStock",1);
   $this->db->where("fc.challan_to",$from);
   $this->db->where('fabric_stock_received.deleted', 0);
   $this->db->join('fabric','fabric.id=fabric_stock_received.fabric_id','inner');
  $this->db->join('fabric_challan as fc','fc.fc_id=fabric_stock_received.fabric_challan_id','inner');
  $rec=$this->db->get(); 
//print_r($rec->result_array());exit;   
   return $rec->result_array();
 

 }
 public function getPBC_by_type($col,$id)
 {
   $this->db->select('*');
   $this->db->from("fabric_stock_received");
   $this->db->where($col,$id);
    $this->db->or_like($col, $id.'/');
   $this->db->where("isStock",1);
   $this->db->where('deleted ', 0);
   $this->db->join('fabric','fabric.id=fabric_stock_received.fabric_id','inner');
   $rec=$this->db->get();
    // echo $this->db->last_query();
    // exit;
   return $rec->result_array();
 

 }
public function getfabric_details($id)
 {
   $this->db->select('fabric.fabricType,fabric.fabHsnCode,hsn.unit');
   $this->db->from("fabric");
   $this->db->where("fabric.id",$id);
   $this->db->join('hsn','fabric.fabHsnCode=hsn.hsn_code','left');
   $rec=$this->db->get(); 
  //  print_r($rec);exit;
   return $rec->result_array();
 

 }	
public function getCount($type)
 {
   $this->db->select('Max(counter) as count');
   $this->db->from("fabric_stock_received");
   $this->db->where("challan_type",$type);
   $rec=$this->db->get(); 
  //  print_r($rec);exit;
   return $rec->result_array();
 

 }	
public function getId($type)
 {
   $this->db->select('Max(counter) as count');
   $this->db->from("fabric_challan");
    $this->db->where("challan_type", $type);
   $rec=$this->db->get(); 
  //  print_r($rec);exit;
   return $rec->result_array();
 

 }
 public function getCount_by_id($id)
 {
   $this->db->select('Max(counter) as count');
   $this->db->from("fabric_stock_received");
   $this->db->where("parent",$id);
   $this->db->where("isSecond",1);
   $rec=$this->db->get(); 
  //  print_r($rec);exit;
   return $rec->result_array();
 

 }

 public function get_parent_barcode($id)
  {
  $this->db->select('parent,tc');
   $this->db->from("fabric_stock_received");
   $this->db->where("fabric_challan_id",$id);
   $rec=$this->db->get(); 
  //  print_r($rec);exit;
   return $rec->result_array();
  }

  public function get_stock_value_by_id($id)
  {
    $this->db->select('fabric_stock_received.fsr_id AS fsr_id,
    fabric_stock_received.parent_barcode AS parent_barcode,
    fabric_stock_received.parent AS parent,
    fabric_stock_received.fabric_type AS fabric_type,
    fabric.fabHsnCode AS hsn,
    fabric_stock_received.stock_quantity AS stock_quantity,
    fabric_stock_received.current_stock AS current_stock,
    fabric_stock_received.stock_unit AS stock_unit,
    fabric_stock_received.challan_no AS challan_no,
    fabric_stock_received.unit_id AS unit_id,
    fabric_stock_received.color_name AS color_name,
    fabric_stock_received.ad_no AS ad_no,
    fabric_stock_received.purchase_code AS purchase_code,
    fabric_stock_received.purchase_rate AS purchase_rate,
    fabric_stock_received.total_value AS total_value,
    fabric_stock_received.tc AS tc,
    fabric_stock_received.challan_type AS challan_type,
    fabric_stock_received.created_date AS created_date,
    fabric.fabricName AS fabricName,
    sb1.subDeptName AS challan_from,
    sb2.subDeptName AS challan_to');
    $this->db->from('fabric_stock_received');
    $this->db->join('fabric','fabric.id=fabric_stock_received.fabric_id','inner');
    $this->db->join('fabric_challan as fc','fc.fc_id=fabric_stock_received.fabric_challan_id','inner');
    $this->db->join('sub_department sb1','sb1.id=fc.challan_from  ','left');
    $this->db->join('sub_department sb2','sb2.id=fc.challan_to  ','left');
    $this->db->where('fsr_id',$id);
    $this->db->where('fabric_stock_received.deleted ', 0);
    $rec=$this->db->get(); //print_r($rec);exit;
    return $rec->row();

  }
}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
