<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller {

	public function __construct(){
        parent::__construct();
				check_login_user();
       $this->load->library(['auth', 'form_validation']);
       $this->load->model('common_model');
    }

  public function index(){
    $data = array();
    $data['name'] = 'Access Role';
    $data['main_content'] = $this->load->view('admin/roles/index', $data, TRUE);
    $this->load->view('admin/index');
  }

	public function add(){
		if($_POST){
			try {
				$data = [
					'name' => strtolower($_POST['role_name']),
					'display_name' => $_POST['display_name'],
					'description' => $_POST['description'],
					'created_at' => current_datetime(),
				];
				$data = $this->security->xss_clean($data);
				$result = $this->common_model->insert($data, 'roles');
				if ($result) {
					$this->session->set_flashdata(array('error' => 0, 'msg' => 'Role Data Added.' ));
					redirect($_SERVER['HTTP_REFERER']);
				}
			} catch (\Exception $e) {
				$this->session->set_flashdata(array('error' => 1, 'msg' => $e->getMessage()));
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata(array('error' => 1, 'msg' => 'wrong request type' ));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
