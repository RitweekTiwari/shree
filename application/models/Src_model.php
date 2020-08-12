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



 public function get_fabric_fresh_value()
 {
   $this->db->select('*');
   $this->db->from('fabric');
   $this->db->where('src',0);


   $query = $this->db->get();
//   echo $this->db->last_query();exit;
   $query = $query->result_array();
   return $query;
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
