 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Percent_model extends CI_Model
	{

		public function add($data, $table)
		{
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
		public function get($data)
		{
			// pre($data);exit;
			$this->db->select('gpercent.id,fabric.fabricName, GROUP_CONCAT(grade.grade ORDER BY grade.grade) AS grade, GROUP_CONCAT(gprecent_meta.percent) AS percent,');
			$this->db->from('gpercent');
			if (isset($data['search'])) {
				$this->db->like('fabric.fabricName', $data['Value']);
			}

			$this->db->join('gprecent_meta', 'gprecent_meta.percentId=gpercent.id', 'inner');
			$this->db->join('fabric', 'fabric.id=gpercent.fabric', 'inner');
			$this->db->join('grade', 'grade.id=gprecent_meta.grade', 'inner');
			$this->db->group_by('fabric.fabricName');
			
			$rec = $this->db->get();
			//echo $this->db->last_query($rec);exit;
			return $rec->result_array();
		}


		public function get_all_data($id)
		{

			$this->db->select('fabric.fabricName,grade.grade,gprecent_meta.percent,gpercent.id,gprecent_meta.percentId,gprecent_meta.id as metaid,gprecent_meta.grade as gradeId ');
			$this->db->from('gpercent');
			$this->db->where('gpercent.id', $id);
			$this->db->join('gprecent_meta', 'gprecent_meta.percentId=gpercent.id', 'inner');
			$this->db->join('fabric', 'fabric.id=gpercent.fabric', 'inner');
			$this->db->join('grade', 'grade.id=gprecent_meta.grade', 'inner');

			$rec = $this->db->get();
			//  echo $this->db->last_query($rec);exit;
			return $rec->result_array();
		}

		public function edit($id, $data)
		{
			// print_r($data);
			// print_r($id);
			$this->db->where('id', $id);
			$this->db->update('gprecent_meta', $data);
			//echo $this->db->last_query();
			return true;
		}
		public function delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('gpercent');
		}
		public function search($searchByCat, $searchValue)
		{
			$this->db->select('gpercent.id,gpercent.percent,grade.grade,fabric.fabricName,');
			$this->db->from('gpercent');
			$this->db->like($searchByCat, $searchValue);
			$this->db->join('fabric', 'fabric.id=gpercent.fabric', 'inner');
			$this->db->join('grade', 'grade.id=gpercent.grade', 'inner');
			$rec = $this->db->get();
			return $rec->result_array();
			// print_r($searchValue);
			// print_r($this->db->last_query());

		}
		public function get_fabric_value()
		{
			$sql = 'SELECT id,fabricName FROM fabric where
     id NOT IN(SELECT fabric FROM gpercent) order by fabricName
   ';

			$query = $this->db->query($sql);
			//  echo $this->db->last_query($query);exit;
			$query = $query->result_array();
			return $query;
		}
		public function get_count($table)
		{
			return $this->db->count_all($table);
		}
	}

	/* End of file Branch_model.php */
	/* Location: ./application/models/Branch_model.php */
	?>
