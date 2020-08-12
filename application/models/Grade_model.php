 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('grade', $data);
	}
	public function get()
	{
		$rec=$this->db->get('grade');
		return $rec->result();

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
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('grade');
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
