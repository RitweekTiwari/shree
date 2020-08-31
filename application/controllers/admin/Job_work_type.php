<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_work_type extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('Job_work_type_model');
		$this->load->model('common_model');
		$this->load->model('unit_model');
	}

	public function index()
	{
		$data = array();
		$data['name'] = 'Job Work Type';
		// $data['work_type']=$this->Job_work_type_model->get();
		$data['type'] = $this->Job_work_type_model->getType();
		$data['units'] = $this->Job_work_type_model->getUnits();
		//	pre($data['units']);exit;
		$data['fabtype'] = $this->Job_work_type_model->getfabricType();
		$data['main_content'] = $this->load->view('admin/master/job_work_type/jobworktype', $data, TRUE);
		$this->load->view('admin/index', $data);
	}

	public function addType()
	{
		if ($_POST) {
			$data = array();
			$data['type'] = $this->input->post('type');
			$jobid = $this->Job_work_type_model->add($data);
			if ($jobid) {
				for ($i = 0; $i < count($_POST['job']); $i++) {
					$datajob = array(
						'unit' => $_POST['unit'][$i],
						'jobId' => $jobid,
						'job' => $_POST['job'][$i],
						'rate' => $_POST['rate'][$i]
					);
					$id1 = $this->Job_work_type_model->insert($datajob, 'jobtypeconstant');
				}
				if ($id1) {
					echo 1;
				} else {
					echo 0;
				}
			}
		}
	}

	public function get_jobworklist()
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

				$data['work_type'] = $this->Job_work_type_model->get($data);

				foreach ($data['work_type'] as $key => $value) {

					$output[$key]['id'] = $value['id'];
					$output[$key]['type'] = $value['type'];

					$output[$key]['jobconstant'] = self::get_array($value['unit'], $value['job'], $value['rate']);
					//pre($output[$key]['fabricId']);exit;
				}
				if (isset($output)) {
					$data['output'] = $output;
					//pre($data['output']);exit;
				}
			} else {
				$data['work_type'] = $this->Job_work_type_model->get($data);
				//pre($data['work_type']);exit;
				foreach ($data['work_type'] as $key => $value) {
					$output[$key]['id'] = $value['id'];
					$output[$key]['type'] = $value['type'];
					$output[$key]['jobconstant'] = self::get_array($value['unit'], $value['job'], $value['rate']);
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
				$sub_array['type'] = $value['type'];
				$sub_array['jobconstant'] = $value['jobconstant'];

				$sub_array['action'] =  '<a id="' . $value['id'] . '"; class="text-center tip find_id"  data-original-title="Edit">
					<i class="fas fa-edit blue"></i>
				  </a>
					<a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(' . $value['id'] . ')" data-original-title="Delete">
			      <i class="mdi mdi-delete red"></i>
			    </a>';
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

	public function get_array($unit, $job, $rate)
	{
		$unit = explode(',', $unit);

		$job = explode(',', $job);

		$rate = explode(',', $rate);

		if (count($unit) == count($job)) {

			for ($i = 0; $i < count($unit); $i++) {
				$result[] = array('unit' => $unit[$i], 'job' => $job[$i], 'rate' => $rate[$i],);
			}
			return $result;
		}
	}

	public function get_edit_data()
	{
		if ($_POST) {
			$record = array();
			//	$data['fabricId']=$this->Fabric_model->get_fabricId('fabric_details');
			$data['jobtype'] = $this->Job_work_type_model->get_all_edit_data($_POST['id']);

			foreach ($data['jobtype'] as $key => $value) {
				$output[$key]['id'] = $value['id'];
				$output[$key]['type'] = $value['type'];

				$output[$key]['bojconstant'] = self::get_edit_array($value['jcid'], $value['jobId'], $value['unit'], $value['unitSymbol'], $value['job'], $value['rate']);
				//pre($output[$key]['fabricdetails']);exit;
			}
			if (isset($output)) {
				$data['output'] = $output;
				//pre($data['output']);exit;
			}
		}
		echo json_encode($data['output']);
	}


	public function get_edit_array($jcid, $jobId, $unit, $unitSymbol, $job, $rate)
	{
		$jcid = explode(',', $jcid);
		$jobId = explode(',', $jobId);

		$unit = explode(',', $unit);
		$unitSymbol = explode(',', $unitSymbol);
		$job = explode(',', $job);
		$rate = explode(',', $rate);

		if (count($jobId) == count($job)) {

			for ($i = 0; $i < count($jobId); $i++) {
				$result[] = array('jcid' => $jcid[$i], 'jobId' => $jobId[$i], 'unit' => $unit[$i], 'unitSymbol' => $unitSymbol[$i], 'job' => $job[$i], 'rate' => $rate[$i],);
			}
			return $result;
		}
	}


	public function edit()
	{
		if ($_POST) {
			$jobworkid = $this->input->post('jobworkId');
			$data = array(
				'type' => $_POST['type'],
			);

			$id = $this->Job_work_type_model->edit($jobworkid, $data, 'job_work_type');
			if (isset($_POST['jcid'])) {
				if ($id && $_POST['jcid'] != '') {
					$count = count($_POST['jcid']);
					$count1 = count($_POST['job']);
					for ($i = 0; $i < $count; $i++) {
						$data1 = array(
							'unit' => $_POST['unit'][$i],
							'job' => $_POST['job'][$i],
							'rate' => $_POST['rate'][$i],
						);
						$id1 = $this->Job_work_type_model->edit($_POST['jcid'][$i], $data1, 'jobtypeconstant');
					}
				}
				for ($j = $i; $j < $count1; $j++) {
					if ($_POST['job'][$j] != '') {
						$data2 = array(
							'jobId' => $jobworkid,
							'unit' => $_POST['unit'][$j],
							'job' => $_POST['job'][$j],
							'rate' => $_POST['rate'][$j]
						);

						$id1 = $this->Job_work_type_model->insert($data2, 'jobtypeconstant');
					}
				}
			} else {
				for ($i = 0; $i < count($_POST['job']); $i++) {
					$data = array(
						'jobId' => $jobworkid,
						'unit' => $_POST['unit'][$i],
						'job' => $_POST['job'][$i],
						'rate' => $_POST['rate'][$i],
					);

					$id1 = $this->Job_work_type_model->insert($data, 'jobtypeconstant');
				}
			}
		}
	}
	public function getfdid()
	{
		$id = $this->input->post('id');
		$id1 = $this->Job_work_type_model->delete_jobtypeconstant('jobtypeconstant', $id);
		if ($id1) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function delete($id)
	{
		$this->Job_work_type_model->delete($id);
		redirect(base_url('admin/Job_work_type'));
	}

	public function deletejob()
	{
		$ids = $this->input->post('ids');
		// echo $ids;exit;
		$userid = explode(",", $ids);
		// echo print_r($userid);exit;
		foreach ($userid as $value) {

			$this->db->delete('jobtypeconstant', array('id' => $value));
		}
	}
	public function filter()
	{
		$data = array();
		if ($_POST) {
			$searchByCat = $this->input->post('searchByCat');
			$searchValue = $this->input->post('searchValue');
			$output = "";
			$data = $this->Job_work_type_model->search($searchByCat, $searchValue);
			foreach ($data as $value) {
				// echo print_r($value);exit;
				$output .= "<tr id='tr_" . $value['id'] . "'>";
				$output .= "<td><input type='checkbox' class='sub_chk' data-id=" . $value['id'] . "></td>";
				foreach ($value as $temp) {
					$output .= "<td>" . $temp . "</td>";
				}
				$output .= "<td><a href='#" . $value['id'] . "' class='text-center tip' data-toggle='modal' data-original-title='Edit'><i class='fas fa-edit blue'></i></a>
                    <a class='text-danger text-center tip' href='javascript:void(0)' onclick='delete_detail(" . $value['id'] . ")' data-original-title='Delete'><i class='mdi mdi-delete red' ></i></a>
                    </td>";
				$output .= "</tr>";
			}
			echo json_encode($output);
		}
	}
}
	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
