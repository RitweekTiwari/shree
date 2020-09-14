<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DyeTransaction_model extends CI_Model
{


  public function insert($data, $table)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  function edit_option($action, $id, $table)
  {
    $this->db->where('id', $id);
    $this->db->update($table, $action);
    return;
  }
  function update($action, $id, $column, $table)
  {
    $this->db->where($id, $column);
    $this->db->update($table, $action);
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
    $this->db->where('id', $id);
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
  public function get_by_id($id)
  {
    $this->db->select("transaction_meta.*,fsr.current_stock,fsr.stock_unit,fsr.current_stock,fabric.fabricName,fabric.fabHsnCode as hsn");
    $this->db->from('transaction_meta');

    $this->db->where("transaction_meta.transaction_id", $id);
    $this->db->join('fabric_stock_received fsr', 'fsr.parent_barcode=transaction_meta.order_barcode', 'inner');
    $this->db->join('fabric', 'fsr.fabric_id=fabric.id', 'inner');
    $this->db->order_by('trans_meta_id', 'asc');

    $query = $this->db->get(); //echo"<pre>"; print_r($query);exit;
    $query = $query->result_array();
    return $query;
  }
  public function get_stock($data)
  {
    $this->db->select("dye_godown_stock.*");
    $this->db->from('dye_godown_stock');
    if (isset($data['from']) && isset($data['to'])) {
      if ($data['from'] == $data['to']) {
        $this->db->where('created_date ', $data['from']);
      } else {
        $this->db->where('created_date >=', $data['from']);
        $this->db->where('created_date <=', $data['to']);
      }
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
    if (isset($data['id'])) {
      $this->db->where('trans_meta_id', $data['id']);
    }
   
    $this->db->where('to_godown', $data['godownid']);


    $this->db->where('stat', 'recieved');
    $query = $this->db->get();
    //print_r($this->db->last_query());exit;
    return $query->result_array();
  }
  public function edit($id, $data)
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
    $this->db->join('branch_detail', 'branch_detail.id=fabric_challan.challan_to', 'inner');
    $this->db->join('unit', 'unit.id=fabric_challan.unit', 'inner');
    $rec = $this->db->get();
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

    $this->db->join('branch_detail', 'branch_detail.id=fabric_challan.challan_to', 'inner');
    $this->db->join('unit', 'unit.id=fabric_challan.unit', 'inner');
    $rec = $this->db->get();
    //  print_r($rec);
    //  print_r($this->db->last_query());
    return $rec->result_array();
    // print_r($searchValue);


  }

  public function select($table)
  {
    $this->db->select('*');
    $this->db->from($table);

    $rec = $this->db->get();
    return $rec->result_array();
  }
  public function getPBC_deatils($id, $godown)
  {
    $this->db->select('stock_unit,fabricName,hsn,current_stock,created_date,color_name');
    $this->db->from("fabric_stock_view");
    $this->db->where("parent_barcode", $id);
    $this->db->where("godownid", $godown);
    $rec = $this->db->get();
    //pre($this->db->last_query());exit;
    if ($rec->num_rows() >= 1) {
      return $rec->result_array();
    } else {
      return 0;
    }
  }
  public function getPBC_order_deatils($id, $godown)
  {
    $this->db->select('trans_meta_id,stock_unit,fabricName,hsn,current_stock,created_date');
    $this->db->from("dye_godown_stock");
    $this->db->where("order_barcode", $id);
    $this->db->where("to_godown", $godown);
    $rec = $this->db->get();
    //pre($this->db->last_query());exit;
    if ($rec->num_rows() >= 1) {
      return $rec->result_array();
    } else {
      return 0;
    }
  }
}
