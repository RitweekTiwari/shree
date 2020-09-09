<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dye_transaction extends CI_Controller {

		public function __construct(){
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

		$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dye');


		$data['main_content'] = $this->load->view('admin/transaction/dye_out', $data, TRUE);
		$this->load->view('admin/index', $data);
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
			$id = $this->Transaction_model->getId('to_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['ToGodown'], 'arr');
			if (!$id) {
				$challan2 =  $godown_name->inPrefix .  $godown_name->inStart . $godown_name->inSuffix;
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$challan2 = $godown_name->inPrefix .  (string) $cc .  $godown_name->inSuffix;
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
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
	
			$data['frc_data'] = $this->Transaction_model->get('to_godown', $godown, 'dye');
		

		$data['main_content'] = $this->load->view('admin/transaction/dye_in', $data, TRUE);
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

		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['godownid'] = $godown;
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		
		
		
		$data['frc_data'] = $this->DyeTransaction_model->get_stock($data);
		//$data['godown_data'] = $this->Transaction_model->get_stock($godown);	
		//echo "<pre>";print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/stock_dye', $data, TRUE);


		$this->load->view('admin/index', $data);
	}	   
 public function getPBC()
    {
	  $id= $this->security->xss_clean($_POST['id']);
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
      $id= $this->security->xss_clean($_POST['party']);
    $data = array();
     $data['godown']=$this->DyeTransaction_model->get_godown($id);
     echo json_encode($data['godown']);

    }
		

	}


 ?>
