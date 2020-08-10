 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('customer_detail', $data);
	}
	public function get()
	{
			$this->db->select('customer_detail.*,branch_detail.name as bname');
			$this->db->from('customer_detail');
			$this->db->join('branch_detail', 'branch_detail.id=customer_detail.under_branch');
			$rec = $this->db->get();
			return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('customer_detail', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('customer_detail');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('customer_detail');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}
  function get_user_exist($customername){
        $this->db->select('name');
        $this->db->from('customer_detail');
        $this->db->where('name', $customername);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return true;
        }else{
            return false;
        }
    }


}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
