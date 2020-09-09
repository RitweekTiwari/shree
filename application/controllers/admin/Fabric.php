<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fabric extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('Fabric_model');
		$this->load->model('Hsn_model');
	}
	public function index()
	{
		$data = array();
		$data['name'] = 'Fabric';
		$data['fabric_data'] = $this->Fabric_model->get('fabric');

		//	pre($data['fabricId']);exit;
		$data['hsn_data'] = $this->Hsn_model->hsn();
		$data['unit_data'] = $this->Fabric_model->get('unit');

		$data['main_content'] = $this->load->view('admin/master/fabric/fabric', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function get_fabric_list()
	{
		$output = array();
		$data = array();
		$record = array();

		$caption = '';
		if ($_POST) {
			if (!empty($_POST["search"]["value"])) {
				//pre($_POST["search"]["value"]);exit;
				$data['Value'] = $_POST["search"]["value"];
				$data['search'] = 'search';

				$data['fabric_data'] = $this->Fabric_model->get_fabric($data);

				foreach ($data['fabric_data'] as $key => $value) {

					$output[$key]['id'] = $value['id'];
					$output[$key]['fabricName'] = $value['fabricName'];
					$output[$key]['fabHsnCode'] = $value['fabHsnCode'];
					$output[$key]['fabricType'] = $value['fabricType'];
					$output[$key]['fabricCode'] = $value['fabricCode'];
					$output[$key]['fabricUnit'] = $value['fabricUnit'];
					$output[$key]['purchase'] = $value['purchase'];
					$output[$key]['fabricId'] = self::get_array($value['segmentName'], $value['fabricId'], $value['length'], $value['width']);
					//pre($output[$key]['fabricId']);exit;
				}
				if (isset($output)) {
					$data['output'] = $output;
					//pre($data['output']);exit;
				}
			} else {
				$data['fabric_data'] = $this->Fabric_model->get_fabric($data);
				//	pre($data['fabric_data']);exit;
				foreach ($data['fabric_data'] as $key => $value) {
					$output[$key]['id'] = $value['id'];
					$output[$key]['fabricName'] = $value['fabricName'];
					$output[$key]['fabHsnCode'] = $value['fabHsnCode'];
					$output[$key]['fabricType'] = $value['fabricType'];
					$output[$key]['fabricCode'] = $value['fabricCode'];
					$output[$key]['fabricUnit'] = $value['fabricUnit'];
					$output[$key]['purchase'] = $value['purchase'];
					$output[$key]['fabricId'] = self::get_array($value['segmentName'], $value['fabricId'], $value['length'], $value['width']);
					//pre($output[$key]['fabricId']);exit;
				}
				if (isset($output)) {
					$data['output'] = $output;
					//pre($data['output']);exit;
				}
			}

			foreach ($data['output'] as $value) {
				$sub_array = array();
				$sub_array['row'] = 'row_' . $value['id'];
				$sub_array['id'] = '<input type="checkbox" class="sub_chk" data-id=' . $value['id'] . '>';
				$sub_array['fabricName'] = $value['fabricName'];
				$sub_array['fabHsnCode'] = $value['fabHsnCode'];
				$sub_array['fabricType'] = $value['fabricType'];
				$sub_array['fabricCode'] = $value['fabricCode'];
				$sub_array['fabricUnit'] = $value['fabricUnit'];
				$sub_array['purchase'] = $value['purchase'];
				$sub_array['fabricId'] = $value['fabricId'];

				$sub_array['action'] =  '<a id="' . $value['id'] . '"; class="text-center tip find_id" data-toggle="modal" data-original-title="Edit">
					<i class="fas fa-edit blue"></i>
				</a>
				<a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(' . $value['id'] . ')" data-original-title="Delete">
		      <i class="mdi mdi-delete red"></i>
		    </a>	';



				$record[] = $sub_array;
			}

			$output = array(

				"recordsTotal" => count($record),
				"recordsFiltered" =>	count($record),
				"draw"   =>  intval($_POST["draw"]),
				"data" => $record
			);

			echo json_encode($output);
		}
	}

	public function get_array($segmentName, $fabricId, $length, $width)
	{
		$segmentName = explode(',', $segmentName);

		$fabricId = explode(',', $fabricId);

		$length = explode(',', $length);
		$width = explode(',', $width);
		if (count($segmentName) == count($fabricId)) {

			for ($i = 0; $i < count($fabricId); $i++) {
				$result[] = array('segmentName' => $segmentName[$i], 'fabricId' => $fabricId[$i], 'length' => $length[$i], 'width' => $width[$i],);
			}
			return $result;
		}
	}


	public function addFabric()
	{
		if ($_POST) {
			//	pre($_POST);exit;
			$data = array(
				'fabricName' => $_POST['fabricName'],
				'fabHsnCode' => $_POST['fabHsnCode'],
				'fabricType' => $_POST['fabricType'],
				'fabricCode' => $_POST['fabricCode'],
				'fabricUnit' => $_POST['fabricUnit'],
			);
			// print_r($data);
			$id = $this->Fabric_model->add('fabric', $data);
			echo $id;
			if ($id) {
				for ($i = 0; $i < count($_POST['segmentName']); $i++) {
					if ($_POST['fabricId'][$i] != 0) {
						$data = array(
							'metaId' => $id,
							'segmentName' => $_POST['segmentName'][$i],
							'fabricId' => $_POST['fabricId'][$i],
							'length' => $_POST['length'][$i],
							'width' => $_POST['width'][$i]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					} else {
						$data = array(
							'metaId' => $id,
							'segmentName' => $_POST['segmentName'][$i],
							'fabricId' => $id,
							'length' => $_POST['length'][$i],
							'width' => $_POST['width'][$i]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					}
				}
				$this->session->set_flashdata(array('error' => 0, 'msg' => ' Added Successfully'));
				redirect(base_url('admin/Fabric'));
			} else {
				$this->session->set_flashdata(array('error' => 1, 'msg' => 'Added Faild'));
				redirect(base_url('admin/Fabric'));
			}
		}
	}

	public function get_edit_data()
	{
		if ($_POST) {
			$record = array();
			//	$data['fabricId']=$this->Fabric_model->get_fabricId('fabric_details');
			$data['fdeatils'] = $this->Fabric_model->get_all_data($_POST['id']);

			foreach ($data['fdeatils'] as $key => $value) {
				$output[$key]['id'] = $value['id'];
				$output[$key]['fabricName'] = $value['fabricName'];
				$output[$key]['fabHsnCode'] = $value['fabHsnCode'];
				$output[$key]['fabricType'] = $value['fabricType'];
				$output[$key]['fabricCode'] = $value['fabricCode'];
				$output[$key]['fabricUnit'] = $value['fabricUnit'];
				$output[$key]['purchase'] = $value['purchase'];
				$output[$key]['fabricdetails'] = self::get_edit_array($value['fdid'], $value['segmentName'], $value['fabricId'], $value['fName'], $value['length'], $value['width']);
				//pre($output[$key]['fabricdetails']);exit;
			}
			if (isset($output)) {
				$data['output'] = $output;
				//pre($data['output']);exit;
			}
		}
		echo json_encode($data['output']);
	}

	public function get_edit_array($fdid, $segmentName, $fabricId, $fName, $length, $width)
	{
		$fdid = explode(',', $fdid);
		$segmentName = explode(',', $segmentName);

		$fabricId = explode(',', $fabricId);
		$fName = explode(',', $fName);
		$length = explode(',', $length);
		$width = explode(',', $width);
		if (count($segmentName) == count($fabricId)) {

			for ($i = 0; $i < count($fabricId); $i++) {
				$result[] = array('fdid' => $fdid[$i], 'segmentName' => $segmentName[$i], 'fabricId' => $fabricId[$i], 'fName' => $fName[$i], 'length' => $length[$i], 'width' => $width[$i],);
			}
			return $result;
		}
	}

	public function edit()
	{
		if ($_POST) {
			//	pre($_POST);exit;
			$fid = $this->input->post('fabricid');
			//$fdid= $this->input->post('details');

			$data = array(
				'fabricName' => $_POST['fabricName'],
				'fabHsnCode' => $_POST['fabHsnCode'],
				'fabricType' => $_POST['fabricType'],
				'fabricCode' => $_POST['fabricCode'],
				'fabricUnit' => $_POST['fabricUnit'],
			);

			$id = $this->Fabric_model->edit($fid, $data, 'fabric');
			if (isset($_POST['fdid'])) {
				if ($id && $_POST['fdid'] != '') {

					$count = count($_POST['fdid']);
					$count1 = count($_POST['segmentName']);
					for ($i = 0; $i < $count; $i++) {

						$data1 = array(
							'segmentName' => $_POST['segmentName'][$i],
							'fabricId' => $_POST['fabricId'][$i],
							'length' => $_POST['length'][$i],
							'width' => $_POST['width'][$i],
						);
						$id1 = $this->Fabric_model->edit($_POST['fdid'][$i], $data1, 'fabric_details');
					}
				}

				// if($id1){
				for ($j = $i; $j < $count1; $j++) {

					if ($_POST['segmentName'][$j] != '' && $_POST['fabricId'][$j] != 0) {
						$data = array(
							'metaId' => $fid,
							'segmentName' => $_POST['segmentName'][$j],
							'fabricId' => $_POST['fabricId'][$j],
							'length' => $_POST['length'][$j],
							'width' => $_POST['width'][$j]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					} else {
						$data = array(
							'metaId' => $fid,
							'segmentName' => $_POST['segmentName'][$j],
							'fabricId' => $fid,
							'length' => $_POST['length'][$j],
							'width' => $_POST['width'][$j]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					}
				}
			} else {
				for ($i = 0; $i < count($_POST['segmentName']); $i++) {
					if ($_POST['fabricId'][$i] != 0) {
						$data = array(
							'metaId' => $fid,
							'segmentName' => $_POST['segmentName'][$i],
							'fabricId' => $_POST['fabricId'][$i],
							'length' => $_POST['length'][$i],
							'width' => $_POST['width'][$i]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					} else {
						$data = array(
							'metaId' => $fid,
							'segmentName' => $_POST['segmentName'][$i],
							'fabricId' => $fid,
							'length' => $_POST['length'][$i],
							'width' => $_POST['width'][$i]
						);
						$id1 = $this->Fabric_model->add('fabric_details', $data);
					}
				}
			}
		}
	}

	public function delete($id)
	{
		$this->Fabric_model->delete($id);
		$this->db->delete('fabric_details', array('metaId' => $id));
	}

	public function deletefabric()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);
		foreach ($userid as $value) {
			$this->db->delete('fabric', array('id' => $value));
			$this->db->delete('fabric_details', array('metaId' => $value));
		}
	}
	public function getfdid()
	{
		$id = $this->input->post('id');
		$id1 = $this->Fabric_model->delete_fabridetails('fabric_details', $id);
		if ($id1) {
			echo 1;
		} else {
			echo 0;
		}
	}




	public function fabricExist()
	{
		if ($_POST) {
			$output = '';
			$data = $this->Fabric_model->get_fabric_exist($_POST['fabricName']);
			//echo print_r($data);exit;
			if ($data) {

				echo TRUE;
			} else {

				echo FALSE;
			}
		} else {
			echo json_encode(array('error' => true, 'msg' => 'somthing want wrong :('));
		}
	}
}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
