<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DyeTransaction_model extends CI_Model {


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
        return;
    }

 public function add($data)
 {
   $this->db->insert('fabric', $data);
 }

 public function get_fabric_name()
 {
   $this->db->select('id ,fabricType, fabricName, fabricCode');
   $this->db->from('fabric');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function get_godown($id)
 {
   $this->db->select('subDeptName,job_work_type');
   $this->db->from('job_work_party');
   $this->db->where('id',$id);
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function get($type)
 {
   $this->db->select("*");
   $this->db->from('dye_transaction');
   $this->db->where("transaction_type", $type);
  
 
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
   
 }

 public function edit($id,$data)
 {
   // print_r($data);
   // print_r($id);
   $this->db->where('id', $id);
   $this->db->update('fabric', $data);
   return true;
 }
 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('fda_table');
 }
 public function search($data)
 {
   $this->db->select('fabric_challan.fc_id,fabric_challan.challan_date,branch_detail.sort_name, fabric_challan.challan_no,fabric_challan.fabric_type, fabric_challan.total_quantity,unit.unitName,fabric_challan.total_amount');
   $this->db->from('fabric_challan');

   $this->db->like($data['cat'], $data['Value']);
   $this->db->where("challan_type", $data['type']);
    $this->db->join('branch_detail','branch_detail.id=fabric_challan.challan_to','inner');
 $this->db->join('unit','unit.id=fabric_challan.unit','inner');
   $rec=$this->db->get();
  //  print_r($rec);
  //  print_r($this->db->last_query());
   return $rec->result_array();
   // print_r($searchValue);
   

 }
 public function search_by_date($data)
 {
   $this->db->select('fabric_challan.fc_id,fabric_challan.challan_date,branch_detail.sort_name, fabric_challan.challan_no,fabric_challan.fabric_type, fabric_challan.total_quantity,unit.unitName,fabric_challan.total_amount');
   $this->db->from('fabric_challan');
   $this->db->where('fabric_challan.challan_date >=', $data['from']);
   $this->db->where('fabric_challan.challan_date <=', $data['to']);
    $this->db->where("challan_type", $data['type']);
   
    $this->db->join('branch_detail','branch_detail.id=fabric_challan.challan_to','inner');
 $this->db->join('unit','unit.id=fabric_challan.unit','inner');
   $rec=$this->db->get();
  //  print_r($rec);
  //  print_r($this->db->last_query());
   return $rec->result_array();
   // print_r($searchValue);
   

 }

public function select($table)
 {
   $this->db->select('*');
   $this->db->from($table);
   
   $rec=$this->db->get();
   return $rec->result_array();
 

 }
public function getPBC_deatils($id,$godown)
 {
   $this->db->select('stock_unit,fabricName,hsn,current_stock,created_date');
   $this->db->from("fabric_stock_view");
   $this->db->where("parent_barcode",$id);
    $this->db->where("godownid", $godown);
   $rec=$this->db->get();
    //pre($this->db->last_query());exit;
   if($rec->num_rows()>=1){
      return $rec->result_array();
   }else{
     return 0; 
   }
  
 

 } 
 

}


?>
