 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_department_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('sub_department', $data);
	}
	public function get()
	{
			$this->db->select('sb1.*,sb2.sortname as under1');
			$this->db->from('sub_department sb1');
			$this->db->join("sub_department sb2", "sb2.id=sb1.under","left");
			$rec = $this->db->get();
			return $rec->result();

	}
  public function department_name()
  {
    $this->db->select('deptName');
    $rec=$this->db->get('department');
    return $rec->result();
  }
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('sub_department', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('sub_department');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('sub_department');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}

		function get_name_exist($name,$col)
		{
			$this->db->select('*');
			$this->db->from('sub_department');
			$this->db->where($col, $name);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if ($query->num_rows() >= 1) {
				return true;
			} else {
				return false;
			}
		}
		public function get_primary()
		{
			$this->db->select('*');
			$this->db->from('sub_department');
			$this->db->where("under", 0);
			$rec = $this->db->get();
			return $rec->result_array();
			// print_r($searchValue);
			// print_r($this->db->last_query());

		}

}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
