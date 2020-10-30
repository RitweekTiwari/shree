<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dye_transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();


		$this->load->model('Common_model');
		$this->load->model('Job_work_party_model');
		$this->load->model('DyeTransaction_model');
		$this->load->model('Transaction_model');
	}

	public function recieve_obc()
	{
		$obc = $this->security->xss_clean($_POST['obc']);
		$trans_id = $this->security->xss_clean($_POST['trans_id']);
		$id = $this->security->xss_clean($_POST['godown']);
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$plain[] = $row['godownid'];
		}
		//print_r($plain_godown);exit;
		try {

			$status = $this->Transaction_model->check_obc_by_trans_id($obc, $trans_id);
			//echo "<pre>"; print_r($status);exit;
			if ($status) {

				$data['stat'] = 'recieved';
				$st =	$this->Transaction_model->update($data, 'trans_meta_id', $status->trans_meta_id, "transaction_meta");
				if (in_array($id, $plain)) {
					$data = array();
					$data['isStock'] = 1;
					$data['color_name'] = $status->color;
					$st1 =	$this->Transaction_model->update($data, 'parent_barcode', $obc, "fabric_stock_received");
					if ($st1) {
						echo "1";
					} else {
						echo "2";
					}
				} else {
					if ($st) {
						echo "1";
					} else {
						echo "2";
					}
				}
			} else {
				echo "0";
			}
		} catch (\Exception $e) {
			$error = $e->getMessage();
			echo $error;
		}
	}

	public function viewChallanOut($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_trans_by_id($id);
		$data['frc_data'] = $this->DyeTransaction_model->get_by_id($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['to_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub2'] . '  DASHBOARD /' . $link;
		$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
		$data['branch_data'] = $this->Job_work_party_model->get();
		$data['id'] = $id;

		//echo "<pre>"; print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/dye_transaction/issue/viewOut', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showDyeOutList($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$data['id'] = $godown;
		// $data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye');


		$data['main_content'] = $this->load->view('admin/transaction/dye_out', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showDyeOutListdata($godown)
	{
		$output = array();
		$data = array();
		$record = array();
		$data1 = array();
		$caption = '';
		if ($_POST) {

			if (!empty($_POST["search"]["value"])) {
				//pre($_POST["search"]["value"]);exit;
				$data1['Value'] = $_POST["search"]["value"];
				$data1['search'] = 'search';

				$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye', $data1);
			} elseif (!empty($_POST["filter"])) {
				// pre($_POST["filter"]);exit;

				if ($_POST['filter']['search'] == 'simple') {
					if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
						$data1['cat'] = $_POST['filter']['searchByCat'];
						$data1['Value'] = $_POST['filter']['searchValue'];

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
					}
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye', $data1);
				} elseif ($_POST['filter']['search'] == 'advance') {
					// if(isset($_POST['filter']['challan_in']) && $_POST['filter']['challan_in']!="" ){
					// 	$data1['cat'][]='challan_in';
					// 	$fab=$_POST['filter']['challan_in'];
					// 	$data1['Value'][]=$fab;
					// 	$caption=$caption.'Challan No'." = ".$fab." ";
					// 	}

					if (isset($_POST['filter']['challan_out']) && $_POST['filter']['challan_out'] != "") {
						$data1['cat'][] = 'challan_out';
						$fab = $_POST['filter']['challan_out'];
						$data1['Value'][] = $fab;
						$caption = $caption . 'Doc Challan' . " = " . $fab . " ";
					}

					if (isset($_POST['filter']['subDeptName']) && $_POST['filter']['subDeptName'] != "") {
						$data1['cat'][] = 'sb1.subDeptName';
						$fab = $_POST['filter']['subDeptName'];
						$data1['Value'][] = $fab;
						$caption = $caption . 'subDeptName' . " = " . $fab . " ";
					}

					if (isset($data1['cat']) && isset($data1['Value'])) {

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
						$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye', $data1);
					} else {
						$this->session->set_flashdata('error', 'please enter some keyword');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} elseif ($_POST['filter']['search'] == 'datefilter') {

					$data1['to'] = $_POST['filter']['to'];
					$data1['from'] = $_POST['filter']['from'];
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye', $data1);
				}
			} else {
				$data1['to'] = date('Y-m-d');
				$data1['from'] = date('Y-04-01');
				$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye', $data1);
				// pre($data['frc_data']);exit;
			}
			//pre($data['frc_data']);exit;
		}
		foreach ($data['frc_data'] as $value) {

			$sub_array = array();
			$sub_array[] = '<input type="checkbox" class="sub_chk" data-id=' . $value['transaction_id'] . '>';
			$sub_array[] = $value['created_at'];
			$sub_array[] = $value['sub2'];
			$sub_array[] = $value['challan_out'];
			$sub_array[] =  '	<a class="text-center tip"  href="' .  base_url('admin/Dye_transaction/viewChallanOut/') . $value['transaction_id'] . ' ">
					<i class="fa fa-eye" aria-hidden="true"></i></a>';
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

	public function addChallan($godown)
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			//echo "<pre>"; print_r($data);exit;
			$count = count($data['pbc']);
			$id = $this->Transaction_model->getId('from_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['FromGodown'], 'arr');
			if (!$id) {
				$challan1 =
					$godown_name->outPrefix  . $godown_name->outStart .  $godown_name->outSuffix;
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan1 = $godown_name->outPrefix . (string) $cc .  $godown_name->outSuffix;
			}
			$id = $this->Transaction_model->getId1('to_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['ToGodown'], 'arr');
			if (!$id) {
				$challan2 =  $godown_name->inPrefix .  $godown_name->inStart . $godown_name->inSuffix;
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$challan2 = $godown_name->inPrefix .  (string) $cc1 .  $godown_name->inSuffix;
			}
			$data1 = [
				'from_godown' => $data['FromGodown'],
				'to_godown'  => $data['ToGodown'],
				'fromParty' => $data['FromParty'],
				'toParty'  => $data['toParty'],
				'created_at' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],
				'challan_out' => $challan1,
				'challan_in' => $challan2,
				'counter' => $cc,
				'counter2' => $cc1,
				'pcs' => $count,
				'jobworkType' => $data['workType'],

				'transaction_type' => 'dye'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				if ($_POST['color'][$i]) {
					$data2 = [
						'transaction_id' => $id,

						'order_barcode' => $data['pbc'][$i],

						'color ' => $data['color'][$i],

					];

					$this->Transaction_model->insert($data2, 'transaction_meta');
					$this->Transaction_model->update(array('isStock' => 0), 'parent_barcode', $data['pbc'][$i],  'fabric_stock_received');
					$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function viewDye($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_trans_by_id($id);

		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['to_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub2'] . '  DASHBOARD /' . $link;
		$data['godown'] = $data['trans_data'][0]['to_godown'];
		$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
		$data['id'] = $id;
		$data['branch_data'] = $this->Job_work_party_model->get();
		//echo "<pre>"; print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/dye_transaction/issue/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	
	public function showDyeInList($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$data['id'] = $godown;
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		// $data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye');
		$data['main_content'] = $this->load->view('admin/transaction/dye_in', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showDyeInListdata($godown)
	{
		$output = array();
		$data = array();
		$record = array();
		$data1 = array();
		$caption = '';
		if ($_POST) {

			if (!empty($_POST["search"]["value"])) {
				//pre($_POST["search"]["value"]);exit;
				$data1['Value'] = $_POST["search"]["value"];
				$data1['search'] = 'search';

				$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye', $data1);
			} elseif (!empty($_POST["filter"])) {
				// pre($_POST["filter"]);exit;

				if ($_POST['filter']['search'] == 'simple') {
					if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
						$data1['cat'] = $_POST['filter']['searchByCat'];
						$data1['Value'] = $_POST['filter']['searchValue'];

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
					}
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye', $data1);
				} elseif ($_POST['filter']['search'] == 'advance') {
					if (isset($_POST['filter']['challan_in']) && $_POST['filter']['challan_in'] != "") {
						$data1['cat'][] = 'challan_in';
						$fab = $_POST['filter']['challan_in'];
						$data1['Value'][] = $fab;
						$caption = $caption . 'Challan No' . " = " . $fab . " ";
					}

					if (isset($_POST['filter']['challan_out']) && $_POST['filter']['challan_out'] != "") {
						$data1['cat'][] = 'challan_out';
						$fab = $_POST['filter']['challan_out'];
						$data1['Value'][] = $fab;
						$caption = $caption . 'Doc Challan' . " = " . $fab . " ";
					}

					if (isset($_POST['filter']['subDeptName']) && $_POST['filter']['subDeptName'] != "") {
						$data1['cat'][] = 'sb1.subDeptName';
						$fab = $_POST['filter']['subDeptName'];
						$data1['Value'][] = $fab;
						$caption = $caption . 'subDeptName' . " = " . $fab . " ";
					}

					if (isset($data1['cat']) && isset($data1['Value'])) {

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
						$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye', $data1);
					} else {
						$this->session->set_flashdata('error', 'please enter some keyword');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} elseif ($_POST['filter']['search'] == 'datefilter') {

					$data1['to'] = $_POST['filter']['to'];
					$data1['from'] = $_POST['filter']['from'];
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye', $data1);
				}
			} else {
				$data1['to'] = date('Y-m-d');
				$data1['from'] = date('Y-04-01');
				$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye', $data1);
				// pre($data['frc_data']);exit;
			}
			//pre($data['frc_data']);exit;
		}
		foreach ($data['frc_data'] as $value) {
			if ($value['status'] == 'new') {
				$challan = $value['challan_in'] . ' <span class="badge badge-pill badge-danger">New</span>';
			} else {
				$challan = $value['challan_in'];
			}
			$sub_array = array();
			$sub_array[] = '<input type="checkbox" class="sub_chk" data-id=' . $value['transaction_id'] . '>';
			$sub_array[] = $value['created_at'];
			$sub_array[] = $value['sub1'];
			$sub_array[] = $value['challan_out'];
			$sub_array[] = $challan;

			$sub_array[] =  '	<a class="text-center tip"  href="' .  base_url('admin/Dye_transaction/viewDye/') . $value['transaction_id'] . ' ">
							<i class="fa fa-eye" aria-hidden="true"></i></a>';
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

	public function getChallan($id)
	{
		$query = '';

		$output = array();

		$data = array();

		if (!empty($_GET["search"]["value"])) {

			$query .= 'SELECT * FROM transaction_meta WHERE transaction_id = "' . $id . '" AND';
			$query .= ' pbc LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR order_barcode LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR order_number LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR fabric_name LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR hsn LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR design_name LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR design_code LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR unit LIKE "%' . $_GET["search"]["value"] . '%" ';
		} else {

			$query .= 'SELECT transaction_meta.*,fsr.current_stock,fsr.stock_unit,fsr.current_stock,fabric.fabricName,fabric.fabHsnCode FROM transaction_meta join fabric_stock_received fsr on fsr.parent_barcode=transaction_meta.order_barcode
			Join fabric on fabric.id=fsr.fabric_id
			WHERE transaction_id = "' . $id . '" ';
		}

		if (!empty($_GET["order"])) {
			$query .= ' ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
		}

		if ($_GET["length"] != -1) {
			$query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
		}

		$sql = $this->db->query($query);
		$result = $sql->result_array();

		$filtered_rows = $sql->num_rows();

		$c = 1;
		$i = 1;
		foreach ($result as $value) {
			if ($value['stat'] == 'recieved') {
				$c += 1;
			}
			$i += 1;
			$sub_array = array();
			$sub_array[] = "<input type=checkbox class=sub_chk data-id=" . $value['transaction_id'] . ">";

			$sub_array[] = $value['order_barcode'];
			$sub_array[] = $value['fabricName'];
			$sub_array[] = $value['fabHsnCode'];
			$sub_array[] = $value['color'];
			$sub_array[] = $value['current_stock'];
			$sub_array[] =  $value['stock_unit'];

			$sub_array[] =  $value['stat'];
			$data[] = $sub_array;
		}
		if ($c == $i) {
			$recieved = true;
		} else {
			$recieved = false;
		}
		$output = array(
			"recieved" => $recieved,
			"draw" => intval($_GET["draw"]),
			"recordsTotal" => $filtered_rows,
			"recordsFiltered" => $filtered_rows,
			"data" => $data
		);

		echo json_encode($output);
	}
	public function showStock($godown)
	{
		$data=array();
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
		}
		$data['godownid'] = $godown;
		$data['frc_data'] = $this->DyeTransaction_model->get_stock($data);
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;



		
		//$data['godown_data'] = $this->Transaction_model->get_stock($godown);
		//echo "<pre>";print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/stock_dye', $data, TRUE);


		$this->load->view('admin/index', $data);
	}
	public function getPBC()
	{
		$id = $this->security->xss_clean($_POST['id']);
		$godown = $this->security->xss_clean($_POST['godown']);
		$data = array();
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}
		if (in_array($godown, $data['plain'])) {
			$data['pbc'] = $this->DyeTransaction_model->getPBC_deatils($id, $godown);
		} else {
			$data['pbc'] = $this->DyeTransaction_model->getPBC_order_deatils($id, $godown);
		}

		echo json_encode($data['pbc']);
	}


	public function get_godown()
	{
		$id = $this->security->xss_clean($_POST['party']);
		$data = array();
		$data['godown'] = $this->DyeTransaction_model->get_godown($id);
		echo json_encode($data['godown']);
	}
}
