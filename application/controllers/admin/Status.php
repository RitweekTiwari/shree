<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('Orders_model');
		$this->load->model('Status_model');
		check_login_user();
	}
	public function index()
	{
		$data = array();
		$data['page_name'] = 'Design Barcode List';
		$data['main_content'] = $this->load->view('admin/barcode/barcode', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function get_dbc()
	{
		if ($_POST) {
			$data = array();
			$data['list'] = $this->Status_model->select_barcode($_POST['value'], 'barCode', 'design_view');
			$data['data'] = $this->load->view('admin/barcode/dbc', $data, TRUE);
			$this->load->view('admin/barcode/index', $data);
		}
		// echo json_encode($data['list']);
	}

	public function get_pbc_list()
	{
		if ($_POST) {
			$data = array();
			$data['pbc_list'] = $this->Status_model->select_pbc_barcode($_POST['value'], 'parent_barcode', 'fabric_stock_received');

			$data['order'] = $this->Status_model->orderproduct_list($_POST['value']);

			if (isset($data['order'])) {
				$order = $data['order']->order_barcode;
				$data['transction_list'] = $this->Status_model->transaction_list($order);
			} else {
				$data['transction_list'] = $this->Status_model->transaction_list($_POST['value']);
				if ($data['transction_list'] == '') {
					$data['massege'] = " Transtion Record  Not Found !";
				}
			}

			$data['data'] = $this->load->view('admin/barcode/pbc', $data, TRUE);
			$this->load->view('admin/barcode/index', $data);
		}
	}

	public function get_obc_list()
	{
		if ($_POST) {
			$data['order_list'] = $this->Status_model->select_obc_barcode($_POST['value'], 'order_barcode', 'order_view');

			$data['transction_list'] = $this->Status_model->transaction_list($_POST['value']);


			$data['data'] = $this->load->view('admin/barcode/obc', $data, TRUE);
			$this->load->view('admin/barcode/index', $data);
		}
	}
}
