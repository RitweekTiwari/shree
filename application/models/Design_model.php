 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design_model extends CI_Model {

	public function add($data)
	{
		// print_r($data); exit();
    return($this->db->insert('design', $data));
	}
	public function get($limit, $start)
	{
    $this->db->limit($limit, $start);
    $this->db->select('*');
		$this->db->from('design_view');

    $rec=$this->db->get();
    // print_r($this->db->last_query());exit;

		return $rec->result();
  }
  public function get_count() {
        return $this->db->count_all('design_view');
    }
	public function edit($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('design', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('design');
	}

  public function get_single_value_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('design_view');
    // $this->db->like($searchByCat, $searchValue);
    $this->db->where('id',$id);

    $rec=$this->db->get();
     //print_r($this->db->last_query());exit;
    return $rec->row();
    // print_r($searchValue);
  }
  public function get_dpic($id)
  {

    $this->db->select('designPic');
    $this->db->from('design');
    $this->db->where('id',$id);
    $rec=$this->db->get();
//echo $this->db->last_query($rec);exit;
    return $rec->row();
  }

    public function get_multi_value_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('design_view');
    $this->db->where('id',$id);
    $rec=$this->db->get();
    return $rec->row();
  }

  function get_design_exist($designName){
        $this->db->select('designName');
        $this->db->from('design');
        $this->db->where('designName',$designName);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
    }
  function get_design_set_exist($data){
        $this->db->select('designName');
        $this->db->from('design');
        $this->db->where('designName',$data['design_name']);
        $this->db->where('designSeries',$data['designSeries']);
        $this->db->where('fabricName',$data['fabricName']);
        $query = $this->db->get();
        if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
    }
  //
  public function update($data){
      $this->db->where($data['searchByCat'], $data['searchValue'] );
      $this->db->update('design', array($data['searchByCat'] => $data['replaceValue']));
      return true;

  }

  function select_value($table,$id){
    // echo $id.$table;exit;
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }


    public function delete_data($ids){
       $userid= explode(",", $ids);
       foreach ($userid as $value) {
        $this->db->delete('design', array('id' => $value));
          echo $this->db->last_query();exit;
        }
       return 1;
    }
function getLastId(){
    			$this->db->select("barCode");
    			$this->db->from('design');
    			$this->db->order_by('id','DESC');
    			$this->db->limit(1);
    			$query = $this->db->get();
    			$query = $query->row();
    			return $query;
    		}
    public function search1($data)
    {

        $this->db->select('*');
        $this->db->from('design_view');
        $this->db->limit($data['per_page'], $data['page']);
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

      $rec = $this->db->get();
      //echo $this->db->last_query($rec);exit;
      return $rec->result();
    }
              //end arti
}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
