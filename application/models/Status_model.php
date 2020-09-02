 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	function select_barcode($value,$clm,$table){
      $this->db->select();
      $this->db->from($table);
      $this->db->where($clm,$value);
      $query = $this->db->get();
      $query = $query->row();
      return $query;
  }
  function select_obc_barcode($value,$clm,$table){
      $this->db->select();
      $this->db->from($table);
      $this->db->where($clm,$value);
      $query = $this->db->get();
      $query = $query->row();
      return $query;
  }
  function select_pbc_barcode($value,$clm,$table){
      $this->db->select('fabric_stock_received.*,fabric.fabricName');
      $this->db->from($table);
      $this->db->where($clm,$value);
      $this->db->join("fabric", 'fabric.id=fabric_stock_received.fabric_id');
      $query = $this->db->get();
      $query = $query->row();
      return $query;
  }

  public function transaction_list($data)
  {
    $this->db->select('transaction.*,transaction_meta.order_barcode,sub1.subDeptName as from,sub2.subDeptName	 as to');
    $this->db->from('transaction');
    $this->db->where('transaction_meta.order_barcode',$data);
    $this->db->join("transaction_meta", 'transaction_meta.transaction_id=transaction.transaction_id');
    $this->db->join("sub_department sub1", 'sub1.id=transaction.from_godown');
    $this->db->join("sub_department sub2", 'sub2.id=transaction.to_godown');
    $rec = $this->db->get();
    //print_r($this->db->last_query());exit;
    return $rec->result_array();

  }
  public function orderproduct_list($data)
  {
    $this->db->select('order_product.order_barcode');
    $this->db->from('order_product');
    $this->db->where('order_product.pbc',$data);
    $rec = $this->db->get();
    //print_r($this->db->last_query());exit;
    return $rec->row();

  }

}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
