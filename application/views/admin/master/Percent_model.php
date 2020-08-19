 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Percent_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('gpercent', $data);
	}
	public function get($table)
	{
		$rec=$this->db->get($table);
		return $rec->result_array();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('gpercent', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('gpercent');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('gpercent.id,gpercent.percent,grade.grade,fabric.fabricName,');
		$this->db->from('gpercent');
		$this->db->like($searchByCat, $searchValue);
    $this->db->join('fabric','fabric.id==gpercent.fabric','inner');
    $this->db->join('grade','grade.id==gpercent.grade','inner');
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}


}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
