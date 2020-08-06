<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {


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
    return  $this->db->update($table,$action);
        
        
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
   $this->db->select('sub_department.id as id,sub_department.subDeptName as godown,job_work_type.type as job');
   $this->db->from('job_work_party');
    $this->db->join('sub_department ','sub_department.id=job_work_party.subDeptName','inner');
     $this->db->join('job_work_type','job_work_type.id=job_work_party.job_work_type','left');
		  
   $this->db->where('job_work_party.id',$id);
   
   $query = $this->db->get();
    return $query->result_array();
   
 }
  public function check_obc_by_trans_id($obc, $trans_id)
  {
    
    $this->db->select('trans_meta_id');
    $this->db->from('transaction_meta');
    $this->db->where('order_barcode', $obc);
    $this->db->where('transaction_id', $trans_id);
    $query = $this->db->get();
    
    return $query->row();
  }
  
public function get($col,$godown,$type)
 {
   $this->db->select("transaction.*,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
   $this->db->from('transaction');
    $this->db->where('transaction_type', $type);
    $this->db->where($col, $godown);
     $this->db->join('sub_department sb1','sb1.id=transaction.from_godown  ','left');
 $this->db->join('sub_department sb2','sb2.id=transaction.to_godown  ','left');
     $this->db->order_by('created_at','desc');
   $query = $this->db->get();
    return $query->result_array();
    
   
 }
  public function get_stock($data)
  {
    $this->db->select("godown_stock_view.*,fabric.fabricCode");
    $this->db->from('godown_stock_view');
    $this->db->join('fabric', 'fabric.fabricName=godown_stock_view.fabric_name', 'inner');
    if (isset($data['id'])) {
      $this->db->where('trans_meta_id', $data['id']);
    }
     if (isset($data['godown'])) {
      $data=$data['godown'];   
     }
    $this->db->where('to_godown', $data);
    $query = $this->db->get();
    //print_r($this->db->last_query());
    return $query->result_array();
  }
  public function get_stock_by_obc($data)
  {
    $this->db->select(" transaction_meta.trans_meta_id AS trans_meta_id,
    transaction.challan_out AS challan_out,
    transaction.from_godown AS from_godown,
    transaction.to_godown AS to_godown,
    transaction.status AS status,
    order_view.order_number AS order_number,
    order_view.order_date AS order_date,
    order_view.unit AS unit,
    order_view.quantity AS quantity,
    order_view.order_barcode AS order_barcode,
    order_view.image AS image,
    order_view.fabric_name AS fabric_name,
    order_view.design_name AS design_name,
    order_view.dye AS dye`,
    order_view.pbc AS pbc,
    order_view.hsn AS hsn,
    order_view.design_code AS design_code,
    order_view.design_barcode AS design_barcode,
    transaction_meta.finish_qty AS finish_qty,
    transaction_meta.is_tc AS is_tc,
    transaction_meta.stat AS stat,
    order_view.matching AS matching,
    fabric.fabricCode as fabricCode");
    $this->db->from('transaction_meta');
    $this->db->where("transaction.to_godown", $data['godown']);
    $this->db->where("transaction.transaction_type", 'challan');
    $this->db->where("transaction_meta.order_barcode", $data['barcode']);
    $this->db->join('order_view', 'order_view.order_barcode=transaction_meta.order_barcode', 'inner');
    $this->db->join('transaction', 'transaction.transaction_id=transaction_meta.transaction_id', 'inner');
    $this->db->join('fabric', 'fabric.fabricName=order_view.fabric_name', 'inner');
    $this->db->order_by("transaction_meta.trans_meta_id", "desc");
    $this->db->limit(1);

    $query = $this->db->get(); //echo"<pre>"; print_r($query);exit;
    $query = $query->result_array();
    return $query;
  }
  public function get_tc_stock($data)
  {
    $this->db->select("godown_tc_view.*,fabric.fabricCode");
    $this->db->from('godown_tc_view');
    $this->db->join('fabric', 'fabric.fabricName=godown_tc_view.fabric_name', 'inner');
    if (isset($data['id'])) {
      $this->db->where('trans_meta_id', $data['id']);
    }
    if (isset($data['godown'])) {
      $data = $data['godown'];
    }
    $this->db->where('from_godown', $data);
    $query = $this->db->get();
   // print_r($this->db->last_query());
    return $query->result_array();
  }
  
   public function get_plain_stock($data)
  {
    $this->db->select("*");
    $this->db->from('plain_godown_stock');
    $this->db->where('godown', $data);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_distinct_plain_godown()
  {
    $this->db->select("distinct(godownid)");
    $this->db->from('fabric_stock_view');
    
    $query = $this->db->get();
    return $query->result_array();
  }
   public function get_frc_stock($data)
  {
    $this->db->select("*");
    $this->db->from('fabric_stock_view');
     $this->db->where('godownid', $data);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_dispatch($data)
  {
    $this->db->select("dispatch_view.*,fabric.fabricCode,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
    $this->db->from('dispatch_view');
    $this->db->join('fabric', 'fabric.fabricName=dispatch_view.fabric_name', 'inner');
 $this->db->join('sub_department sb1','sb1.id=dispatch_view.from_godown  ','left');
 $this->db->join('sub_department sb2','sb2.id=dispatch_view.to_godown  ','left');
    if (isset($data['id'])) {
      $this->db->where('trans_meta_id', $data['id']);
     
    }else{
      $this->db->where('transaction_id', $data);
     
    }
  $this->db->order_by('trans_meta_id','asc');
    $query = $this->db->get();
    return $query->result_array();
    
    
  }
public function view_tc($data)
  {
    $this->db->select("godown_tc_view.*,fabric.fabricCode,sb1.subDeptName as sub1");
    $this->db->from('godown_tc_view');
    $this->db->join('fabric', 'fabric.fabricName=godown_tc_view.fabric_name', 'inner');
 $this->db->join('sub_department sb1','sb1.id=godown_tc_view.from_godown  ','left');
    if (isset($data['id'])) {
      $this->db->where('trans_meta_id', $data['id']);
     
    }else{
      $this->db->where('transaction_id', $data);
     
    }
  $this->db->order_by('trans_meta_id','asc');
    $query = $this->db->get();
    return $query->result_array();
    
    
  }
  public function get_godown_by_id($godown)
  {
    $this->db->select("*");
    $this->db->from('sub_department');

    $this->db->where('id', $godown);
    $query = $this->db->get();
   // print_r($query->num_rows());exit;
    if($query->num_rows()>0){
    return $query->row()->subDeptName;
    }else{
        return null;
        
    }
  }
  public function get_jobwork_by_id($godown)
  {
    $this->db->select("*");
    $this->db->from('job_work_party');

    $this->db->where('subDeptName', $godown);
    $query = $this->db->get();
    if($query->num_rows()>0){
    return $query->row()->id;
    }else{
        return null;
        
    }
  }
  public function get_by_id($id)
  {
    $this->db->select("*");
    $this->db->from('transaction_meta');

    $this->db->where("transaction_id", $id);
    $this->db->join('order_view', 'order_view.order_barcode=transaction_meta.order_barcode', 'inner');

   
    $query = $this->db->get(); //echo"<pre>"; print_r($query);exit;
    $query = $query->result_array();
    return $query;
  }
  public function get_trans_by_id($id)
  {
    $this->db->select("transaction.*,sb1.subDeptName as sub1,sb2.subDeptName as sub2");
    $this->db->from('transaction');

    $this->db->where("transaction_id", $id);
    $this->db->join('sub_department sb1','sb1.id=transaction.from_godown  ','left');
 $this->db->join('sub_department sb2','sb2.id=transaction.to_godown  ','left');

    $query = $this->db->get(); //echo"<pre>"; print_r($query);exit;
    $query = $query->result_array();
    return $query;
  }
  public function getId($col,$id,$type)
  {
    $this->db->select('Max(counter) as count');
    $this->db->from("transaction");
    $this->db->where($col, $id);
    $this->db->where("transaction_type", $type);
    $rec = $this->db->get();
    //  print_r($rec);exit;
    return $rec->result_array();
  }
   public function get_tc($id)
  {
    $this->db->select("godown_stock_view.*,fabric.fabricCode");
    $this->db->from('godown_stock_view');
    $this->db->join('fabric', 'fabric.fabricName=godown_stock_view.fabric_name', 'inner');
  
    $this->db->where('to_godown', $id);
    $this->db->where('finish_qty !=', 0);
    $this->db->where('is_tc', 0);
    $query = $this->db->get();
    //print_r($this->db->last_query());
    return $query->result_array();
  }
  public function getOrderDetails($data)
  {
    $this->db->select("godown_stock_view.*,fabric.fabricCode");
    $this->db->from('godown_stock_view');
    $this->db->join('fabric', 'fabric.fabricName=godown_stock_view.fabric_name', 'inner');
   
      $this->db->where('order_barcode', $data['obc']);
    $this->db->where('stat', 'recieved');
    $this->db->where('to_godown', $data['godown']);
    $rec = $this->db->get();
    //print_r($this->db->last_query());
    return $rec->result_array();
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
public function getOBC_deatils($id)
 {
   $this->db->select('order_table.order_number,order_table.order_date,order_product.unit,order_product.quantity,order_product.fabric_name,order_product.hsn,order_product.design_name,order_product.dye,order_product.matching,order_product.design_code,order_product.remark,order_product.image	');
   $this->db->from("order_product");
   $this->db->join('order_table','order_table.order_id=order_product.order_id','inner');
   $this->db->where("product_order_id",$id );
   $rec=$this->db->get();
   return $rec->result_array();
 

 } 
 public function getPBC()
 {
   $this->db->select('parent_barcode');
   $this->db->from("fabric_stock_received");
  
   
   $rec=$this->db->get();
   return $rec->result_array();
 

 } 

}


?>
