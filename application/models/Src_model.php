<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Src_model extends CI_Model {

      public function insert($data,$table){
      $this->db->insert($table,$data);
      return $this->db->insert_id();
    }

    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }

 public function add($data)
 {
   $query=$this->db->insert('fabric', $data);
   return $query->insert_id();
 }

public function update($id,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('id', $id);
   $this->db->update('src', $data);
   return true;
 }
  public function update_by_col( $data)
  {
    
    $this->db->where('fabric', $data['fabric']);
    $this->db->where('code', $data['code']);
    $this->db->where('grade', $data['grade']);
    return $this->db->update('src', array('rate'=> $data['rate']));
     
  }
  public function update_fabric_rate($data)
  {
    $this->db->where('id', $data['fabric']);
   
    return $this->db->update('fabric', array('code_rate'=>$data['code_rate']));
  } 

 public function get_fabric_fresh_value()
 {
   $this->db->select('id,fabricName,code_rate');
   $this->db->from('fabric');


   $query = $this->db->get();
//   echo $this->db->last_query();exit;
   $query = $query->result_array();
   return $query;
 }

  
  public function get_percent($data)
  {
    $this->db->select('gprecent_meta.grade,gprecent_meta.percent');
    $this->db->from('gpercent');
    $this->db->join('gprecent_meta', 'gprecent_meta.percentId=gpercent.id');
      $this->db->where('gpercent.fabric', $data);
   
    $query = $this->db->get();
    // echo $query->num_rows();
    // exit;
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return 0;
    }
  }
  public function get_src_by_col($data)
  {
    $this->db->select('*');
    $this->db->from('src');
    foreach($data as $row){
      $this->db->where($row['name'], $row['value']);
    }
    
    $query = $this->db->get();
    // echo $query->num_rows();
    // exit;
    if($query->num_rows()>0){
      return $query->result_array();
    }
    else{
      return 0;
    }
    
  }
  public function check_src($data)
  {
    $this->db->select('*');
    $this->db->from('src');
    foreach ($data as $row) {
      $this->db->where($row['name'], $row['value']);
    }

    $query = $this->db->get();
    // echo $this->db->last_query();
    
    if ($query->num_rows() == 1) {
      return 1;
    } else {
      return 0;
    }
  }
  public function change_src($fab,$op,$rate)
  {
    $r= 'rate '.$op." ". $rate;
    $this->db->set('rate', $r, FALSE);
    $this->db->where('fabric', $fab);
  return  $this->db->update('src');
    //echo $this->db->last_query();exit;
  }
  
  public function get_fabric_count()
  {
    $sql = "SELECT `fabric`,count(`fabric`) as count FROM `src` GROUP by `fabric`";
    $result = $this->db->query($sql);
    return $result->result_array();
  }
 public function get_src()
 {
    $sql = "SELECT src.id,src.fabric, fabric.fabricName, fabric_code.fbcode, GROUP_CONCAT(grade.grade) AS grade, GROUP_CONCAT(src.rate) AS rate, src.created_at FROM src Join fabric ON fabric.id=src.fabric Join fabric_code on fabric_code.id=src.code Join grade on grade.id=src.grade GROUP BY src.fabric,src.code HAVING src.fabric IN (SELECT src.fabric From src GROUP BY src.fabric)";
    $result = $this->db->query($sql);
    return $result->result();
 }
public function get_fabric_name()
 {
   $this->db->select('distinct(fabricName)');
   $this->db->from('fabric');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function getfabricRate($id)
 {
   $this->db->select('purchase_rate');
   $this->db->from('fabric_stock_received');
    $this->db->where('fabric_id', $id);
    $this->db->order_by('fsr_id', 'desc');
    $this->db->limit(2);
   $query = $this->db->get();
   
   $query = $query->result();
    //echo $this->db->last_query();exit;
   return $query;
 }
public function get_fab_name_value()
 {
   $this->db->select('fabName,fabCode');
   $this->db->from('src');
   $this->db->order_by('updated_at','desc');
   $query = $this->db->get();
   $query = $query->row();
   return $query;
 }

 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('fabric');
 }
 public function search($searchByCat,$searchValue)
 {
   $this->db->select('*');
   $this->db->from('fabric');
   $this->db->like($searchByCat, $searchValue);
   $rec=$this->db->get();
   return $rec->result_array();
   // print_r($searchValue);
   // print_r($this->db->last_query());
 }
 public function get_SRC_set_exist($data)
 {
   $this->db->select('id');
   $this->db->from('src');
   $this->db->where('fabName',$data['fabName']);
   $this->db->where('fabCode',$data['fabCode']);
   $query = $this->db->get();
   if($query->num_rows()>=1) {
       return true;
   }else{
       return false;
   }
 }




}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
?>
