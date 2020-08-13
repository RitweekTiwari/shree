<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Job_work_type extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
         $this->load->model('Job_work_type_model');
         $this->load->model('common_model');
         $this->load->model('unit_model');

    	}


    	public function index(){
	        $data = array();
	        $data['name']='Job Work Type';
          $data['work_type']=$this->Job_work_type_model->get();
          $data['type']=$this->Job_work_type_model->getType();
          $data['units']=$this->unit_model->getUnits();
	        $data['fabtype']=$this->Job_work_type_model->getfabricType();
		      $data['main_content'] = $this->load->view('admin/master/job_work_type/jobworktype', $data, TRUE);
			  	$this->load->view('admin/index', $data);
        }

      public function addType(){
				if ($_POST) {
					$data=array();
					$data['type']=$this->input->post('type');
					$jobid= $this->Job_work_type_model->add($data);
					if ($jobid) {
						for($i = 0; $i < count($_POST['job']); $i++) {
							$datajob = array(
								'unit' =>$_POST['unit'][$i],
								'jobId' =>$jobid,
								'job' =>$_POST['job'][$i],
								'rate' =>$_POST['rate'][$i]
							);
							$this->Job_work_type_model->insert($datajob,'jobtypeconstant');
						}
						$this->session->set_flashdata(array('error' => 0, 'msg' => 'Job Work Added Successfully'));
						redirect(base_url('admin/Job_work_type'));
					}else {
						$this->session->set_flashdata(array('error' => 1, 'msg' => 'Job Work Added Faild'));
						redirect(base_url('admin/Job_work_type'));
					}
        }

      }
        public function edit($id){
            if ($_POST)
    		{
              //  echo $id;exit;
								$data1 =array(
									'type' =>$_POST['type'],
								);
								// pre($data1);
							  $id=$this->Job_work_type_model->update($id,'id',$data1,'job_work_type');
      if($id){
										$datajob = array(
											'unit' =>$_POST['unit'],
											'job' =>$_POST['job'],
											'rate' =>$_POST['rate']
										);
										// pre($datajob);exit;
										$this->Job_work_type_model->update2($id,'jobId',$datajob,'jobtypeconstant');
    		           	redirect(base_url('admin/Job_work_type'));


          }
				}

        }

        public function delete($id)
        {
            $this->Job_work_type_model->delete($id);
            redirect(base_url('admin/Job_work_type'));
        }

	 public function deletejob(){
					 $ids = $this->input->post('ids');
					 // echo $ids;exit;
					 $userid= explode(",", $ids);
					 // echo print_r($userid);exit;
					 foreach ($userid as $value) {

					 $this->db->delete('jobtypeconstant', array('id' => $value));
					}
				}
        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Job_work_type_model->search($searchByCat,$searchValue);
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
