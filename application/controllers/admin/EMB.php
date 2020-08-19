<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EMB extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('common_model');
		$this->load->model('Erc_model');
		$this->load->model('Emb_model');
		$this->load->model('Orders_model');
	}
	public function index()
	{
		$data = array();
		$data['name'] = 'ERC';


		$data['worker'] = $this->Emb_model->get_worker_name();
		// $data['emb'] = $this->Emb_model->get_emb();
		$data['erc_value'] = $this->Emb_model->get_erc_value();
		//$data['erc'] = $this->Emb_model->get_erc_fresh_value();
		$data['erc'] = $this->Emb_model->get_erc_fresh_value();
		//	pre($data['erc']);exit;
		$data['main_content'] = $this->load->view('admin/master/emb/emb', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function get_emb_list()
	{
		$output = array();
		$data = array();
		$record = array();

		$caption = '';
		if ($_POST) {
			if (!empty($_POST["search"]["value"])) {

				$data['Value'] = $_POST["search"]["value"];
				$data['search'] = 'search';
				$data['emb'] = $this->Emb_model->get_emb($data);
			}
			$data['emb'] = $this->Emb_model->get_emb($data);
			foreach ($data['emb'] as $key => $value) {
				$output[$key]['id'] = $value['id'];
				$output[$key]['emb_rate'] = $value['emb_rate'];
				$output[$key]['designName'] = $value['designName'];
				$output[$key]['worker'] = self::get_array($value['workerName'], $value['rate']);
			}
			if (isset($output)) {
				$data['output'] = $output;
			}
			$id = 1;
			foreach ($data['output'] as $value) {
				$sub_array = array();
				$sub_array['row'] = 'row_'.$value['id'];
				$sub_array['id'] = '<input type="checkbox" class="sub_chk" data-id=' . $value['id'] . '>';
				$sub_array['sno'] = $id;
				$sub_array['emb_rate'] = $value['emb_rate'];
				$sub_array['design'] = $value['designName'];
				
					$sub_array['worker']=
				$value['worker'];
				$sub_array['action'] = '
			<a class="text-center tip find_id" id=' . $value['id'] . ' data-original-title="Edit">
				<i class="fas fa-edit blue"></i>
			</a>
			<a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(' . $value['id'] . ')" data-original-title="Delete">
					<i class="mdi mdi-delete red"></i>
				</a>  &nbsp;&nbsp;&nbsp;
				';

				

				$record[] = $sub_array;
				$id++;
			}

			$output = array(

				"recordsTotal" => $this->Emb_model->get_count("emb"),
				"recordsFiltered" =>	$this->Emb_model->get_count("emb"),

				"draw"   =>  intval($_POST["draw"]),
				"data" => $record
			);

			echo json_encode($output);
		}
	}
	public function get_array($worker, $rate)
	{
		$worker = explode(',', $worker);
		$rate = explode(',', $rate);
		if (count($worker) == count($rate)) {
			for ($i=0; $i< count($rate);$i++) {
				$result[] = array('worker'=> $worker[$i],'rate'=>$rate[$i]);
			}
			return $result;
		}
	}
	public function edit_part()
	{
		if ($_POST) {

			$data['worker'] = $this->Emb_model->get_embmeta($_POST['id']);
		}
		echo json_encode($data['worker']);
	}


	public function add_emb()
	{
		$data = array();
		if ($_POST) {

			$data = array(
				'designName' => $_POST['design'],
				'emb_rate'=> $_POST['embrate'],
			);
			$id = $this->Emb_model->insert($data, 'emb');
			if ($id) {
				for ($i = 0; $i < count($_POST['job']); $i++) {
					$data = array(
						'embId' => $id,
						'workerName' => $_POST['job'][$i],
						'rate' => $_POST['rate'][$i]
					);
					$this->Emb_model->insert($data, 'embmeta');
				}
				$this->session->set_flashdata(array('error' => 0, 'msg' => 'Emb Added Successfully'));
				redirect(base_url('admin/EMB'));
			} else {
				$this->session->set_flashdata(array('error' => 1, 'msg' => 'Emb Added Faild'));
				redirect(base_url('admin/EMB'));
			}
		}
	}
	public function update_embmeta()
	{
		$data = array();
		if ($_POST) {
			$form = $this->security->xss_clean($_POST);
			foreach ($form['form'] as $row) {
				if ($row['name'] == "job[]") {
					$data['job'][] = $row['value'];
				} elseif ($row['name'] == "rate[]") {
					$data['rate'][] = $row['value'];
				} elseif ($row['name'] == "embid") {
					$data['embid'][] = $row['value'];
				} else {
					$arr = array(
						$row['name'] => $row['value']
					);
					$data[] = $arr;
				}
			}
			//pre($data[0]);exit;
			$z = 0;
			$count = count($data['job']);
			for ($i = 0; $i < $count; $i++) {
				$data1 = array(
					'rate' => $data['rate'][$i]
				);

				$id = $this->Emb_model->update($data['embid'][$i], $data1);
				$z += $id;
			}
			if ($count == $z) {
				echo 1;
			} else {
				echo 0;
			}

			// $this->session->set_flashdata(array('error' => 0, 'msg' => 'Update Successfully'));
			// redirect($_SERVER['HTTP_REFERER']);

		}
	}
	public function get_emb_details($id)
	{
		$data = array();
		$data['name'] = 'Worker';
		$data['jobworker'] = $this->Emb_model->get_worker_name();
		$data['worker'] = $this->Emb_model->get_embmeta($id);
		$data['id'] = $id;
		//pre($data['worker']);exit;

		$data['emb'] = $this->Emb_model->get_emb();
		$data['erc'] = $this->Emb_model->get_erc_design_name();

		$data['main_content'] = $this->load->view('admin/master/emb/edit', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function view_worker($id)
	{
		$data = array();
		$data['name'] = 'Worker';
		$data['jobworker'] = $this->Emb_model->get_worker_name();
		$data['worker'] = $this->Emb_model->get_embmeta($id);
		//pre($data['worker']);exit;

		$data['emb'] = $this->Emb_model->get_emb();
		$data['erc'] = $this->Emb_model->get_erc_design_name();

		$data['main_content'] = $this->load->view('admin/master/emb/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function EmbRate()
	{
		if ($_POST) {
			$data = $this->Emb_model->embRate($_POST['desName']);
			if ($data != '') {
				echo $data->rate;
			} else {
				echo 'Null';
			}
		}
	}

	public function delete($id)
	{
		$this->Emb_model->delete($id);
		$this->db->delete('emb', array('id' => $id));
		redirect(base_url('admin/EMB'));
	}

	public function deletejob()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);

		foreach ($userid as $value) {
			$this->db->delete('emb', array('id' => $value));
			$this->db->delete('embmeta', array('embId' => $value));
		}
	}
}
