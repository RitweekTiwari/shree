<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erc_model extends CI_Model {

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
   $this->db->insert('fabric', $data);
 }

 public function get_design()
 {
   $this->db->select('id,desName,desCode,rate');
   $this->db->from('erc');
   $this->db->order_by('desName','ASC');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
  public function get_design_by_id($id)
  {
    $this->db->select('id,desName,desCode,rate');
    $this->db->from('erc');
    $this->db->where('id', $id);
    $query = $this->db->get();
    $query = $query->result_array();
    return $query;
  }
  public function get_design_fresh_value()
 {
   $sql = 'SELECT designName, stitch FROM design
WHERE designName NOT IN(SELECT desName FROM erc)
GROUP BY designName';

   $query = $this->db->query($sql);
   $query = $query->result_array();
   return $query;
 }
public function get_design_name()
 {
   $this->db->select('distinct(designName)');
   $this->db->from('design');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }

 public function update($id,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('id', $id);
   $this->db->update('erc', $data);
   return true;
 }

 public function Update_design($designName,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('designName', $designName);
   $this->db->update('design', $data);
   //echo $this->db->last_query();exit;
   return true;
 }

 public function get_erc_name($designName)
 {
   $this->db->select('desName');
   $this->db->from('erc');
   $this->db->where('desName', $designName);
   $query = $this->db->get();
  //  echo $this->db->last_query();exit;
   if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }


 }

 public function get_design_value()
 {
   $this->db->select('desName');
   $this->db->from('erc');
   $this->db->order_by('updated_at','desc');
   $query = $this->db->get();
   $query = $query->row();
   return $query;
 }

  public function get_src_fabcode_value()
 {
   $this->db->select('distinct(fabCode)');
   $this->db->from('src');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }

  public function get_ERC_set_exist($data)
 {
   $this->db->select('id');
   $this->db->from('erc');
   $this->db->where('desName',$data['desName']);
   $this->db->where('desCode',$data['desCode']);
   $query = $this->db->get();
   if($query->num_rows()>=1) {
       return true;
   }else{
       return false;
   }
 }

 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('erc');
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




}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
?>
