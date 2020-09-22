 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Fabric_model extends CI_Model
	{

		public function add($table, $data)
		{
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		public function get($table)
		{
			$rec = $this->db->get($table);
			return $rec->result();
		}
		public function get_fabricId($table)
		{
			$this->db->select('fabricId');
			$this->db->from($table);
			$rec = $this->db->get();
			return $rec->result();
		}
		public function get_all_data($id)
		{
			$this->db->select('fabric.id,fabric.fabricName,fabric.fabHsnCode,fabric.fabricCode,fabric.fabricType,fabric.purchase,  fabric.fabricUnit, GROUP_CONCAT(f1.fabricName) AS fName,GROUP_CONCAT(fd.fabricId) AS fabricId,GROUP_CONCAT(fd.id) AS fdid, GROUP_CONCAT(fd.segmentName) AS segmentName, GROUP_CONCAT(fd.length) AS length, GROUP_CONCAT(fd.width) AS width,');
			$this->db->from('fabric');
			$this->db->where('fabric.id', $id);
			$this->db->JOIN('fabric_details fd', 'fd.metaId = fabric.id', 'left');
			$this->db->JOIN('fabric f1', 'f1.id = fd.fabricId', 'left');
			// $this->db->group_by('fabric.fabricName');
			// $this->db->order_by('fabric.id' ,'DESC');

			$rec = $this->db->get();
			//  echo $this->db->last_query($rec);exit;
			return $rec->result_array();
		}
		
		public function check_frc($id)
		{
			$this->db->select('*');
			$this->db->from("fabric_stock_received");
			$this->db->where('fabric_id', $id);
			$rec = $this->db->get();
			if($rec->num_rows()>0)
				return 1;
			else
			return 0;
		}
		function get_fabric($data)
		{
			$this->db->select('fabric.id,fabric.fabricName,fabric.fabHsnCode,fabric.fabricCode,fabric.fabricType,fabric.purchase, unit.unitName as fabricUnit, GROUP_CONCAT(f1.fabricName) AS fabricId, GROUP_CONCAT(fd.segmentName) AS segmentName, GROUP_CONCAT(fd.length) AS length, GROUP_CONCAT(fd.width) AS width');
			$this->db->from('fabric');

			if (isset($data['search'])) {
				$this->db->LIKE('fabric.fabricName', $data['Value']);
				$this->db->or_LIKE('fabric.fabHsnCode', $data['Value']);
				$this->db->or_LIKE('fabric.fabricType', $data['Value']);
				$this->db->or_LIKE('fabric.fabricCode', $data['Value']);
				$this->db->or_LIKE('fabric.purchase', $data['Value']);
				$this->db->or_LIKE('fabric.fabricUnit', $data['Value']);
			}
			$this->db->JOIN('unit', 'unit.id = fabric.fabricUnit', 'left');
			$this->db->JOIN('fabric_details fd', 'fd.metaId = fabric.id', 'left');
			$this->db->JOIN('fabric f1', 'f1.id = fd.fabricId', 'left');
			$this->db->group_by('fabric.fabricName');
			$this->db->order_by('fabric.id', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query($query);exit;
			$query = $query->result_array();
			return $query;
		}
		public function get_count($table)
		{
			return $this->db->count_all($table);
		}

		public function edit($id, $data, $table)
		{
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			//echo $this->db->last_query();
			return true;
		}
		// public function edit_details($id,$data)
		// {
		//   $this->db->where('id', $id);
		//   $this->db->update('fabric_details', $data);
		//   return true;
		// }
		// public function delete($id)
		// {
		// 	 $this->db->where('id', $id);
		//    	$this->db->delete('fabric');
		// }
		public function delete($id)
		{
			$this->db->delete('fabric', array('fabric.id' => $id));
			$this->db->delete('fabric_details', array('fabric_details.metaId' => $id));
		}
		public function search($searchByCat, $searchValue)
		{
			$this->db->select('id,fabricName,fabHsnCode,fabricType,fabricCode,purchase');
			$this->db->from('fabric');
			$this->db->like($searchByCat, $searchValue);
			$rec = $this->db->get();
			return $rec->result_array();
			// print_r($searchValue);
			// print_r($this->db->last_query());

		}
		public function delete_fabridetails($table, $id)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			return true;
		}
		function get_fabric_exist($fabricName)
		{
			$this->db->select('fabricName');
			$this->db->from('fabric');
			$this->db->where('fabricName', $fabricName);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if ($query->num_rows() >= 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	/* End of file Branch_model.php */
	/* Location: ./application/models/Branch_model.php */
	?>
