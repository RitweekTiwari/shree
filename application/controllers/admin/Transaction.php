<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();


		$this->load->model('Common_model');
		$this->load->model('Job_work_party_model');
		$this->load->model('Transaction_model');
		$this->load->model('Sub_department_model');
		$this->load->model('Job_work_party_model');
		$this->load->model('DyeTransaction_model');
	}

	public function home($godown)

	{
		$data = array();
		$godown_name = $this->Transaction_model->get_godown_by_id($godown);
		$data['page_name'] = $godown_name . '  DASHBOARD';
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		$dye_godown = $this->Transaction_model->get_dye_godown();
		foreach ($dye_godown as $row) {
			$data['dye'][] = $row['subDeptName'];
		}
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}
		$data['godown'] = $godown;
		if (in_array($godown, $data['plain'])) {
			$data['main_content'] = $this->load->view('admin/transaction/index_plain', $data, TRUE);
		} else if ($godown == 19) {
			$data['main_content'] = $this->load->view('admin/transaction/index_finish', $data, TRUE);
		} else if (in_array($godown, $data['dye'])) {
			$data['main_content'] = $this->load->view('admin/transaction/index_dye', $data, TRUE);
		} else {
			$data['main_content'] = $this->load->view('admin/transaction/index', $data, TRUE);
		}
		$this->load->view('admin/index', $data);
	}

	public function showChallan($godown)
	{
		$data = array();
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}

		$data['id'] = $godown;
		$data['job'] = $this->Transaction_model->get_jobwork_by_id($godown);
		$data['branch_data'] = $this->Job_work_party_model->get();
		//echo print_r($data['fabric_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/challan/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showDispatch($godown)
	{
		$data = array();
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$data['id'] = $godown;
		$data['job'] = $this->Transaction_model->get_jobwork_by_id($godown);
		$data['branch_data'] = $this->Job_work_party_model->get();
		//echo print_r($data['fabric_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showDye($godown)
	{
		$data = array();
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$data['id'] = $godown;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}
		$data['job'] = $this->Transaction_model->get_jobwork_by_id($godown);
		$data['febName'] = $this->Common_model->febric_name();
		$data['unit'] = $this->DyeTransaction_model->select('unit');
		$data['branch_data'] = $this->Job_work_party_model->get();
		// pre($data['branch_data']);exit;
		$data['main_content'] = $this->load->view('admin/dye_transaction/issue/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showRecieve($godown)
	{
		$data = array();
		$data['page_name'] = '  DASHBOARD';

		$data['branch_data'] = $this->Job_work_party_model->get();

		$data['main_content'] = $this->load->view('admin/transaction/bill/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showRecieveList($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$data['id'] = $godown;

		$data['main_content'] = $this->load->view('admin/transaction/list_in', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showInListdata($godown)
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

				if ($godown == 23) {
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'all', $data1);
				} else {
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'challan', $data1);
				}
			} elseif (!empty($_POST["filter"])) {
				// pre($_POST["filter"]);exit;

				if ($_POST['filter']['search'] == 'simple') {
					if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
						$data1['cat'] = $_POST['filter']['searchByCat'];
						$data1['Value'] = $_POST['filter']['searchValue'];

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
					}
					if ($godown == 23) {
						$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'all', $data1);
					} else {
						$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'challan', $data1);
					}
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
						if ($godown == 23) {
							$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'all', $data1);
						} else {
							$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'challan', $data1);
						}
					} else {
						$this->session->set_flashdata('error', 'please enter some keyword');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} elseif ($_POST['filter']['search'] == 'datefilter') {

					$data1['to'] = $_POST['filter']['to'];
					$data1['from'] = $_POST['filter']['from'];
					if ($godown == 23) {
						$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'all', $data1);
					} else {
						$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'challan', $data1);
					}
				}
			} else {
				$data1['to'] = date('Y-m-d');
				$data1['from'] = date('Y-04-01');
				if ($godown == 23) {
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'all', $data1);
				} else {
					$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'challan', $data1);
				}
				// pre($data['frc_data']);exit;
			}
			//pre($data['frc_data']);exit;
		}
		foreach ($data['frc_data'] as $value) {

			$sub_array = array();
			$sub_array[] = '<input type="checkbox" class="sub_chk" data-id=' . $value['transaction_id'] . '>';
			$sub_array[] = $value['created_at'];
			$sub_array[] = $value['sub1'];
			$sub_array[] = $value['challan_out'];
			$sub_array[] = $value['challan_in'];

			$sub_array[] =  '	<a class="text-center tip"  href="' .  base_url('admin/Transaction/viewChallan/') . $value['transaction_id'] . ' ">
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
	public function showOutListdata($godown)
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

				if ($godown == 23) {
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'all', $data1);
				} else {
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'challan', $data1);
				}
			} elseif (!empty($_POST["filter"])) {
				// pre($_POST["filter"]);exit;

				if ($_POST['filter']['search'] == 'simple') {
					if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
						$data1['cat'] = $_POST['filter']['searchByCat'];
						$data1['Value'] = $_POST['filter']['searchValue'];

						$data1['to'] = $_POST['filter']['challan_to'];
						$data1['from'] = $_POST['filter']['challan_from'];
					}
					if ($godown == 23) {
						$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'all', $data1);
					} else {
						$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'challan', $data1);
					}
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
						if ($godown == 23) {
							$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'all', $data1);
						} else {
							$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'challan', $data1);
						}
					} else {
						$this->session->set_flashdata('error', 'please enter some keyword');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} elseif ($_POST['filter']['search'] == 'datefilter') {

					$data1['to'] = $_POST['filter']['to'];
					$data1['from'] = $_POST['filter']['from'];
					if ($godown == 23) {
						$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'all', $data1);
					} else {
						$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'challan', $data1);
					}
				}
			} else {
				$data1['to'] = date('Y-m-d');
				$data1['from'] = date('Y-04-01');
				if ($godown == 23) {
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'all', $data1);
				} else {
					$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'challan', $data1);
				}
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
			$sub_array[] =  '	<a class="text-center tip"  href="' .  base_url('admin/Transaction/viewChallanOut/') . $value['transaction_id'] . ' ">
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
	public function showDispatch_list($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;

		$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dispatch');
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/list_dispatch', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_TC($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}

		$data['id'] = $godown;

		$data['main_content'] = $this->load->view('admin/transaction/tc/create', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_Add_TC($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}
		$data['data'] = $this->Transaction_model->get_tc($godown);
		//echo "<pre>";print_r($data['data']);exit;	
		$data['id'] = $godown;
		$data['content'] = $this->load->view('admin/transaction/tc/tc_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/transaction/tc/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_TC_list($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		foreach ($plain_godown as $row) {
			$data['plain'][] = $row['godownid'];
		}
		$data['data'] = $this->Transaction_model->get('from_godown', $godown, 'tc');
		$data['id'] = $godown;

		$data['main_content'] = $this->load->view('admin/transaction/tc/tc_list', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function showReturnList($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;

		$data['id'] = $godown;
		$data['main_content'] = $this->load->view('admin/transaction/list_out', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function showStock($godown)
	{
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
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['godownid'] = $godown;
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
		$found = 0;
		foreach ($plain_godown as $row) {
			if ($godown == $row['godownid']) {
				$found = 1;
				$data['plain_data'] = $this->Transaction_model->get_plain_stock($data);
				$data['frc_data'] = $this->Transaction_model->get_frc_stock($data);

				//echo "<pre>";print_r($data['godown_data']);exit;
				$data['main_content'] = $this->load->view('admin/transaction/stock_plain', $data, TRUE);
			}
		}
		if ($found == 0) {
			if ($godown == 23) {
				$data['frc_data'] = $this->Transaction_model->get_stock($godown, 'all');
			} else {
				$data['frc_data'] = $this->Transaction_model->get_stock($godown, 'challan');
			}

			$data['main_content'] = $this->load->view('admin/transaction/stock', $data, TRUE);
		}


		$this->load->view('admin/index', $data);
	}

	public function viewChallan($id)
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
		$data['main_content'] = $this->load->view('admin/transaction/challan/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function viewChallanOut($id = 0)
	{
		if (isset($_POST['challan_id'])) {


			$ids =  $this->security->xss_clean($_POST['challan_id']);

			foreach ($ids as $value) {
				if ($value != "") {

					$data = array();
					$data['trans_data'] = $this->Transaction_model->get_trans_by_id($value);
					$data['frc_data'] = $this->Transaction_model->get_by_id($value);
					$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['from_godown'] . '>Home</a>';
					$data['page_name'] = $data['trans_data'][0]['sub1'] . '  DASHBOARD /' . $link;
					$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
					$data['branch_data'] = $this->Job_work_party_model->get();
					$data['id'] = $value;
					$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
					foreach ($plain_godown as $row) {
						$data['plain'][] = $row['godownid'];
					}
					if (in_array($data['trans_data'][0]['from_godown'], $data['plain'])) {
						$data['is_plain'] = 0;
					} else {
						$data['is_plain'] = 1;
					}
				}
			}
			$data['main_content'] = $this->load->view('admin/transaction/challan/viewOutPrint', $data, TRUE);
			$this->load->view('admin/print/index', $data);
		} else {

			$data = array();
			$data['trans_data'] = $this->Transaction_model->get_trans_by_id($id);
			$data['frc_data'] = $this->Transaction_model->get_by_id($id);
			$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['from_godown'] . '>Home</a>';
			$data['page_name'] = $data['trans_data'][0]['sub1'] . '  DASHBOARD /' . $link;
			$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
			$data['branch_data'] = $this->Job_work_party_model->get();
			$data['id'] = $id;
			$plain_godown = $this->Transaction_model->get_distinct_plain_godown();
			foreach ($plain_godown as $row) {
				$data['plain'][] = $row['godownid'];
			}
			if (in_array($data['trans_data'][0]['from_godown'], $data['plain'])) {
				$data['is_plain'] = 0;
			} else {
				$data['is_plain'] = 1;
			}
			$data['main_content'] = $this->load->view('admin/transaction/challan/viewOut', $data, TRUE);
			$this->load->view('admin/index', $data);
		}
	}
	public function viewDispatch($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_dispatch($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['from_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub1'] . '  DASHBOARD /' . $link;

		$data['id'] = $id;

		$data['main_content'] = $this->load->view('admin/transaction/dispatch/view', $data, TRUE);

		$this->load->view('admin/index', $data);
	}
	public function viewtc($id)
	{
		$data = array();
		$data['data'] = $this->Transaction_model->view_tc($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['data'][0]['from_godown'] . '>Home</a>';
		$data['page_name'] = $data['data'][0]['sub1'] . '  DASHBOARD /' . $link;

		$data['id'] = $id;

		$data['main_content'] = $this->load->view('admin/transaction/tc/view', $data, TRUE);

		$this->load->view('admin/index', $data);
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

			$query .= 'SELECT * FROM godown_stock_view  WHERE transaction_id = "' . $id . '" ';
		}

		if (!empty($_GET["order"])) {
			$query .= ' ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
		} else {
			$query .= ' ORDER BY order_barcode ASC ';
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
			$sub_array[] = $value['pbc'];
			$sub_array[] = $value['order_barcode'];
			$sub_array[] = $value['order_number'];
			$sub_array[] = $value['fabric_name'];
			$sub_array[] = $value['hsn'];
			$sub_array[] = $value['design_name'];
			$sub_array[] = $value['design_code'];
			$sub_array[] = $value['dye'];
			$sub_array[] = $value['matching'];
			$sub_array[] = $value['quantity'];
			$sub_array[] =  $value['unit'];
			$sub_array[] =   $value['image'];

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
	public function recieve()
	{
		$id = $this->security->xss_clean($_POST['trans_id']);
		$data['status'] = 'old';
		$this->Transaction_model->update($data, 'transaction_id', $id, "transaction");
		redirect($_SERVER['HTTP_REFERER']);
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
					$data['status'] = 'DONE';
					$data['godown'] = $id;
					$st1 =	$this->Transaction_model->update($data, 'order_barcode', $obc, "order_product");
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


	public function print_packing_slip()
	{
		if (isset($_POST['ids'])) {


			$ids =  $this->security->xss_clean($_POST['ids']);


			//print_r($_POST['ids']);exit;
			foreach ($ids as $value) {
				if ($value != "") {

					$data1['id'] = $value;
					$r = $this->Transaction_model->get_dispatch($data1);

					$data['trans_data'][] = $r[0];
				}
			}
		}
		if (isset($_POST['challan_id'])) {


			$ids =  $this->security->xss_clean($_POST['challan_id']);


			//print_r($_POST['ids']);exit;
			foreach ($ids as $value) {
				if ($value != "") {

					$data1['challan_id'] = $value;
					$data['trans_data'] = $this->Transaction_model->get_dispatch($data1);
				}
			}
		}
		//echo '<pre>';	print_r($data['trans_data']);exit;
		if (count($data['trans_data']) > 0) {
			$date = date_create($data['trans_data'][0]['created_at']);

			$html = '<center><h1>SHREE NIKETAN SAREES PVT. LTD. CHANDAULI</h1></center>';
			$html = $html . '<center><h4 >PACKING SLIP</h4></center>';
			$html = $html . 'To :' . $data['trans_data'][0]['Party_name'] . '';
			$html = $html . '<span style="float:right">Challan no :' . $data['trans_data'][0]['challan_out'] . '</span><br>';
			$html = $html . '<div style="float:right">Date :' . date_format($date, "d/m/y ") . '</div>';
			$data['title'] = 'SHREE NIKETAN SAREES PVT. LTD. CHANDAULI';
			$data['head'] = $html;

			$data['main_content'] = $this->load->view('admin/transaction/dispatch/index', $data, TRUE);
		} else {
			$data['main_content'] = "No result Found";
		}

		$this->load->view('admin/print/index', $data);
	}
	public function return_print_multiple()
	{
		$type =  $this->security->xss_clean($_POST['type']);
		if (isset($_POST['ids'])) {
			$ids =  $this->security->xss_clean($_POST['ids']);
			$godown =  $this->security->xss_clean($_POST['godown']);

			//print_r($_POST['ids']);exit;
			foreach ($ids as $value) {
				if ($value != "") {
					$data1['godown'] = $godown;
					$data1['id'] = $value;
					if ($type == 'tc') {
						$r = $this->Transaction_model->get_tc_stock($data1);
					} else {
						$r = $this->Transaction_model->get_stock($data1, 'challan');
					}
					if (isset($r[0])) {
						$data['data'][] = $r[0];
					}
				}
			}
		}

		if (isset($_POST['barcode'])) {
			$data['godown'] =  $this->security->xss_clean($_POST['godown']);
			$data['barcode'] =  $this->security->xss_clean($_POST['barcode']);
			$r = $this->Transaction_model->get_stock_by_obc($data);
			if (isset($r[0])) {
				$data['data'][] = $r[0];
			}
		}

		if (isset($data['data'])  && $data['data'][0] != '') {
			//echo '<pre>';	print_r($data['data']);exit;
			if ($type == 'barcode2') {
				$data['main_content'] = $this->load->view('admin/transaction/dispatch/print', $data, TRUE);
			} else if ($type == 'tc') {
				$data['main_content'] = $this->load->view('admin/transaction/tc/print', $data, TRUE);
			} else {
				$data['main_content'] = $this->load->view('admin/transaction/challan/multi_list_print', $data, TRUE);
			}
		} else {
			$data['main_content'] = 'No Result Found';
		}
		$this->load->view('admin/print/index', $data);
	}

	public function delete()
	{

		$ids = $this->input->post('ids');

		$userid = explode(",", $ids);
		foreach ($userid as $value) {
			$this->db->delete('transaction', array('transaction_id' => $value));
			$this->db->delete('transaction_meta', array('transaction_id' => $value));
		}
	}

	public function addBill()
	{
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['pbc']);
			$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {
				$total_qty = $total_qty +  $data['qty'][$i];
				$total_val = $total_val + $data['total'][$i];
			}
			$id = $this->Transaction_model->getId();
			if (!$id) {
				$challan = "OUT1";
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = "OUT" . (string) $cc;
			}
			$data1 = [
				'challan_from' => $data['fromGodown'],
				'challan_to'  => $data['toGodown'],
				'challan_date' => $data['PBC_date'],
				'created_by' => $_SESSION['userID'],
				'challan_out' =>  $data['PBC_challan'],
				'total_pcs' => $count,
				'total_quantity' => $total_qty,
				'total_amount' => $total_val,
				'fabric_type' => $data['fabType'][0],
				'unit' => $data['unit'][0],
				'challan_type' => 'bill'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			for ($i = 0; $i < $count; $i++) {
				$data2 = [
					'fabric_challan_id' => $id,
					'parent_barcode' => $data['pbc'][$i],
					'fabric_id' => $data['fabric_name'][$i],
					'fabric_type' => $data['fabType'][$i],
					'hsn' => $data['hsn'][$i],
					'stock_quantity' => $data['qty'][$i],
					'stock_unit' => $data['unit'][$i],
					'ad_no ' => $data['ADNo'][$i],
					'color_name ' => $data['color'][$i],
					'purchase_code' => $data['pcode'][$i],
					'purchase_rate' => $data['prate'][$i],
					'total_value' => $data['total'][$i]
				];
				$this->Transaction_model->insert($data2, 'fabric_stock_received');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function addTC()
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['fquantity']);

			for ($i = 0; $i < $count; $i++) {
				$data2 = [

					'finish_qty ' => $data['fquantity'][$i],
					'is_tc' => 0
				];


				$this->Transaction_model->update($data2, 'trans_meta_id', $data['id'][$i],  'transaction_meta');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function add_tc_challan($godown)
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['obc']);
			$id = $this->Transaction_model->getId('from_godown', $godown, 'tc');
			if (!$id) {
				$challan = 'TC/1';
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = 'TC' . (string) $cc;
			}
			$data1 = [
				'from_godown' => $godown,

				'created_at' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],
				'challan_out' => $challan,
				'counter' => $cc,
				'pcs' => $count,
				'jobworkType' => "",

				'transaction_type' => 'tc'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				$data2 = [
					'transaction_id' => $id,

					'order_barcode' => $data['obc'][$i],
					'quantity ' => $data['cqty'][$i],
					'finish_qty ' => $data['fqty'][$i],

				];
				$this->Transaction_model->update(array('is_tc' => 1), 'trans_meta_id', $data['id'][$i],  'transaction_meta');

				$this->Transaction_model->insert($data2, 'transaction_meta');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function addChallan($godown)
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r(count($data['obc']));exit;
			$count = count($data['obc']);
			$id = $this->Transaction_model->getId('from_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['FromGodown'], 'arr');
			if (!$id) {
				$challan1 =
					$godown_name->outPrefix . $godown_name->outStart . $godown_name->outSuffix;
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan1 = $godown_name->outPrefix .  (string) $cc .  $godown_name->outSuffix;
			}
			$id = $this->Transaction_model->getId1('to_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['ToGodown'], 'arr');
			if (!$id) {
				$challan2 =  $godown_name->inPrefix .  $godown_name->inStart .  $godown_name->inSuffix;
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$challan2 = $godown_name->inPrefix . (string) $cc .  $godown_name->inSuffix;
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

				'transaction_type' => 'challan'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				if ($_POST['quantity'][$i]) {
					$data2 = [
						'transaction_id' => $id,

						'order_barcode' => $data['obc'][$i],
						'quantity ' => $data['quantity'][$i],
						'finish_qty ' => $data['quantity'][$i],

					];

					$this->Transaction_model->insert($data2, 'transaction_meta');
					$this->Transaction_model->update(array('status' => 'OUT'), 'order_barcode', $data['obc'][$i],  'order_product');
					$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function addDispatch($godown)
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['obc']);
			$id = $this->Transaction_model->getId('from_godown', $godown, 'dispatch');
			if (!$id) {
				$challan = 'PKG-SL/1';
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = 'PKG-SL/' . (string) $cc;
			}
			$data1 = [
				'from_godown' => $data['FromGodown'],
				'to_godown'  => $data['ToGodown'],
				'fromParty' => $data['FromParty'],
				'toParty'  => $data['toParty'],
				'created_at' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],
				'challan_out' => $challan,
				'challan_in' => $challan,
				'counter' => $cc,
				'pcs' => $count,
				'jobworkType' => $data['workType'],

				'transaction_type' => 'dispatch'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				if ($data['quantity'][$i] != "") {
					$data2 = [
						'transaction_id' => $id,

						'order_barcode' => $data['obc'][$i],
						'stat' => 'pending', 'quantity ' => $data['quantity'][$i],
						'finish_qty ' => $data['quantity'][$i],

					];

					$this->Transaction_model->insert($data2, 'transaction_meta');
					$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getOrderDetails()
	{
		$data['obc'] = $this->security->xss_clean($_POST['id']);
		$data['godown'] = $this->security->xss_clean($_POST['godown']);

		$data['order'] = $this->Transaction_model->getOrderDetails($data);
		if ($data['order']) {
			echo json_encode($data['order']);
		} else {
			echo json_encode(0);
		}
	}

	public function get_godown()
	{
		$id = $this->security->xss_clean($_POST['party']);
		$data = array();
		$data['godown'] = $this->Transaction_model->get_godown($id);
		echo json_encode($data['godown']);
	}



	public function filter()
	{
		$data1 = array();
		$this->security->xss_clean($_POST);
		if ($_POST) {
			//	echo"<pre>";	print_r($_POST); exit;
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
				$data['frc_data'] = $this->Transaction_model->search1($data1);
			} else {
				if (isset($_POST['sort_name']) && $_POST['sort_name'] != "") {
					$data1['cat'][] = 'sort_name';
					$fab = $this->input->post('sort_name');
					$data1['Value'][] = $fab;
					$caption = $caption . ' sort_name' . " = " . $fab . " ";
				}
				if (isset($_POST['challan']) && $_POST['challan'] != "") {
					$data1['cat'][] = 'challan_out';
					$fab = $this->input->post('challan');
					$data1['Value'][] = $fab;
					$caption = $caption . 'Challan No' . " = " . $fab . " ";
				}
				if (isset($_POST['unitName']) && $_POST['unitName'] != "") {
					$data1['cat'][] = 'unitName';
					$fab = $this->input->post('unitName');
					$data1['Value'][] = $fab;
					$caption = $caption . 'unitName' . " = " . $fab . " ";
				}
				if (isset($_POST['total_amount']) && $_POST['total_amount'] != "") {
					$data1['cat'][] = 'total_amount';
					$fab = $this->input->post('total_amount');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_amount' . " = " . $fab . " ";
				}
				if (isset($_POST['total_quantity']) && $_POST['total_quantity'] != "") {
					$data1['cat'][] = 'total_quantity';
					$fab = $this->input->post('total_quantity');
					$data1['Value'][] = $fab;
					$caption = $caption . 'total_quantity' . " = " . $fab . " ";
				}
				if (isset($_POST['fabric_type']) && $_POST['fabric_type'] != "") {
					$data1['cat'][] = 'fabric_type';
					$fab = $this->input->post('fabric_type');
					$data1['Value'][] = $fab;
					$caption = $caption . 'fab_type' . " = " . $fab . " ";
				}
				$data['frc_data'] = $this->Transaction_model->search1($data1);
			}
			if ($data1['type'] == 'recieve') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['main_content'] = $this->load->view('admin/transaction/bill/list_bill', $data, TRUE);
				$this->load->view('admin/index', $data);
			} elseif ($data1['type'] == 'return') {
				$data['caption'] = $caption;
				$data['febName'] = $this->Common_model->febric_name();
				$data['main_content'] = $this->load->view('admin/transaction/challan/list_challan', $data, TRUE);
				$this->load->view('admin/index', $data);
			} else {
				$data['main_content'] = $this->load->view('admin/FRC/stock/search');
				$this->load->view('admin/index', $data);
			}
		}
	}
}
