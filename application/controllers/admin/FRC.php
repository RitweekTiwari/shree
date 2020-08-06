<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FRC extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();


		$this->load->model('Common_model');
		$this->load->model('Sub_department_model');
		$this->load->model('Frc_model');
		$this->load->library('pdf');
		$this->load->library('barcode');
		$this->load->library('session');
	}


	public function index()
	{
		$data = array();
		$data['name'] = 'Fabric Return Chalan';
		$data['febName'] = $this->Common_model->febric_name();
		$data['unit'] = $this->Frc_model->select('unit');
		$data['sub_dept_data'] = $this->Sub_department_model->get();
		//echo print_r($data['fabric_data']);exit;
		$data['main_content'] = $this->load->view('admin/FRC/return/addFrc', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showRecieve()
	{
		$data = array();
		$data['name'] = 'Add Fabric Recieve Challan';
		$data['febName'] = $this->Common_model->febric_name();
		$data['unit'] = $this->Frc_model->select('unit');
		$data['sub_dept_data'] = $this->Sub_department_model->get();

		$data['main_content'] = $this->load->view('admin/FRC/recieve/addRecieve', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showRecieveList()
	{
		$data = array();
		$data['name'] = 'FRC List';
		$data['febName'] = $this->Common_model->febric_name();
		if ($_POST) {

			$data['from'] = $this->input->post('date_from');
			$data['to'] = $this->input->post('date_to');
			$data['type'] = $this->input->post('type');
			$data['caption'] = 'From : ' . $data['from'] . ' - To : ' . $data['to'];
		} else {
			$data['type'] = 'recieve';
			$data['to'] = date('Y-m-d');
			$data['from'] = date('Y-04-01');
			$data['caption'] = 'Challan Receive List';
		}
		$data['frc_data'] = $this->Frc_model->get($data);
		$data['summary'] = $this->Frc_model->get_summary($data);
		// echo "<pre>"; print_r($data['frc_data']);exit;
		$data['content'] = $this->load->view('admin/FRC/recieve/list_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/FRC/recieve/list_recieve', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showReturnList()
	{
		$data = array();
		$data['name'] = 'Return List';
		$data['febName'] = $this->Common_model->febric_name();
		if ($_POST) {

			$data['from'] = $this->input->post('date_from');
			$data['to'] = $this->input->post('date_to');
			$data['type'] = $this->input->post('type');
			$data['caption'] = 'From : ' . $data['from'] . ' - To : ' . $data['to'];
		} else {
			$data['type'] = 'return';
			$data['to'] = date('Y-m-d');
			$data['from'] = date('Y-04-01');
			$data['caption'] = 'Challan Return List';
		}
		$data['frc_data'] = $this->Frc_model->get($data);
		$data['summary'] = $this->Frc_model->get_summary($data);
		$data['content'] = $this->load->view('admin/FRC/return/list_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/FRC/return/list_return', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function return_print($id)
	{


		$data['data'] = $this->Frc_model->get_stock_value_by_id($id);
		//print_r($data['data']);exit;
		$data['pdf'] = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$this->load->view('admin/FRC/return/return_print', $data);
	}
	public function return_print_multiple()
	{
		if (isset($_POST['ids'])) {
			$ids =  $this->security->xss_clean($_POST['ids']);
			//print_r($_POST['ids']);exit;
			foreach ($ids as $value) {
				if ($value != "") {
					$data['data'][] = $this->Frc_model->get_stock_value_by_id($value);
				}
			}
		}
		
		if(isset($_POST['barcode'])){
			$data['barcode'] =  $this->security->xss_clean($_POST['barcode']);
			$data['data'][] = $this->Frc_model->get_stock_value_by_id($data);
		}
		//pre($data['data']);exit;
		if($data['data'][0]!=''){
			// echo '<pre>';	print_r($data['data']);exit;
			$data['title'] = $_POST['title'];
			if ($_POST['type'] == 'receive') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/recieve/view_print', $data, TRUE);
			} elseif ($_POST['type'] == 'return') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/return/view_print', $data, TRUE);
			} elseif ($_POST['type'] == 'pbc') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/2ndpbc/view_print', $data, TRUE);
			} elseif ($_POST['type'] == 'tc') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/tc/view_print', $data, TRUE);
			} elseif ($_POST['type'] == 'stock') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/stock/view_print', $data, TRUE);
			} elseif ($_POST['type'] == 'barcode') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/stock/print_multiple', $data, TRUE);
			} elseif ($_POST['type'] == 'barcode1') {
				$data['frc_data'] = $data['data'];
				$data['main_content'] = $this->load->view('admin/FRC/stock/print_multiple2', $data, TRUE);
			} else {
				$data['main_content'] = 'No Result Found';
			}


		} else {
			$data['main_content'] = 'No Result Found';
		}
		
		$this->load->view('admin/print/index', $data);
	}
	public function viewRecieve($id)
	{
		$data = array();
		$data['name'] = 'View List';
		$data['febName'] = $this->Common_model->febric_name();
		$data['frc_data'] = $this->Frc_model->get_by_id($id);
		$data['pbc'] = $this->Frc_model->get_frc_by_id($id);
		//echo "<pre>"; print_r($data['pbc']);exit;
		$data['main_content'] = $this->load->view('admin/FRC/recieve/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function viewReturn($id)
	{
		$data = array();
		$data['name'] = 'View List';
		$data['febName'] = $this->Common_model->febric_name();
		$data['frc_data'] = $this->Frc_model->get_by_id($id);
		$data['pbc'] = $this->Frc_model->get_frc_by_id($id);
		$data['main_content'] = $this->load->view('admin/FRC/return/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function viewtc($id)
	{
		$data = array();
		$data['name'] = 'View List';

		$data['frc_data'] = $this->Frc_model->get_by_id($id);
		$data['main_content'] = $this->load->view('admin/FRC/tc/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function ViewEditRecieve($id)
	{
		$data = array();
		$data['name'] = 'View List';
		$data['febName'] = $this->Common_model->febric_name();
		$data['sub_dept_data'] = $this->Sub_department_model->get();
		$data['frc_data'] = $this->Frc_model->get_frc_by_id($id);

		$data['pbc'] = $this->Frc_model->getPBC_by_type("fabric_challan_id", $id);
		$data['main_content'] = $this->load->view('admin/FRC/recieve/edit', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_stock($fabric = "")
	{
		$data = array();
		
		$fabric = sanitize_url($fabric);
		$data['febName'] = $this->Common_model->febric_name();
		$data['caption'] = 'Stock of Plain Fabric';
		if ($_POST) {
			//pre($_POST);exit;
			$data['from'] = $this->input->post('date_from');
			$data['to'] = $this->input->post('date_to');
			$data['search'] = $this->input->post('search');
			$data['type'] = $this->input->post('type');
			$caption = 'Search Result For : ';
			if ($_POST['search'] == 'simple') {
				if ($_POST['searchByCat'] != "" || $_POST['searchValue'] != "") {
					$data['cat'] = $this->input->post('searchByCat');
					$data['Value'] = $this->input->post('searchValue');
					$caption = $caption . $data['cat'] . " = " . $data['Value'] . " ";
					$data['caption'] = $caption;
				}
				
			} else {

				if (isset($_POST['challan_to']) && $_POST['challan_to'] != "") {
					$data['cat'][] = 'challan_to';
					$fab = $this->input->post('challan_to');
					$data['Value'][] = $fab;
					$caption = $caption . 'Godown' . " = " . $fab . " ";
				}
				if (isset($_POST['fabricName']) && $_POST['fabricName'] != "") {
					$data['cat'][] = 'fabricName';
					$fab = $this->input->post('fabricName');
					$data['Value'][] = $fab;
					$caption = $caption . 'Fabric Name' . " = " . $fab . " ";
				}
				if (isset($_POST['pbc']) && $_POST['pbc'] != "") {
					$data['cat'][] = 'parent_barcode';
					$fab = $this->input->post('pbc');
					$data['Value'][] = $fab;
					$caption = $caption . 'PBC' . " = " . $fab . " ";
				}
				if (isset($_POST['challan']) && $_POST['challan'] != "") {
					$data['cat'][] = 'challan_no';
					$fab = $this->input->post('challan');
					$data['Value'][] = $fab;
					$caption = $caption . 'Challan No' . " = " . $fab . " ";
				}

				if (isset($_POST['Color']) && $_POST['Color'] != "") {
					$data['cat'][] = 'color_name';
					$fab = $this->input->post('Color');
					$data['Value'][] = $fab;
					$caption = $caption . 'Color' . " = " . $fab . " ";
				}
				if (isset($_POST['Ad_No']) && $_POST['Ad_No'] != "") {
					$data['cat'][] = 'ad_no';
					$fab = $this->input->post('Ad_No');
					$data['Value'][] = $fab;
					$caption = $caption . 'Ad_no' . " = " . $fab . " ";
				}
				if (isset($_POST['unit']) && $_POST['unit'] != "") {
					$data['cat'][] = 'stock_unit';
					$fab = $this->input->post('unit');
					$data['Value'][] = $fab;
					$caption = $caption . 'Unit' . " = " . $fab . " ";
				}
				if (isset($_POST['rate']) && $_POST['rate'] != "") {
					$data['cat'][] = 'purchase_rate';
					$fab = $this->input->post('rate');
					$data['Value'][] = $fab;
					$caption = $caption . 'Purchase_Rate' . " = " . $fab . " ";
				}
				if (isset($_POST['total']) && $_POST['total'] != "") {
					$data['cat'][] = 'total_value';
					$fab = $this->input->post('total');
					$data['Value'][] = $fab;
					$caption = $caption . 'Total' . " = " . $fab . " ";
				}
				if (isset($_POST['current_stock']) && $_POST['current_stock'] != "") {
					$data['cat'][] = 'current_stock';
					$fab = $this->input->post('current_stock');
					$data['Value'][] = $fab;
					$caption = $caption . 'Curr_qty' . " = " . $fab . " ";
				}
				if (isset($_POST['fabric_type']) && $_POST['fabric_type'] != "") {
					$data['cat'][] = 'fabric_type';
					$fab = $this->input->post('fabric_type');
					$data['Value'][] = $fab;
					$caption = $caption . 'fab_type' . " = " . $fab . " ";
				}

				if (isset($data['cat']) && isset($data['Value'])) {
					//echo"<pre>";	print_r( $data); exit;
					$data['caption'] = $caption;
					
					
				} else {
					$this->session->set_flashdata('error', 'please enter some keyword');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} else {

			$data['type'] = 'stock';
			$data['to'] = date('Y-m-d');
			$data['from'] = date('Y-04-01');
			if ($fabric != '') {
				$data['fabric'] = $fabric;
			}

			
		}

		
		$data['frc_data'] = $this->Frc_model->get_stock($data);
		//echo '<pre>'; print_r($data['frc_data']['type']);exit;
		$data['content'] = $this->load->view('admin/FRC/stock/index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/FRC/stock/stock', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function show_tc()
	{
		$data = array();
		$data['name'] = 'TC List';
		$data['febName'] = $this->Common_model->febric_name();
		$data['type'] = 'tc';
		if ($_POST) {

			$data['from'] = $this->input->post('date_from');
			$data['to'] = $this->input->post('date_to');
			$data['caption'] = 'From : ' . $data['from'] . ' - To : ' . $data['to'];
		} else {
			$data['caption'] = 'TC List';
			$data['to'] = date('Y-m-d');
			$data['from'] = date('Y-04-01');
		}

		$data['frc_data'] = $this->Frc_model->get($data);
		$data['summary'] = $this->Frc_model->get_summary($data);
		$data['main_content'] = $this->load->view('admin/FRC/tc/tc_list', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function add_tc_list()
	{
		$data = array();
		$data['name'] = 'View List';

		$data['frc_data'] = $this->Frc_model->get_tc();
		$data['summary'] = $this->Frc_model->tc_summary();
		$data['content'] = $this->load->view('admin/FRC/tc/tc_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/FRC/tc/tc_add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function add_tc()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['pbc']);
			$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {
				$total_qty = $total_qty +  $data['cqty'][$i];
				$total_val = $total_val + $data['tc'][$i];
			}
			$id = $this->Frc_model->getId("tc");
			if (!$id) {
				$challan = "TC1";
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = "TC" . (string)$cc;
			}
			$data1 = [

				'challan_date' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],

				'challan_no' => $challan,
				'counter' => $cc,

				'total_pcs' => $count,
				'total_quantity' => $total_qty,
				'total_tc' => $total_val,


				'challan_type' => 'tc'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			$counter = $this->Frc_model->getCount('tc');
			$cc = $counter[0]['count'];
			// print_r($counter[0]['count']);exit;
			for ($i = 0; $i < $count; $i++) {
				$cc = $cc + 1;
				$pbc = "TCP" . (string)$cc;
				$data2 = [
					'fabric_challan_id' => $id,
					'parent_barcode' => $pbc,
					'parent' => $data['pbc'][$i],
					'challan_no' =>  $challan,
					'counter' => $cc,
					'fabric_id' => $data['fabric_id'][$i],
					'fabric_type' => $data['fabType'][$i],
					'created_date' => date('Y-m-d'),
					'hsn' => $data['hsn'][$i],
					'stock_quantity' => $data['sqty'][$i],
					'current_stock' => $data['cqty'][$i],
					'stock_unit' => $data['unit'][$i],
					'ad_no ' => $data['ADNo'][$i],
					'color_name ' => $data['color'][$i],
					'purchase_code' => $data['pcode'][$i],
					'purchase_rate' => $data['prate'][$i],
					'tc' => $data['tc'][$i],
					'isStock' => 0,
					'challan_type' => 'tc'

				];
				$this->Frc_model->insert($data2, 'fabric_stock_received');
				$data3 = [

					'isTc' => 1

				];
				$this->Frc_model->update($data3, 'fsr_id', $data['fsr_id'][$i], 'fabric_stock_received');
			}
		}
		$this->session->set_flashdata('success', 'Added Successfully!!');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function addPBC()
	{
		$data = array();
		$data['name'] = '2nd PBC';
		$data['febName'] = $this->Common_model->febric_name();
		$data['unit'] = $this->Frc_model->select('unit');
		$data['main_content'] = $this->load->view('admin/FRC/2ndpbc/2ndPbc', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function delete()
	{

		$ids = $this->input->post('ids');

		$userid = explode(",", $ids);
		if ($userid) {
			foreach ($userid as $value) {

				$this->Frc_model->update(array('deleted' => 1), 'fc_id', $value, 'fabric_challan');

				$this->Frc_model->update(array('deleted' => 1), 'fabric_challan_id', $value, 'fabric_stock_received');
			}
		} else {
			$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
		}
		$this->session->set_flashdata('success', 'Deleted Successfully!!');
	}

	public function delete_tc()
	{
		$id = $this->input->post('ids');

		$userid = explode(",", $id);
		if ($userid) {


			foreach ($userid as $value) {
				$pbc = $this->Frc_model->get_parent_barcode($value);
				print_r($pbc);
				exit;
				if ($pbc) {
					foreach ($pbc as $value1) {
						$data3 = [

							'tc' => $value1['tc']
						];
						$this->Frc_model->update($data3, 'parent_barcode', $value1['parent'], 'fabric_stock_received');
					}
					$this->Frc_model->update(array('deleted' => 1), 'fc_id', $value, 'fabric_challan');

					$this->Frc_model->update(array('deleted' => 1), 'fabric_challan_id', $value, 'fabric_stock_received');
				} else {
					$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
				}
			}
		} else {
			$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
		}
		$this->session->set_flashdata('success', 'Deleted Successfully!!');
	}

	public function deleteReturn()
	{
		$id = $this->input->post('ids');

		$userid = explode(",", $id);
		if ($userid) {

			foreach ($userid as $value) {
				$pbc = $this->Frc_model->get_parent_barcode($value);
				//print_r($pbc);exit;
				if ($pbc) {
					foreach ($pbc as $value1) {
						$data3 = [

							'isStock' => 1
						];
						$this->Frc_model->update($data3, 'parent_barcode', $value1['parent'], 'fabric_stock_received');
					}
					$this->Frc_model->update(array('deleted' => 1), 'fc_id', $value, 'fabric_challan');

					$this->Frc_model->update(array('deleted' => 1), 'fabric_challan_id', $value, 'fabric_stock_received');
				} else {
					$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
				}
			}
		} else {
			$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
		}
		$this->session->set_flashdata('success', 'Deleted Successfully!!');
	}
	public function addRecieve()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['hsn']);
			$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {
				for ($j = 0; $j < $data['pcs'][$i]; $j++) {
					$total_qty = $total_qty +  $data['qty'][$i];
					$total_val = $total_val + ($data['prate'][$i] * $data['qty'][$i]);
				}
			}
			$id = $this->Frc_model->getId("recieve");
			if (!$id) {
				$challan = "FRC1";
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = "FRC" . (string)$cc;
			}
			$data1 = [
				'challan_from' => $data['fromGodown'],
				'challan_to'  => $data['toGodown'],
				'challan_date' => $data['PBC_date'],
				'created_by' => $_SESSION['userID'],
				'doc_challan' =>  $data['Doc_challan'],
				'challan_no' => $challan,
				'counter' => $cc,

				'total_pcs' => $count,
				'total_quantity' => $total_qty,
				'total_amount' => $total_val,
				'fabric_type' => $data['fabType'][0],
				'unit' => $data['unit'][0],
				'challan_type' => 'recieve'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			$counter = $this->Frc_model->getCount('recieve');
			$cc = $counter[0]['count'];
			// print_r($counter[0]['count']);exit;
			for ($i = 0; $i < $count; $i++) {


				for ($j = 0; $j < $data['pcs'][$i]; $j++) {
					$cc = $cc + 1;
					$pbc = "U1P" . (string)$cc;
					$total =	($data['prate'][$i] * $data['qty'][$i]);
					$data2 = [
						'fabric_challan_id' => $id,
						'parent_barcode' => $pbc,
						'challan_no' =>  $challan,
						'counter' => $cc,
						'fabric_id' => $data['fabric_name'][$i],
						'fabric_type' => $data['fabType'][$i],
						'created_date' => $data['PBC_date'],
						'hsn' => $data['hsn'][$i],
						'stock_quantity' => $data['qty'][$i],
						'current_stock' => $data['qty'][$i],
						'stock_unit' => $data['unit'][$i],
						'ad_no ' => $data['ADNo'][$i],
						'color_name ' => $data['color'][$i],
						'purchase_code' => $data['pcode'][$i],
						'purchase_rate' => $data['prate'][$i],
						'total_value' => $total,
						'challan_type' => 'recieve'

					];
					$this->Frc_model->insert($data2, 'fabric_stock_received');
				}
			}
		}
		$this->session->set_flashdata('success', 'Added Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function save()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			//echo "<pre>"; print_r($data);exit;
			$count = count($data['hsn']);
			echo
				$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {
				$total_qty = $total_qty +  $data['qty'][$i];
				$total_val = $total_val + ($data['prate'][$i] * $data['qty'][$i]);
			}


			$data1 = [
				'challan_from' => $data['fromGodown'],
				'challan_to'  => $data['toGodown'],
				'challan_date' => $data['PBC_date'],
				'total_pcs' => $count,
				'total_quantity' => $total_qty,
				'doc_challan' =>  $data['Doc_challan'],

				'total_amount' => $total_val,

			];
			$this->Frc_model->update($data1, 'fc_id', $data['fc_id'], 'fabric_challan');

			for ($i = 0; $i < $count; $i++) {
				$total =	($data['prate'][$i] * $data['qty'][$i]);
				$data2 = [

					'fabric_id' => $data['fabric_name'][$i],
					'fabric_type' => $data['fabType'][$i],

					'hsn' => $data['hsn'][$i],
					'stock_quantity' => $data['qty'][$i],
					'current_stock' => $data['qty'][$i],
					'stock_unit' => $data['unit'][$i],
					'ad_no ' => $data['ADNo'][$i],
					'color_name ' => $data['color'][$i],
					'purchase_code' => $data['pcode'][$i],
					'purchase_rate' => $data['prate'][$i],
					'total_value' => $total,

				];
				$this->Frc_model->update($data2, 'fsr_id', $data['fsr_id'][$i], 'fabric_stock_received');
			}
		}

		$this->session->set_flashdata('success', 'Updated Successfully !!');

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function addFrc()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);

			//echo "<pre>"; print_r($data);exit;
			$count = count($data['pbc']);
			$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {

				$qty = $data['quantity'][$i];
				$prate = $data['prate'][$i];
				$total = $qty * $prate;
				$total_qty = $total_qty +  $qty;
				$total_val = $total_val + $total;
			}
			if ($total_val > 0 && $total_qty > 0) {


				$id = $this->Frc_model->getId("return");
				if (!$id) {
					$challan = "RET1";
				} else {
					$cc = $id[0]['count'];
					$cc = $cc + 1;
					$challan = "RET" . (string)$cc;
				}
				// echo "<pre>"; echo $total_val."\n";echo $total_qty; exit;
				$data1 = [
					'challan_from' => $data['fromGodown'],
					'challan_to'  => $data['toGodown'],
					'challan_date' => date('Y-m-d'),
					'created_by' => $_SESSION['userID'],
					'challan_no' => $challan,
					'counter' => $cc,
					'total_amount' => $total_val,
					'total_pcs' => $count,
					'total_quantity' => $total_qty,
					'fabric_type' => $data['fabType'][0],
					'challan_type' => 'return',

				];
				$id =	$this->Frc_model->insert($data1, 'fabric_challan');
				$counter = $this->Frc_model->getCount('return');
				$cc = $counter[0]['count'];
				// print_r($counter[0]['count']);exit;
				for ($i = 0; $i < $count; $i++) {
					if ($data['fabric_id'][$i] != "") {


						$cc = $cc + 1;
						$pbc = "RETP" . (string)$cc;
						$qty = $data['quantity'][$i];
						$prate = $data['prate'][$i];
						$total = $qty * $prate;
						$data2 = [
							'fabric_challan_id' => $id,
							'parent_barcode' => $pbc,
							'parent' => $data['pbc'][$i],
							'challan_no' =>  $challan,
							'counter' => $cc,
							'fabric_id' => $data['fabric_id'][$i],
							'fabric_type' => $data['fabType'][$i],
							'created_date' => date('Y-m-d'),
							'hsn' => $data['hsn'][$i],
							'stock_quantity' => $data['quantity'][$i],
							'current_stock' => $data['quantity'][$i],
							'stock_unit' => $data['unit'][$i],
							'ad_no ' => $data['ADNo'][$i],

							'purchase_code' => $data['pcode'][$i],
							'purchase_rate' => $data['prate'][$i],
							'total_value' => $total,
							'challan_type' => 'return',
							'isStock' => 0
						];
						$data3 = [

							'isStock' => 0
						];
						$this->Frc_model->update($data3, 'parent_barcode', $data['pbc'][$i], 'fabric_stock_received');
						$this->Frc_model->insert($data2, 'fabric_stock_received');
					}
				}
			} else {
				$this->session->set_flashdata('info', 'Please enter some value');
			}
		}

		$this->session->set_flashdata('success', 'Updated Successfully !!');

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function submitPbc()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['sno']);

			$data2 = [
				'current_stock' => $data['Cur_quantity'],
				'stock_quantity' => $data['Tquantity'],


			];
			$this->Frc_model->update($data2, 'parent_barcode', $data['pbc'], 'fabric_stock_received');
			$counter = $this->Frc_model->getCount_by_id($data['pbc']);
			if ($counter) {
				$cc = $counter[0]['count'];
			} else {
				$cc = 0;
			}

			for ($i = 0; $i < $count; $i++) {
				$cc = $cc + 1;
				$pbc = $data['pbc'] . '/' . (string)$cc;
				$data1 = [
					'parent_barcode' => $pbc,
					'parent' => $data['pbc'],
					'fabric_id' => $data['fabric_id'],
					'counter' => $cc,
					'hsn' => $data['hsn'],
					'fabric_type' => $data['fabtype'],
					'purchase_code' => $data['pcode'],
					'stock_quantity' => $data['quantity'][$i],
					'current_stock' => $data['quantity'][$i],
					'stock_unit' => $data['unit'],
					'created_date' => date('Y-m-d'),
					'challan_no' => $data['challan_no'],
					'ad_no ' => $data['ad_no'],
					'isSecond' => 1,
					'tc' => $data['tc'][$i],
					'color_name' => $data['color'][$i],
					'purchase_rate' => $data['rate'][$i],
					'total_value' => (float) $data['value'][$i],
				];

				$this->Frc_model->insert($data1, 'fabric_stock_received');
			}
		}

		$this->session->set_flashdata('success', 'Added Successfully !!');

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function Show_PBC()
	{
		$data = array();

		if ($_POST) {

			$data['from'] = $this->input->post('date_from');
			$data['to'] = $this->input->post('date_to');
			$data['caption'] = 'From : ' . $data['from'] . ' - To : ' . $data['to'];
		} else {
			$data['caption'] = 'Show PBC';
			$data['to'] = date('Y-m-d');
			$data['from'] = date('Y-04-01');
		}
		$data['frc_data'] = $this->Frc_model->select_PBC($data);
		$data['summary'] = $this->Frc_model->PBC_summary($data);
		$data['content'] = $this->load->view('admin/FRC/2ndpbc/list_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/FRC/2ndpbc/showPBC', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function edit2ndPbc($pbc)
	{
		$pbc = sanitize_url($pbc);
		$data = array();
		$data['name'] = 'Details';

		$data['pbc_data'] = $this->Frc_model->select_PBC_by_id($pbc);
		$data['main_content'] = $this->load->view('admin/FRC/2ndpbc/showPBC', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function delete2ndPbc($id, $parent, $qty)
	{
		$id = sanitize_url($id);
		$parent = sanitize_url($parent);
		$qty = sanitize_url($qty);
		$data = array();
		$data2 = ['current_stock' => $qty,];
		$this->Frc_model->update($data2, 'parent_barcode', $data['pbc'], 'fabric_stock_received');
	}

	public function getPBC()
	{
		$id = $this->security->xss_clean($_POST['id']);
		$data = array();
		$data['pbc'][] = $this->Frc_model->getPBC_deatils($id);
		$pbc = $this->Frc_model->getPBC_by_type('parent', $id);
		if ($pbc) {
			$output = "<table class='table table-bordered data-table text-center table-responsive'><thead><tr><th>Date</th><th>PBC</th><th>Fabric</th> <th>Color</th><th>Quantity</th><th>Current quantity</th>  <th>Unit</th><th>Rate</th><th>Value</th><th>TC</th></tr></thead>";

			foreach ($pbc as $value) {

				$output .= "<tr><td>" . $value['created_date'] . "</td>";
				$output .= "<td>" . $value['parent_barcode'] . "</td>";
				$output .= "<td>" . $value['fabricName'] . "</td>";
				$output .= "<td>" . $value['color_name'] . "</td>";
				$output .= "<td><b>" . $value['stock_quantity'] . "</b></td>";
				$output .= "<td><b>" . $value['current_stock'] . "</b></td>";
				$output .= "<td><b>" . $value['stock_unit'] . "</b></td>";
				$output .= "<td><b>" . $value['purchase_rate'] . "</b></td>";
				$output .= "<td><b>" . $value['total_value'] . "</b></td>";
				$output .= "<td>" . $value['tc'] . "</td></tr>";
			}
		} else {
			$output = "<div class='text-danger'><center>No Data Found</center></div>";
		}

		$data['pbc'][] = $output;
		echo json_encode($data['pbc']);
	}

	public function getPBC2()
	{

		$id = $this->security->xss_clean($_POST['id']);
		$From = $this->security->xss_clean($_POST['from']);
		$data = array();
		$data['pbc'] = $this->Frc_model->getPBC_by_godown($id, $From);
		if ($data['pbc']) {



			echo json_encode($data['pbc']);
		} else {

			$this->session->set_flashdata('info', 'Not found !!');
		}
	}


	public function	update_tc()
	{
		$pbc = $this->security->xss_clean($_POST['pbc']);
		$tc = $this->security->xss_clean($_POST['tc']);
		$qty = $this->security->xss_clean($_POST['qty']);
		//echo "pbc=".$pbc."\n";echo "tc=".$tc."\n";echo "qty=".$qty."\n";exit;
		$data3 = [
			'current_stock' => ($qty - $tc),
			'tc' => $tc,
			'isSecond' => 1
		];
		$done =	$this->Frc_model->update($data3, 'parent_barcode', $pbc, 'fabric_stock_received');
		if ($done) {
			$this->session->set_flashdata('success', 'Updated Successfully !!');
		} else {
			$this->session->set_flashdata('error', 'OOPs..  Something went wrong !!');
		}
	}

	public function getfabric()
	{
		$id = $this->security->xss_clean($_POST['id']);
		$data = array();
		$data['fabric'] = $this->Frc_model->getfabric_details($id);
		echo json_encode($data['fabric']);
	}

	public function filter()
	{
		$data1 = array();
		$this->security->xss_clean($_POST);
		if ($_POST) {
			//echo"<pre>";	print_r($_POST); exit;
			$data1['from'] = $this->input->post('date_from');
			$data1['to'] = $this->input->post('date_to');
			$data1['search'] = $this->input->post('search');
			$data1['type'] = $this->input->post('type');
			$data['from'] = $data1['from'];
			$data['to'] = $data1['to'];
			$data['type'] = $data1['type'];
			$caption = 'Search Result For : ';
			if ($data1['search'] == 'simple') {
				if ($_POST['searchByCat'] != "" || $_POST['searchValue'] != "") {
					$data1['cat'] = $this->input->post('searchByCat');
					$data1['Value'] = $this->input->post('searchValue');
					$caption = $caption . $data1['cat'] . " = " . $data1['Value'] . " ";
				}
				$data['frc_data'] = $this->Frc_model->search($data1);
			} else {

				if (isset($_POST['challan_to']) && $_POST['challan_to'] != "") {
					$data1['cat'][] = 'challan_to';
					$fab = $this->input->post('challan_to');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Godown' . " = " . $fab . " ";
				}
				if (isset($_POST['fabricName']) && $_POST['fabricName'] != "") {
					$data1['cat'][] = 'fabricName';
					$fab = $this->input->post('fabricName');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Fabric Name' . " = " . $fab . " ";
				}
				if (isset($_POST['pbc']) && $_POST['pbc'] != "") {
					$data1['cat'][] = 'parent_barcode';
					$fab = $this->input->post('pbc');
					$data1['Value'][] = $fab;
					$caption = $caption . 'PBC' . " = " . $fab . " ";
				}
				if (isset($_POST['challan']) && $_POST['challan'] != "") {
					$data1['cat'][] = 'challan_no';
					$fab = $this->input->post('challan');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Challan No' . " = " . $fab . " ";
				}
				if (isset($_POST['challan_no']) && $_POST['challan_no'] != "") {
					$data1['cat'][] = 'challan_no';
					$fab = $this->input->post('challan_no');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Challan No' . " = " . $fab . " ";
				}
				if (isset($_POST['Color']) && $_POST['Color'] != "") {
					$data1['cat'][] = 'color_name';
					$fab = $this->input->post('Color');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Color' . " = " . $fab . " ";
				}
				if (isset($_POST['Ad_No']) && $_POST['Ad_No'] != "") {
					$data1['cat'][] = 'ad_no';
					$fab = $this->input->post('Ad_No');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Ad_no' . " = " . $fab . " ";
				}
				if (isset($_POST['unit']) && $_POST['unit'] != "") {
					$data1['cat'][] = 'stock_unit';
					$fab = $this->input->post('unit');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Unit' . " = " . $fab . " ";
				}
				if (isset($_POST['rate']) && $_POST['rate'] != "") {
					$data1['cat'][] = 'purchase_rate';
					$fab = $this->input->post('rate');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Purchase_Rate' . " = " . $fab . " ";
				}
				if (isset($_POST['total']) && $_POST['total'] != "") {
					$data1['cat'][] = 'total_value';
					$fab = $this->input->post('total');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Total' . " = " . $fab . " ";
				}
				if (isset($_POST['current_stock']) && $_POST['current_stock'] != "") {
					$data1['cat'][] = 'current_stock';
					$fab = $this->input->post('current_stock');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Curr_qty' . " = " . $fab . " ";
				}
				if (isset($_POST['fabric_type']) && $_POST['fabric_type'] != "") {
					$data1['cat'][] = 'fabric_type';
					$fab = $this->input->post('fabric_type');
					$data1['Value'][] = $fab;
					$caption = $caption . 'fab_type' . " = " . $fab . " ";
				}
				if (isset($_POST['sb1_subDeptName']) && $_POST['sb1_subDeptName'] != "") {
					$data1['cat'][] = 'sb1.subDeptName';
					$fab = $this->input->post('sb1_subDeptName');
					$data1['Value'][] = $fab;
					$caption = $caption . 'subDeptName' . " = " . $fab . " ";
				}
				if (isset($_POST['total_quantity']) && $_POST['total_quantity'] != "") {
					$data1['cat'][] = 'total_quantity';
					$fab = $this->input->post('total_quantity');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_quantity' . " = " . $fab . " ";
				}
				if (isset($_POST['total_amount']) && $_POST['total_amount'] != "") {
					$data1['cat'][] = 'total_amount';
					$fab = $this->input->post('total_amount');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_amount' . " = " . $fab . " ";
				}
				if (isset($_POST['doc_challan']) && $_POST['doc_challan'] != "") {
					$data1['cat'][] = 'doc_challan';
					$doc_challan = $this->input->post('doc_challan');
					$data1['Value'][] = $doc_challan;
					$caption = $caption . 'Doc Challan' . " = " . $doc_challan . " ";
				}
				if (isset($_POST['challan_from']) && $_POST['challan_from'] != "") {
					$data1['cat'][] = 'challan_from';
					$fab = $this->input->post('challan_from');
					$data1['Value'][] = $fab;
					$caption = $caption . 'challan from' . " = " . $fab . " ";
				}
				if (isset($_POST['challan_to']) && $_POST['challan_to'] != "") {
					$data1['cat'][] = 'challan_to';
					$fab = $this->input->post('challan_to');
					$data1['Value'][] = $fab;
					$caption = $caption . 'challan To' . " = " . $fab . " ";
				}
				if (isset($_POST['stock_quantity']) && $_POST['stock_quantity'] != "") {
					$data1['cat'][] = 'stock_quantity';
					$fab = $this->input->post('stock_quantity');
					$data1['Value'][] = $fab;
					$caption = $caption . 'stock_quantity' . " = " . $fab . " ";
				}
				if (isset($_POST['total_pcs']) && $_POST['total_pcs'] != "") {
					$data1['cat'][] = 'total_pcs';
					$fab = $this->input->post('total_pcs');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_pcs' . " = " . $fab . " ";
				}
				if (isset($_POST['total_tc']) && $_POST['total_tc'] != "") {
					$data1['cat'][] = 'total_tc';
					$fab = $this->input->post('total_tc');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_tc' . " = " . $fab . " ";
				}
				if (isset($data1['cat']) && isset($data1['Value'])) {
					//echo"<pre>";	print_r( $data1); exit;
					$data['frc_data'] = $this->Frc_model->search($data1);
				} else {
					$this->session->set_flashdata('error', 'please enter some keyword');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			if ($data1['type'] == 'stock') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['content'] = $this->load->view('admin/FRC/stock/index', $data, TRUE);
				$data['main_content'] = $this->load->view('admin/FRC/stock/stock', $data, TRUE);
				$this->load->view('admin/index', $data);
			} elseif ($data1['type'] == 'pbc') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['content'] = $this->load->view('admin/FRC/2ndpbc/list_index', $data, TRUE);
				$data['main_content'] = $this->load->view('admin/FRC/2ndpbc/showPBC', $data, TRUE);

				$this->load->view('admin/index', $data);
			} elseif ($data1['type'] == 'tc') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['summary'] = $this->Frc_model->get_summary($data);
				// $data['content'] = $this->load->view('admin/FRC/recieve/list_index', $data, TRUE);
				$data['main_content'] = $this->load->view('admin/FRC/tc/tc_list', $data, TRUE);
				$this->load->view('admin/index', $data);
			} elseif ($data1['type'] == 'return') {

				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['summary'] = $this->Frc_model->get_summary($data);
				$data['content'] = $this->load->view('admin/FRC/return/list_index', $data, TRUE);
				$data['main_content'] = $this->load->view('admin/FRC/return/list_return', $data, TRUE);
				$this->load->view('admin/index', $data);
			} elseif ($data1['type'] == 'recieve') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['summary'] = $this->Frc_model->get_summary($data);
				$data['content'] = $this->load->view('admin/FRC/recieve/list_index', $data, TRUE);
				$data['main_content'] = $this->load->view('admin/FRC/recieve/list_recieve', $data, TRUE);
				$this->load->view('admin/index', $data);
			} else {
				$data['main_content'] = $this->load->view('admin/FRC/stock/search');
				$this->load->view('admin/index', $data);
			}
		}
	}
}
