<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Design extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('Design_model');
		$this->load->model('common_model');
		$this->load->library('barcode');
		$this->load->library('pdf');
		$this->load->library("pagination");
		$this->load->helper('url');
	}

	public function index()
	{
		$data = array();
		$data['febName'] = $this->common_model->febric_name();
		$data['febType'] = $this->common_model->febric_type();
		$data['main_content'] = $this->load->view('admin/master/design/design', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function get_design_list()
	{
		$query = '';
		$output = array();
		$data = array();
	
		if (!empty($_POST["search"]["value"])) {
			//	pre($_POST["search"]["value"]);exit;
			$query .= 'SELECT * FROM design_view  where ';
			$query .= 'fabricName LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR designName LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR designSeries LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR desCode LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR rate LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR stitch LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR dye LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR matching LIKE "%' . $_POST["search"]["value"] . '%" ';
			// $query .= 'OR sale_rate LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR htCattingRate LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR dye LIKE "%' . $_POST["search"]["value"] . '%" ';
			$query .= 'OR barCode LIKE "%' . $_POST["search"]["value"] . '%" ';
			$caption = 'Search Result For : ' . $_POST["search"]["value"] . '';
		} elseif (!empty($_POST["filter"])) {
			$data1['filter'] = $this->input->post('filter');
			$caption = 'Search Result For : ';
			if ($data1['filter']['search'] == 'simple') {
				if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
					$query .= 'SELECT * FROM design_view  where';
					$query .= ' ' . $_POST['filter']['searchByCat'] . ' LIKE "%' . $_POST['filter']['searchValue'] . '%" ';
					$caption = $caption . $data1['filter']['searchByCat'] . " = " . $data1['filter']['searchValue'] . " ";
				}
			} else {

				if (isset($_POST['designName']) && $_POST['designName'] != "") {
					$data1['cat'][] = 'designName';
					$fab = $this->input->post('designName');


					$data1['Value'][] = $fab;
					$caption = $caption . ' designName' . " = " . $fab . " ";
				}
				if (isset($_POST['designSeries']) && $_POST['designSeries'] != "") {
					$data1['cat'][] = 'designSeries';
					$fab = $this->input->post('designSeries');
					$data1['Value'][] = $fab;
					$caption = $caption . 'designSeries ' . " = " . $fab . " ";
				}
				if (isset($_POST['desCode']) && $_POST['desCode'] != "") {
					$data1['cat'][] = 'desCode';
					$fab = $this->input->post('desCode');
					$data1['Value'][] = $fab;
					$caption = $caption . 'desCode' . " = " . $fab . " ";
				}
				if (isset($_POST['rate']) && $_POST['rate'] != "") {
					$data1['cat'][] = 'rate';
					$fab = $this->input->post('rate');
					$data1['Value'][] = $fab;
					$caption = $caption . 'rate' . " = " . $fab . " ";
				}
				if (isset($_POST['stitch']) && $_POST['stitch'] != "") {
					$data1['cat'][] = 'stitch';
					$fab = $this->input->post('stitch');
					$data1['Value'][] = $fab;
					$caption = $caption . 'stitch' . " = " . $fab . " ";
				}
				if (isset($_POST['dye']) && $_POST['dye'] != "") {
					$data1['cat'][] = 'dye';
					$fab = $this->input->post('dye');
					$data1['Value'][] = $fab;
					$caption = $caption . 'dye' . " = " . $fab . " ";
				}
				if (isset($_POST['matching']) && $_POST['matching'] != "") {
					$data1['cat'][] = 'matching';
					$fab = $this->input->post('matching');
					$data1['Value'][] = $fab;
					$caption = $caption . 'matching' . " = " . $fab . " ";
				}
				if (isset($_POST['sale_rate']) && $_POST['sale_rate'] != "") {
					$data1['cat'][] = 'sale_rate';
					$fab = $this->input->post('sale_rate');
					$data1['Value'][] = $fab;
					$caption = $caption . 'sale_rate' . " = " . $fab . " ";
				}
				if (isset($_POST['htCattingRate']) && $_POST['htCattingRate'] != "") {
					$data1['cat'][] = 'htCattingRate';
					$fab = $this->input->post('htCattingRate');
					$data1['Value'][] = $fab;
					$caption = $caption . 'htCattingRate' . " = " . $fab . " ";
				}
				if (isset($_POST['fabricName']) && $_POST['fabricName'] != "") {
					$data1['cat'][] = 'fabricName';
					$fab = $this->input->post('fabricName');
					$data1['Value'][] = $fab;
					$caption = $caption . 'fabricName' . " = " . $fab . " ";
				}
				if (isset($_POST['barCode']) && $_POST['barCode'] != "") {
					$data1['cat'][] = 'barCode';
					$fab = $this->input->post('barCode');
					$data1['Value'][] = $fab;
					$caption = $caption . 'barCode' . " = " . $fab . " ";
				}
				if (isset($_POST['designOn']) && $_POST['designOn'] != "") {
					$data1['cat'][] = 'designOn';
					$fab = $this->input->post('designOn');
					$data1['Value'][] = $fab;
					$caption = $caption . 'designOn' . " = " . $fab . " ";
				}
				if (isset($data1['cat']) && $data1['Value']) {
					$query .= 'SELECT * FROM design_view  where ';
					$count = count($data['cat']);
					for ($i = 0; $i < $count; $i++) {
						$query .= ' ' . $data['cat'][$i] . ' LIKE "%' . $data['Value'][$i] . '%" ';
					}
				} else {
					$this->session->set_flashdata('error', 'please enter some keyword');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} else {
			$caption = "Design List";
			$query .= 'SELECT * FROM design_view ';
		}

		if (!empty($_POST["order"]) && isset($_POST["order"])) {
			$query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$query .= ' ORDER BY id desc ';
		}
		$sql = $this->db->query($query);
		
		$filtered_rows = $sql->num_rows();
		if (isset($_POST["length"]) && $_POST["length"] != -1) {
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$sql = $this->db->query($query);
		$result = $sql->result_array();
		
		//echo "<pre>"; print_r($result);exit;
		foreach ($result as $value) {
			$sub_array = array();
			$sub_array[] = '<input type="checkbox" class="sub_chk" data-id=' . $value['id'] . '>';
			$sub_array[] = $value['id'];
			$sub_array[] = $value['designName'];
			$sub_array[] = $value['designSeries'];
			$sub_array[] = $value['desCode'];
			$sub_array[] = $value['rate'];
			$sub_array[] = $value['stitch'];
			$sub_array[] = $value['dye'];
			$sub_array[] = $value['matching'];
			// $sub_array[] = $value['sale_rate'];
			$sub_array[] = $value['htCattingRate'];
			$sub_array[] =  '<a class=" image-popup-vertical-fit " href="' . base_url('/upload/') . $value['designPic'] .'"> <img src="' . base_url('/upload/') . $value['designPic'] . '" title="image" style="height: 40px; width: 40px;">
                              </a>';
			$sub_array[] =   $value['fabricName'];
			$sub_array[] = $value['barCode'];
			$sub_array[] =  $value['designOn'];
			$sub_array[] =  '<a class="text-danger text-center tip" href="javascript:void(0)" onclick="edit( ' . $value['id'] . ')" data-original-title="Delete">
                      <i class="mdi mdi-pen blue"></i>
                    </a>
                    <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail( ' . $value['id'] . ')" data-original-title="Delete">
                      <i class="mdi mdi-delete red"></i>
                    </a>
                    <a class="text-center tip" target="_blank" href="' . base_url("admin/design/design_print/") . $value['id'] . ' ">
                      <i class="fa fa-print" aria-hidden="true"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			'caption' => $caption,
			"draw"       =>  intval($_POST["draw"]),
			"recordsTotal" => $this->Design_model->get_count(),
			"recordsFiltered" =>
			$filtered_rows,
			"data" => $data
		);

		echo json_encode($output);
	}


	public function fabricOn()
	{
		if ($_POST) {
			$data = $this->common_model->febric_type_byId($_POST['fabricName']);
			//    print_r($data);exit;
			echo $data->fabricType;
		}
	}

	public function addDesign()
	{
		if ($_POST) {
			$lastId = $this->Design_model->getLastId();
			$pre = explode("D", $lastId->barCode);
			$newId = (int) ($pre[1]) + 1;
			$barCode = "D" . (string) $newId;

			
			$new_name =  $barCode ;

			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'webp|jpg|png|jpeg';
			
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('designPic')) {
			
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$data = array(
						'designName' => $_POST['designName'],
						'designSeries' => $_POST['designSeries'],
						// 'designCode'=>$_POST['designCode'],
						'stitch' => $_POST['stitch'],
						'dye' => $_POST['dye'],
						'matching' => $_POST['matching'],
						// 'saleRate'=>$_POST['saleRate'],
						'htCattingRate' => $_POST['htCattingRate'],
						'designPic' => "",
						'fabricName' => $_POST['fabricName'],
						'barCode' => $barCode,
						'designOn' => trim($_POST['designOn'])
					);
					// print_r($data); exit();
					$id =	$this->Design_model->add($data);
					if ($id) {
						$this->session->set_flashdata('success', 'Added Successfully');
					} else {
						$this->session->set_flashdata('error', 'please enter some keyword');
					}
					redirect(base_url('admin/Design'));
			} else {
				$data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload/' . $data["file_name"];
				
				
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '30%';
				$config['width'] = 720;
				
				$config['new_image'] = './upload/' . $data["file_name"];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$img = $this->upload->data();
				$pic1 = $img['file_name'];



				
					$data = array(
						'designName' => $_POST['designName'],

						'designSeries' => $_POST['designSeries'],
						// 'designCode'=>$_POST['designCode'],
						'stitch' => $_POST['stitch'],
						'dye' => $_POST['dye'],
						'matching' => $_POST['matching'],
						// 'saleRate'=>$_POST['saleRate'],
						'htCattingRate' => $_POST['htCattingRate'],
						'designPic' => $pic1,
						'fabricName' => $_POST['fabricName'],
						'barCode' => $barCode,
						'designOn' => trim($_POST['designOn'])
					);
				//print_r($data); exit();
				$id=	$this->Design_model->add($data);
				if ($id) {
					$this->session->set_flashdata('success', 'Added Successfully');
				} else {
					$this->session->set_flashdata('error', 'please enter some keyword');
				}
					redirect(base_url('admin/Design'));
				
			}
		
			
		}
	}
	public function design_print($id)
	{

		$data['data'] = $this->Design_model->get_single_value_by_id($id);
		$data['pdf'] = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->load->view('admin/master/design/index', $data);
	}
	public function getDesign()
	{

		$id = $this->security->xss_clean($_POST['id']);

		$data['data'] = $this->Design_model->get_single_value_by_id($id);

		echo json_encode($data['data']);
	}


	public function edit()
	{
		if ($_POST) {

			$id = $_POST['designId'];
			$data = $this->Design_model->get_dpic($id);
			$picture = $data->designPic;

			$barCode = $_POST['barCode'];

			
			$new_name =  $barCode ;
			//echo $new_name;exit;

			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'webp|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('designPic1')) {
				//echo "Not Uploaded". $this->upload->display_errors();exit;
				$error= $this->upload->display_errors();
				$this->session->set_flashdata('error', $error );
				$data = array(
					'designName' => $_POST['designName'],
					'designSeries' => $_POST['designSeries'],
					// 'designCode'=>$_POST['designCode'],
					'stitch' => $_POST['stitch'],
					'dye' => $_POST['dye'],
					'matching' => $_POST['matching'],
					'designPic' => "",
					'htCattingRate' => $_POST['htCattingRate'],
					'fabricName' => $_POST['fabricName'],
					'designOn' => trim($_POST['designOn'])
				);
				
			} else {
				//  echo " Uploaded";
				//  exit;
				unlink("upload/" . $picture);
				$data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload/' . $data["file_name"];


				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '30%';
				$config['width'] = 720;

				$config['new_image'] = './upload/' . $data["file_name"];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$img = $this->upload->data();
				$pic1 = $img['file_name'];




				
				$data = array(
					'designName' => $_POST['designName'],
					'designSeries' => $_POST['designSeries'],
					// 'designCode'=>$_POST['designCode'],
					'stitch' => $_POST['stitch'],
					'dye' => $_POST['dye'],
					'matching' => $_POST['matching'],
					// 'saleRate'=>$_POST['saleRate'],
					'htCattingRate' => $_POST['htCattingRate'],
					'designPic' => $pic1,
					'fabricName' => $_POST['fabricName'],
					'designOn' => trim($_POST['designOn'])

				);
			
			}
			// print_r($data); exit();
			$id =	$this->Design_model->edit($id, $data);

			if ($id) {
				$this->session->set_flashdata('success', 'Added Successfully');
			} else {
				$this->session->set_flashdata('error', 'please enter some keyword');
			}
			redirect(base_url('admin/Design'));
		}
		
	}


	public function delete($id)
	{
		$id = $this->Design_model->delete($id);
		if ($id) {
			$this->session->set_flashdata('success', 'Added Successfully');
		} else {
			$this->session->set_flashdata('error', 'please enter some keyword');
		}
		redirect(base_url('admin/Design'));
	}
	public function deletedesign()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);
		$count=0;$del=0;
		foreach ($userid as $value) {
			$id=$this->db->delete('design', array('id' => $value));
			$del=$del+$id;
			$count++;
		}
		if($count==$del){
			echo 1;
		}else{
			echo 2;
		}
	}

	public function get_data()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);
		foreach ($userid as $value) {
			$data[] = $this->Design_model->select_value('design', $value);
		}
		$data['pdf'] = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->load->view('admin/master/design/multiple', $data);
	}

	public function designExist()
	{
		if ($_POST) {
			$output = '';
			$check = $this->security->xss_clean($_POST);
			$data = $this->Design_model->get_design_set_exist($check);
			//echo print_r($data);exit;
			if ($data) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo json_encode(array('error' => true, 'msg' => 'somthing want wrong :('));
		}
	}
	public function filter1()
	{
		$data1 = array();
		$this->security->xss_clean($_POST);
		if ($_POST) {
			// echo"<pre>";	print_r($_POST); exit;

			$config = $this->pagination_Config();
			$data1['per_page'] = $config["per_page"];
			$data1['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		}
	}

	public function pagination_Config()
	{
		$config = array();
		$config["base_url"] = base_url() . "admin/design";
		$config["total_rows"] = $this->Design_model->get_count();
		$config["per_page"] = 100;
		$config["uri_segment"] = 3;
		// $config['use_page_numbers'] = TRUE;
		$config['num_links'] = 9;

		$config['display_pages'] = TRUE;

		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

		return $config;
	}
}
