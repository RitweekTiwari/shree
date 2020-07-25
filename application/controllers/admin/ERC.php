<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ERC extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Erc_model');
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'ERC';
		$data['designname'] = $this->Erc_model->get_design_name();
		$data['fresh_designname'] = $this->Erc_model->get_design_fresh_value();
		$data['design'] = $this->Erc_model->get_design();
		
	//echo"<pre>";	print_r($data['designname']);exit;
        $data['main_content'] = $this->load->view('admin/master/erc/erc', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

	
     public function get_src_fabcode()
    {

		$fabcode = $this->Erc_model->get_src_fabcode_value();
		//echo print_r( $fabcode);exit;

        foreach($fabcode as $row ) {

        foreach($row as $value){
        $result_array[]= $value;
        }
        //echo  print_r($result_array);exit;

    }
		header('Content-type: application/json');
		echo json_encode($result_array);


    }

public function update()
    {
		if ($_POST) {
				$id=$_POST['id'];
		$data = array(
			'desCode' => $_POST['descode'],
			'desName' => $_POST['designname'],
			'rate' => $_POST['rate']
		);
					 $this->Erc_model->Update($id,$data);
			redirect(base_url('admin/ERC'));
				}
					
    }
		public function add_erc(){
		if ($_POST) {
			$data=array();

			$data = array(
				'desCode' => $_POST['descode'],
				'desName' => $_POST['designname'],
				'rate' => $_POST['rate']
			);
					$id =$this->Erc_model->insert($data,'erc');
			redirect(base_url('admin/ERC'));
				}
		}

	public function getDesign()
	{
		if ($_POST) {
			$id = $this->security->xss_clean($_POST['id']);
			$design = $this->Erc_model->get_design_by_id($id);
			//print_r($design[0]);exit;
			header('Content-type: application/json');
			echo json_encode($design[0]);
		}
	}
	public function delete($id)
	{
		$this->Erc_model->delete($id);
		redirect(base_url('admin/ERC'));
	}
	public function deleteErc()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);
		foreach ($userid as $value) {
			$this->db->delete('erc', array('id' => $value));
		}
	}
		public function checkAvailable(){
				if ($_POST) {
					$output = '';
					$check = $this->security->xss_clean($_POST);
					$data = $this->Erc_model->get_ERC_set_exist($check);
					//echo print_r($data);exit;
						if($data){
							 echo 1;
						}else{
							echo 0;
						}
				}else{
						echo json_encode(array('error'=>true, 'msg'=>'somthing want wrong :('));
				}
		}

  }
