 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Job_work_type_model extends CI_Model
	{

		public function add($data)
		{
			$this->db->insert('job_work_type', $data);
			return $this->db->insert_id();
		}
		public function getUnits()
		{
			$this->db->select('id ,unitSymbol');
			$this->db->from('unit');
			$rec = $this->db->get();
			return $rec->result_array();
		}
		public function insert($data, $table)
		{
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		public function get($data)
		{
			$this->db->select('jw.id,jw.type,  GROUP_CONCAT(unit.unitSymbol) AS unit, GROUP_CONCAT(jc.job) AS job, GROUP_CONCAT(jc.rate) AS rate');
			$this->db->from('job_work_type jw');

			if (isset($data['search'])) {

				$this->db->LIKE('type', $data['Value']);
			}
			$this->db->JOIN('jobtypeconstant jc', 'jc.jobId = jw.id', 'left');
			$this->db->JOIN('unit', 'unit.id = jc.unit', 'left');
			$this->db->group_by('jw.type');
			$this->db->order_by('jw.id', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query($query);exit;
			$query = $query->result_array();
			return $query;
		}
		public function get_all_edit_data($id)
		{
			$this->db->select('jw.id,jw.type, GROUP_CONCAT(jc.id) AS jcid,GROUP_CONCAT(jc.jobId) AS jobId, GROUP_CONCAT(unit.unitSymbol) AS unitSymbol,GROUP_CONCAT(jc.unit) AS unit, GROUP_CONCAT(jc.job) AS job, GROUP_CONCAT(jc.rate) AS rate');
			$this->db->from('job_work_type jw');
			$this->db->where('jw.id', $id);
			$this->db->JOIN('jobtypeconstant jc', 'jc.jobId = jw.id', 'left');
			$this->db->JOIN('unit', 'unit.id = jc.unit', 'left');
			// $this->db->group_by('jw.type');
			$this->db->order_by('jw.id', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query($query);exit;
			$query = $query->result_array();
			return $query;
		}
		public function edit($id, $data, $table)
		{
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			//echo $this->db->last_query();
			return true;
		}
		public function getType()
		{
			$this->db->select('distinct(type)');
			$rec = $this->db->get('job_work_type');
			return $rec->result();
		}

		public function getfabricType()
		{
			$this->db->select('distinct(fabricType)');
			$rec = $this->db->get('fabric');
			return $rec->result();
		}
		public function delete_jobtypeconstant($table, $id)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			//  echo $this->db->last_query();exit;
			return true;
		}
		public function delete($id)
		{
			$this->db->delete('job_work_type', array('job_work_type.id' => $id));
			$this->db->delete('jobtypeconstant', array('jobtypeconstant.jobId' => $id));
		}
		public function search($searchByCat, $searchValue)
		{
			$this->db->select('job_work_type.id,type,job,rate,unit');
			$this->db->from('job_work_type');
			$this->db->join("jobtypeconstant", 'job_work_type.id=jobtypeconstant.jobId');
			$this->db->like($searchByCat, $searchValue);
			$rec = $this->db->get();
			//print_r($this->db->last_query());exit;
			return $rec->result_array();
			// print_r($searchValue);
			// print_r($this->db->last_query());
		}
	}

	/* End of file Branch_model.php */
	/* Location: ./application/models/Branch_model.php */
	?>
