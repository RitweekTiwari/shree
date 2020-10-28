 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Segment_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('grade', $data);
	}
	public function get()
	{
    $this->db->select('id,fabricName');
    $this->db->order_by('id','DESC');
		$rec=$this->db->get('fabric');
		return $rec->result_array();

	}
  public function get_segmentdata($id)
  {
    $this->db->select('fabric_details.*,fabric.fabricName');
	$this->db->where('metaId',$id);
	$this->db->join('fabric', 'fabric_details.fabricId=fabric.id');
	$this->db->group_by("fabric_details.segmentName");

	$rec=$this->db->get('fabric_details');
	
    return $rec->result_array();

  }
		
		public function get_fabric_by_id($id)
		{
			$this->db->select('fabric.fabHsnCode,fabric.fabricType,hsn.unit');
			$this->db->where('fabric.id', $id);
			$this->db->join('hsn', 'fabric.fabHsnCode=hsn.hsn_code');
			$rec = $this->db->get('fabric');
			return $rec->result_array();
		}

		public function get_fabric($id="")
		{
			$this->db->select('id,fabricName as text');
			$this->db->where_like('fabricName', $id);
			$rec = $this->db->get('fabric');
			return $rec->result_array();
		}
		public function update_pbc($id,$data)
		{
			$this->db->where('parent_barcode', $id);
			return $this->db->update('fabric_stock_received', $data);
		}
		public function get_pbc_data($id)
		{
			$this->db->select('fabric_stock_received.*,fabric.fabricName');
			$this->db->where('parent_barcode', $id);
			$i=0;
		
			$this->db->join('fabric', 'fabric_stock_received.fabric_id=fabric.id');
			$rec = $this->db->get('fabric_stock_received');
			return $rec->result_array();
		}
		public function get_segment_data($id)
		{
			$this->db->select('*');
			$this->db->where('challan_id', $id);
			$rec = $this->db->get('fabric_tc_detail');
			
			//pre($this->db->last_query());exit;
			return $rec->result_array();
		}

		public function get_segment_by_id($id)
		{
			$this->db->select(' `fabric_details`.`metaId`,
    fabric_details.segmentName,fabric_details.length,fabric_details.width,fabric_details.min,fabric_details.max,
    GROUP_CONCAT(fabric_details.fabricId) AS fabricId,
    GROUP_CONCAT(fabric.fabricName) AS fabric,
    ');
			$this->db->where('fabric_details.metaId', $id);
			$this->db->join('fabric', 'fabric_details.fabricId=fabric.id');
			$this->db->group_by("fabric_details.segmentName");
			$this->db->order_by("fabric_details.id");
			$rec = $this->db->get('fabric_details');

			//pre($this->db->last_query());
			return $rec->result_array();
		}
		
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('grade', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('grade');
	}



}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
