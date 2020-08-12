 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fabric_code_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('fabric_code', $data);
	}
	public function get()
	{
		$rec=$this->db->get('fabric_code');
		return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('fabric_code', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('fabric_code');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('fabric_code');
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
