
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Segment extends CI_Controller {


		public function __construct(){
        parent::__construct();
				check_login_user();
		$this->load->model('Segment_model');
		$this->load->model('Sub_department_model');
    	}


    	public function index(){
	        $data = array();
				  $data['page_name']='SUIT & SAREE GENERATE FORM';
	        $data['fabric']=$this->Segment_model->get();
		$data['sub_dept_data'] = $this->Sub_department_model->get();
					$data['main_content'] = $this->load->view('admin/FRC/segment/addsegment', $data, TRUE);
					$this->load->view('admin/index', $data);
    	}


    	public function get_segment()
    	{
    		if ($_POST)
    		{
    	  $data['segment']=$this->Segment_model->get_segmentdata($_POST['id']);
				if($data['segment']){
				$data['data'] = $this->load->view('admin/FRC/segment/segmentdata', $data, TRUE);
			}else{
				$data['data'] = '<p class="text-center" style="color:red;">No Segment</p>';
			}
				$this->load->view('admin/FRC/segment/index', $data);
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
							$data =array(
									'grade'=>$_POST['grade']
							);
                $this->Grade_model->edit($id,$data);
								$this->session->set_flashdata(array('error' => 0, 'msg' => ' Updated Successfully'));
                redirect(base_url('admin/grade'));
            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Grade_model->delete($id);
            redirect(base_url('admin/grade'));
        }

				public function delete_order(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('grade', array('id' => $value));
					}
				}


	}

	/* End of file Branch_detail.php */
	/* Location: ./application/controllers/admin/Branch_detail.php */

 ?>
