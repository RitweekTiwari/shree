
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GradePercent extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		check_login_user();
		$this->load->model('Grade_model');
		$this->load->model('Percent_model');
		$this->load->model('Common_model');
	}
	public function index()
	{
		$data = array();
		$data['page_name'] = 'ADD Percent / ' . '<a href="' . base_url('admin/SRC') . '">SRC Home</a>';
		$data['grade_data'] = $this->Common_model->select('grade');
		//pre($data['grade_data']);exit;
		$data['fabric_data'] = $this->Percent_model->get_fabric_value();

		$data['main_content'] = $this->load->view('admin/master/percent/index', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function get_gradeP_list()
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
				$data['grade_percent'] = $this->Percent_model->get($data);
				// pre($data['grade_percent']);exit;
				foreach ($data['grade_percent'] as $key => $value) {
					$output[$key]['id'] = $value['id'];
					$output[$key]['fabricName'] = $value['fabricName'];
					$output[$key]['grade'] = self::get_array($value['grade'], $value['percent']);
					//	pre(	$output[$key]['grade']);exit;
				}
				if (isset($output)) {
					$data['output'] = $output;
					//pre($data['output']);exit;
				}
			} else {
				$data['grade_percent'] = $this->Percent_model->get($data);
				// pre( $data['grade_percent']);exit;
				foreach ($data['grade_percent'] as $key => $value) {
					$output[$key]['id'] = $value['id'];
					$output[$key]['fabricName'] = $value['fabricName'];
					$output[$key]['grade'] = self::get_array($value['grade'], $value['percent']);
					// pre($output['grade']);exit;
				}
				if (isset($output)) {
					$data['output'] = $output;
					//pre($data['output']);exit;
				}
			}
			$id = 1;
			foreach ($data['output'] as $value) {
				$sub_array = array();
				$sub_array['row'] = 'row_' . $value['id'];
				$sub_array['id'] = '<input type="checkbox" class="sub_chk" data-id=' . $value['id'] . '>';
				$sub_array['sno'] = $id;
				$sub_array['fabricName'] = $value['fabricName'];
				$sub_array['grade'] =	$value['grade'];
				$sub_array['action'] =  '
					<a id=' . $value['id'] . ' href="#addnew" class="text-center tip find_id" data-toggle="modal"  data-original-title="Edit">
						<i class="fas fa-edit blue"></i>
					</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail( ' . $value['id'] . ')" data-original-title="Delete">
							<i class="mdi mdi-delete red"></i>
						</a>';

				$record[] = $sub_array;
				$id++;
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
	public function get_array($grade, $percent)
	{

		$grade = explode(',', $grade);

		$percent = explode(',', $percent);
		if (count($grade) == count($percent)) {

			for ($i = 0; $i < count($percent); $i++) {
				$result[] = array('grade' => $grade[$i], 'percent' => $percent[$i]);
			}
			return $result;
		}
	}
	public function get_edit_data()
	{
		if ($_POST) {

			$data['grade'] = $this->Percent_model->get_all_data($_POST['id']);
			//pre($data['grade']);exit;
		}
		echo json_encode($data['grade']);
	}


	public function update_percent()
	{
		$data1 = array();
		if ($_POST) {

			$form = $this->security->xss_clean($_POST);
			foreach ($form['form'] as $row) {
				if ($row['name'] == "grade[]") {
					$data['grade'][] = $row['value'];
				} elseif ($row['name'] == "percent[]") {
					$data['percent'][] = $row['value'];
				} elseif ($row['name'] == "id") {
					$data['id'][] = $row['value'];
				} else {
					$arr = array(
						$row['name'] => $row['value']
					);
					$data[] = $arr;
				}
			}
			///pre($data);exit;
			$z = 0;
			$count = count($data['grade']);
			for ($i = 0; $i < $count; $i++) {
				$data1 = array(
					'percent' => $data['percent'][$i]
				);
				$id = $this->Percent_model->edit($data['id'][$i], $data1);
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
	public function addGradepercent()
	{
		if ($_POST) {
			$data = array(
				'fabric' => $_POST['fabric'],
			);

			$id =	$this->Percent_model->add($data, 'gpercent');
			if ($id) {
				for ($i = 0; $i < count($_POST['grade']); $i++) {
					$data = array(
						'percentId' => $id,
						'grade' => $_POST['grade'][$i],

						'percent' => $_POST['percent'][$i]
					);
					$id1 =	$this->Percent_model->add($data, 'gprecent_meta');
				}

				if ($id1) {
					echo TRUE;
				} else {
					echo FALSE;
				}
			}
		} else {
			echo json_encode(array('error' => true, 'msg' => 'somthing want wrong :('));
		}
	}



	public function edit($id)
	{
		if ($_POST) {
			$data = array(
				'grade' => $_POST['grade'],
				'fabric' => $_POST['fabric'],
				'percent' => $_POST['percent']
			);
			$this->Percent_model->edit($id, $data);
			$this->session->set_flashdata(array('error' => 0, 'msg' => ' Updated Successfully'));
			redirect(base_url('admin/GradePercent'));
		}
		// echo $id;
		// $this->load->view('admin/branch_detail');
		//
	}

	public function delete($id)
	{
		$this->Grade_model->delete($id);
		redirect(base_url('admin/GradePercent'));
	}

	public function delete_order()
	{
		$ids = $this->input->post('ids');
		$userid = explode(",", $ids);
		foreach ($userid as $value) {
			$this->db->delete('gpercent', array('id' => $value));
		}
	}
	public function filter()
	{
		$data = array();
		if ($_POST) {
			$searchByCat = $this->input->post('searchByCat');
			$searchValue = $this->input->post('searchValue');
			$output = "";
			$data = $this->Percent_model->search($searchByCat, $searchValue);
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

/* End of file Branch_detail.php */
/* Location: ./application/controllers/admin/Branch_detail.php */

?>
