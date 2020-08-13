<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SRC extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Customer_model');
       $this->load->model('Src_model');
    }
    public function index()
    {
        $data = array();
		$data['page_name'] = 'SRC Dashboard ';
				//echo print_r($data['$febName']);exit;
        $data['main_content'] = $this->load->view('admin/master/src/index', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
	public function show_src(){
		$data['page_name'] = 'ADD SRC /' . '<a href="' . base_url('admin/SRC') . '">Home</a>';
		$data['febName'] = $this->Src_model->get_fabric_name();
		
		
		$data['fresh_fabricname'] = $this->Src_model->get_fabric_fresh_value();
		$data['grade'] = $this->common_model->select('grade');
		$data['code'] = $this->common_model->select('fabric_code');
		$data['count'] = count($data['grade']);
		$data['main_content'] = $this->load->view('admin/master/src/src', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_list()
	{
		$data = array();
		$data['page_name'] = ' SRC LIST /' . '<a href="' . base_url('admin/SRC') . '">Home</a>';
		$data['src'] = $this->Src_model->get_src();
		foreach ($data['src'] as $key => $value) {
			$output[$key]['fabric'] = $value->fabricName;
			$output[$key]['code'] = $value->fbcode;
			$output[$key]['grade'] = self::get_array($value->grade, $value->rate);
		}

		$data['output'] = $output;
		$data['grade'] = $this->common_model->select('grade');
		//echo print_r($data['$febName']);exit;
		$data['main_content'] = $this->load->view('admin/master/src/list', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function get_array($gread, $rate)
	{
		$gread = explode(',', $gread);
		$rate = explode(',', $rate);
		if (count($gread) == count($rate)) {
			foreach ($rate as $key => $value) {
				$result[$gread[$key]] = $value;
			}
			return $result;
		}
	}

	public function getfabricRate()
    {
		$id=$this->security->xss_clean($_POST['id']);
		$rate = $this->Src_model->getfabricRate($id);
     

	
		header('Content-type: application/json');
		if($rate !=""){
			echo json_encode($rate);
		}else{
			echo json_encode("Null");
		}
		
}
	

public function update()
    {
		
    }



		
    	public function add_src(){

		$form = $this->security->xss_clean($_POST);
		
		foreach($form['form'] as $row){
			if($row['name']=="grade"){
				$data['grade'][]= $row['value'];
			}elseif($row['name'] == "rate"){
				$data['rate'][] = $row['value'];	
			}else{
				$arr=array(
					$row['name']=> $row['value']
				);
				$data[]= $arr;
			}
		}
	
		$count = count($data['rate']);
		$done=0;
		for ($i = 0; $i < $count; $i++) {	
		$data1=array(

						'fabric' => $data[0]['fabricName'],
						
						'code' => $data[1]['code'],
						'grade' => $data['grade'][$i],
						'rate' => $data['rate'][$i],
						'created_at' => date('Y-m-d')
					);
					
					$id = $this->Src_model->insert($data1,'src');
					
					if($id>0 && $id!=""){
						$done+=1;
					}
		}
		if($done>0){
			echo 1;	
		}	else{
			echo 0;	
		}
		
		
		
		}

  }
