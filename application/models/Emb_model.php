<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emb_model extends CI_Model {

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

 public function get_emb()
 {
   $this->db->select('*');
   $this->db->from('emb');

   $this->db->order_by('id','desc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_embmeta($id)
 {
   $this->db->select('embmeta.*,job_work_party.name');
   $this->db->from('embmeta');
   $this->db->where('embmeta.embid',$id);

    $this->db->join('job_work_party', 'job_work_party.id=embmeta.workerName', 'inner');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
  public function get_design_fresh_value()
 {
   $this->db->select('*');
   $this->db->from('design');
   $this->db->where('designCode IS NULL');
   $this->db->where('rate IS NULL');

   $query = $this->db->get();
//   echo $this->db->last_query();exit;
   $query = $query->result_array();
   return $query;
 }
public function get_design_name()
 {
   $this->db->select('distinct(designName),id');
   $this->db->from('design');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_erc_design_name()
  {
    $this->db->select('*');
    $this->db->from('erc');
    $query = $this->db->get();
    $query = $query->result_array();
    return $query;
  }
  public function embRate($desName)
	{
		$this->db->select('rate');
		$this->db->where('desName', $desName);
    $rec=$this->db->get('erc');
      //echo $this->db->last_query($rec);exit;
		return $rec->row();
	}
 public function update($id,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('metaid', $id);
   $this->db->update('embmeta', $data);
   return true;
 }



 public function get_emb_name($designName,$workerName)
 {
   $this->db->select('designName,workerName');
   $this->db->from('emb');
   $this->db->where('designName', $designName);
   $this->db->where('workerName', $workerName);
   // $this->db->like($designName,$workerName);
   $query = $this->db->get();
   //echo $this->db->last_query();exit;
   if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
   //echo $this->db->last_query();exit;

 }
 public function get_erc_value()
 {
   $this->db->select('*');
   $this->db->from('erc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
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

  public function get_worker_name()
 {
   $this->db->select('name,job_work_party.id as id');
   $this->db->from('job_work_party');
   $this->db->like('job_work_type.type','EMB WORK');
   $this->db->join('job_work_type','job_work_type.id=job_work_party.job_work_type','inner');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_erc_fresh_value()
{
  $sql = 'SELECT id,desName,rate FROM erc
WHERE id NOT IN(SELECT designName FROM emb)
';

  $query = $this->db->query($sql);
//  echo $this->db->last_query($query);exit;
  $query = $query->result_array();
  return $query;
}

 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('emb');
 }
 public function delete_emeta($id)
 {
   $this->db->where('metaid', $id);
     $this->db->delete('embmeta');
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
