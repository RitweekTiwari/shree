
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
	public function viewRecieve($id)
	{
		$data = array();
		$data['page_name'] = 'View List';
		$data['frc_data'] = $this->Frc_model->get_by_id($id);

		$data['pbc'] = $this->Frc_model->get_frc_by_id($id);
		$segment = $this->Segment_model->get_segment_data($id);
		foreach($segment as $key => $value){
			$output[$key]['segment'] = $value['segment'];
			$output[$key]['detail']=self::edit_array($value['value'], $value['qty'], $value['pbc'], $value['fabric'], $value['length'], $value['pcs'], $value['tc'], $value['rate']);
		}
		if (isset($output)) {
			$data['output'] = $output;
			//pre($data['output']);exit;
		}
		$data['main_content'] = $this->load->view('admin/FRC/segment/list', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function edit_array($value,  $qty, $pbc, $fabric, $pcs, $length, $tc, $rate)
	{
		$value = explode(',', $value);
		$qty = explode(',', $qty);
		$pbc = explode(',', $pbc);
		$fabric = explode(',', $fabric);
		$pcs = explode(',', $pcs);
		$length = explode(',', $length);
		$tc = explode(',', $tc);
		$rate = explode(',', $rate);
		if (count($pbc) == count($fabric)) {

			for ($i = 0; $i < count($fabric); $i++) {
				$result[] = array('value' => $value[$i], 'qty' => $qty[$i], 'pbc' => $pbc[$i], 'fabric' => $fabric[$i], 'pcs' => $pcs[$i], 'length' => $length[$i], 'tc' => $tc[$i], 'rate' => $rate[$i]);
			}
			return $result;
		}
	}
	public function add()
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			//echo "<pre>"; print_r($data);exit;
			$id = $this->Frc_model->getId("tc");
			if (!$id) {
				$tcchallan = "TC1";
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$tcchallan = "TC" . (string)$cc1;
			}
			$id="";
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
				'doc_challan' =>  $tcchallan,
				'challan_no' => $challan,
				'counter' => $cc,

				'total_pcs' => $data['pcs_main'],
				'total_quantity' => $data['pcs_main'],
				'total_amount' => $data['total_main'],

				'is_tc' => 1,
				'challan_type' => 'recieve'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			$counter = $this->Frc_model->getCount('recieve');
			$cc = $counter[0]['count'];
			//print_r("counter = " . $counter[0]['count']);
			
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
					'challan_id' => $id,
					'new_pbc' => $pbc,
					'qty' => $data['cqty1'][$i],
					'pbc' => $data['pbc'][$i],
					'fabric' => $data['fabric'][$i],
					'segment' => $data['segment'][$i],
					'length'  => $data['length'][$i],
					'pcs' => $data['pcs'][$i],
					'created' => date('y-m-d'),
					'rate' =>  $data['rate'][$i],

					'value' => $data['value'][$i],
					'tc' => $data['tc'][$i],

				];
				$this->Frc_model->insert($data1, 'fabric_tc_detail');
			}


			$count = count($data['pbc']);
			$total_qty = 0;
			$total_val = 0;
			for ($i = 0; $i < $count; $i++) {
				$total_qty = $total_qty +  $data['cqty1'][$i];
				$total_val = $total_val + $data['tc'][$i];
			}
			$id = $this->Frc_model->getId("tc");

			$data1 = [

				'challan_date' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],

				'challan_no' => $tcchallan,
				'counter' => $cc1,

				'total_pcs' => $count,
				'total_quantity' => $total_qty,
				'total_tc' => $total_val,


				'challan_type' => 'tc'
			];
			$id =	$this->Frc_model->insert($data1, 'fabric_challan');
			$counter1 = $this->Frc_model->getCount('tc');
			$cc = $counter1[0]['count'];
			//print_r("counter1 =" . $counter1[0]['count']);
			for ($i = 0; $i < count($data['pbc']); $i++) {
				$data1 = array();
				$data1 = [
					'current_stock' => $data['cqty1'][$i],

					'tc' => $data['tc'][$i],

				];
				$this->Segment_model->update_pbc($data['pbc'][$i], $data1);
				$pbc1 = $this->Segment_model->get_pbc_data($data['pbc'][$i], $data['toGodown']);
			//	pre($pbc1);
				$cc = $cc + 1;
				$pbc = "TCP" . (string)$cc;
				$data2 = [
					'fabric_challan_id' => $id,
					'parent_barcode' => $pbc,
					'parent' => $data['pbc'][$i],
					'challan_no' =>  $tcchallan,
					'counter' => $cc,
					'fabric_id' => $pbc1[0]["fabric_id"],
					'created_date' => date('Y-m-d'),
					'stock_quantity' => $pbc1[0]["fabric_id"],
					'current_stock' => $data['cqty1'][$i],
					'stock_unit' => $pbc1[0]["stock_unit"],
					'ad_no ' => $pbc1[0]["ad_no"],
					'color_name ' => $pbc1[0]["color_name"],
					'purchase_code' => $pbc1[0]["purchase_code"],
					'purchase_rate' => $data['rate'][$i],
					'tc' => $data['tc'][$i],
					'isStock' => 0,
					'challan_type' => 'tc'

				];
				$this->Frc_model->insert($data2, 'fabric_stock_received');

				$data3 = [

					'isTc' => 1

				];
				$this->Frc_model->update($data3, 'parent_barcode', $data['pbc'][$i], 'fabric_stock_received');
				$this->Frc_model->update($data3, 'pbc', $data['pbc'][$i], 'pbc_tc_history');
			}
		}
		
		$this->session->set_flashdata('success', 'Added Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function get_segment_select()
	{
		$result = array();
		if ($_POST) {
			$data['segment'] = $this->Segment_model->get_segmentdata($_POST['id']);

			if ($data['segment']) {
				$data['data'] = $this->load->view('admin/FRC/segment/select', $data, TRUE);
			} else {
				$data['data'] = '<p class="text-center" style="color:red;">No Segment</p>';
			}
			$this->load->view('admin/FRC/segment/index', $data);
		}
	}
	public function get_segment()
	{
		//pre($_POST);exit;
		if ($_POST) {

			$segment = $this->Segment_model->get_segment_by_id($_POST['id']);
			if ($segment) {
				$data['segment'][] = $segment;
			}

			if (isset($data['segment'][0])) {


				//pre($data['segment']);exit;
				foreach ($data['segment'][0] as $key => $value) {
					$output[$key]['metaId'] = $value['metaId'];
					$output[$key]['segmentName'] = $value['segmentName'];
					$output[$key]['length'] = $value['length'];
					$output[$key]['width'] = $value['width'];
					$output[$key]['min'] = $value['min'];
					$output[$key]['max'] = $value['max'];
					$output[$key]['fab'] = self::get_edit_array($value['fabric'], $value['fabricId']);
					//pre($output[$key]['fabricdetails']);exit;
				}
				$data['segment'] = $output;
			}

			if (isset($data['segment'])) {
				$data['data'] = $this->load->view('admin/FRC/segment/segmentdata', $data, TRUE);
			} else {
				$data['data'] = '<p class="text-center" style="color:red;">No Segment</p>';
			}
			$this->load->view('admin/FRC/segment/index', $data);
		}
	}
	public function get_edit_array($fdid, $segmentName)
	{
		$fdid = explode(',', $fdid);
		$segmentName = explode(',', $segmentName);


		if (count($segmentName) == count($fdid)) {

			for ($i = 0; $i < count($fdid); $i++) {
				$result[] = array('fabric' => $fdid[$i], 'fabricid' => $segmentName[$i]);
			}
			return $result;
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
		if (isset($_POST['search']))
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
		$id =	$this->Segment_model->update_pbc($_POST['id'], $data1);
		//echo $id;exit;
		if ($id) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function get_pbc()
	{
		if ($_POST) {
			$data['segment'] = $this->Segment_model->get_pbc_data($_POST['id'], $_POST['godown']);
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
