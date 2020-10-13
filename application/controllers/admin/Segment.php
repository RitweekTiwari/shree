
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Segment extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('Segment_model');
		$this->load->model('Sub_department_model');
		$this->load->model('Frc_model');
	}


	public function index()
	{
		$data = array();
		$data['page_name'] = 'SUIT & SAREE GENERATE FORM';
		$data['fabric'] = $this->Segment_model->get();
		$data['sub_dept_data'] = $this->Sub_department_model->get();
		$data['main_content'] = $this->load->view('admin/FRC/segment/addsegment', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function add()
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;

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

				'total_pcs' => $data['pcs_main'],
				'total_quantity' => $data['pcs_main'],
				'total_amount' => $data['total_main'],


				'challan_type' => 'recieve'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			$counter = $this->Frc_model->getCount('recieve');
			$cc = $counter[0]['count'];
			// print_r($counter[0]['count']);exit;
			for ($i = 0; $i < $data['pcs_main']; $i++) {



				$cc = $cc + 1;
				$pbc = "P" . (string)$cc;

				$data2 = [
					'fabric_challan_id' => $id,
					'parent_barcode' => $pbc,
					'challan_no' =>  $challan,
					'counter' => $cc,
					'fabric_id' => $data['fabric_name'],

					'created_date' => $data['PBC_date'],

					'stock_quantity' => 1,
					'current_stock' => 1,

					'color_name ' => $data['color_main'],

					'purchase_rate' => $data['rate_main'],
					'total_value' => $data['rate_main'],
					'challan_type' => 'recieve'

				];
				$this->Frc_model->update_fabric_rate($data['rate_main'], $data['fabric_name']);
				$this->Frc_model->insert($data2, 'fabric_stock_received');
			}
			for ($i = 0; $i < count($data['pbc']); $i++) {
				$data1 = array();
				$data1 = [
					'new_pbc' => $pbc,
					'pbc' => $data['pbc'][$i],
					'length'  => $data['length'][$i],
					'pcs' => $data['pcs'][$i],
					'created' => date('y-m-d'),
					'rate' =>  $data['rate'][$i],

					'value' => $data['value'][$i],
					'tc' => $data['tc'][$i],

				];
				$id =	$this->Frc_model->insert($data1, 'fabric_tc_detail');
			}

			for ($i = 0; $i < count($data['pbc1']); $i++) {
				$data1 = array();
				$data1 = [
					'current_stock' => $data['cqty1'][$i],

					'tc' => $data['tc'][$i],

				];
				$this->Segment_model->update_pbc($data['pbc1'][$i], $data1);
			}
		}
		$this->session->set_flashdata('success', 'Added Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function get_segment()
	{
		$result = array();
		if ($_POST) {
			$data['segment'] = $this->Segment_model->get_segmentdata($_POST['id']);

			if ($data['segment']) {
				$data['data'] = $this->load->view('admin/FRC/segment/segmentdata', $data, TRUE);
			} else {
				$data['data'] = '<p class="text-center" style="color:red;">No Segment</p>';
			}
			$this->load->view('admin/FRC/segment/index', $data);
		}
	}
	public function get_fabric_by_id()
	{
		
		$fabric = $this->Segment_model->get_fabric_by_id($_POST['id']);
		if (!empty($fabric)) {
			$result = $fabric[0];
		}

		//pre($result);exit;
		echo json_encode($result);
	}
	public function get_fabric()
	{
		if(isset($_POST['search']))
		$fabric = $this->Segment_model->get_fabric($_POST['search']);
		else
			$fabric = $this->Segment_model->get_fabric();

		if (!empty($fabric)) {
			$result = $fabric[0];
		}

		//pre($result);exit;
		echo json_encode($result);
	}
	public function update_pbc()
	{
		$data1 = [
			'current_stock' => $_POST['qty'],

		];
	$id=	$this->Segment_model->update_pbc($_POST['id'], $data1);
	//echo $id;exit;
		if ($id) {
			echo 1;
		}else{
			echo 0;
		}

		
	}
	public function get_pbc()
	{
		if ($_POST) {
			$data['segment'] = $this->Segment_model->get_pbc_data($_POST['id']);
			if (!empty($data['segment'])) {
				echo json_encode($data['segment']);
			} else {
				echo 0;
			}
		}
	}

	public function edit($id)
	{
		if ($_POST) {
			$data = array(
				'grade' => $_POST['grade']
			);
			$this->Grade_model->edit($id, $data);
			$this->session->set_flashdata(array('error' => 0, 'msg' => ' Updated Successfully'));
			redirect(base_url('admin/grade'));
		}
		// echo $id;
		// $this->load->view('admin/branch_detail');
		//
	}

	

	
}

/* End of file Branch_detail.php */
/* Location: ./application/controllers/admin/Branch_detail.php */

?>
