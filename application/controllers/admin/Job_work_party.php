<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Job_work_party extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
         $this->load->model('Job_work_party_model');
         $this->load->model('common_model');
    	}


    	public function index(){
	        $data = array();
	        $data['name']='Job Work Party';
          $data['party_data']=$this->Job_work_party_model->get();
          $data['dept_name']=$this->common_model->department();
          $data['subDept_name']=$this->common_model->subDept();
          $data['job_type_name']=$this->Job_work_party_model->job_work_name();
	        $data['main_content'] = $this->load->view('admin/master/jobwork/jobwork', $data, TRUE);
					$this->load->view('admin/index', $data);
    	}

    	public function addJob()
    	{
    		if ($_POST)
    		{
    			$data=$this->input->post();
    			print_r($data);
    			$this->Job_work_party_model->add($data);
    			redirect(base_url('admin/Job_work_party'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {
                $data=$this->input->post();
                $this->Job_work_party_model->edit($id,$data);
                redirect(base_url('admin/Job_work_party'));

            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Job_work_party_model->delete($id);
            $this->db->delete('jobtypeconstant', array('jobId' => $value));
            redirect(base_url('admin/Job_work_party'));
        }

				public function deletejob(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
              $this->db->delete('job_work_party', array('id' => $value));
              $this->db->delete('jobtypeconstant', array('jobId' => $value));
					}
				}

        // Search by category function
        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Job_work_party_model->search($searchByCat,$searchValue);
                foreach ($data as $value) {
                                // echo print_r($value);exit;
                   $output .= "<tr id='tr_".$value['id']."'>";
                     $output .="<td><input type='checkbox' class='sub_chk' data-id=".$value['id']."></td>";
                    foreach ($value as $temp) {
                        $output .= "<td>".$temp."</td>";
                     }
                    $output .= "<td><a href='#".$value['id']."' class='text-center tip' data-toggle='modal' data-original-title='Edit'><i class='fas fa-edit blue'></i></a>
                    <a class='text-danger text-center tip' href='javascript:void(0)' onclick='delete_detail(".$value['id'].")' data-original-title='Delete'><i class='mdi mdi-delete red' ></i></a>
                    </td>";
                $output .= "</tr>";
                            }
              echo json_encode($output);
            }
        }

	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
 ?>
