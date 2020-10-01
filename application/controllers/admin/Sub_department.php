<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sub_department extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Sub_department_model');

    	}


    	public function index(){
	        $data = array();
		    	$data['name']='Sub Department';
			$data['sub_dept_data']=$this->Sub_department_model->get();
		$data['under'] = $this->Sub_department_model->get_primary();
					$data['department'] = $this->Sub_department_model->department_name();
				//	echo print_r($data['department']);exit;
	        $data['main_content'] = $this->load->view('admin/master/sub_department/sub_department', $data, TRUE);
	        $this->load->view('admin/index', $data);
    	}
    	public function addSubDept()
    	{
    		if ($_POST)
    		{
    			$data=array(
    				'deptName'=>$_POST['deptName'],
					'subDeptName'=>$_POST['subDeptName'],
				'sortname' => $_POST['sortname'],
				'under' => $_POST['under'],
						'inPrefix'=>$_POST['inPrefix'],
						'inStart'=>$_POST['inStart'],
						'inSuffix'=>$_POST['inSuffix'],
						'outPrefix'=>$_POST['outPrefix'],
						'outStart'=>$_POST['outStart'],
						'outSuffix'=>$_POST['outSuffix']
    			);
    			// print_r($data);
    			$this->Sub_department_model->add($data);
    			redirect(base_url('admin/Sub_department'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {
							$data=array(
								'deptName'=>$_POST['deptName'],
								'subDeptName'=>$_POST['subDeptName'],
				'sortname' => $_POST['sortname'],
				'under' => $_POST['under'],
								'inPrefix'=>$_POST['inPrefix'],
								'inStart'=>$_POST['inStart'],
								'inSuffix'=>$_POST['inSuffix'],
								'outPrefix'=>$_POST['outPrefix'],
								'outStart'=>$_POST['outStart'],
								'outSuffix'=>$_POST['outSuffix']
							);
                $this->Sub_department_model->edit($id,$data);
								$this->session->set_flashdata('success','Successfully');
                redirect(base_url('admin/Sub_department'));

            }
        }
        public function delete($id)
        {
            $this->Sub_department_model->delete($id);
            redirect(base_url('admin/Sub_department'));
        }
				public function deletesub_department(){
					$ids = $this->input->post('ids');

					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('sub_department', array('id' => $value));
					}
				}

        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Sub_department_model->search($searchByCat,$searchValue);
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
                            // echo $value['id'];exit;
              echo json_encode($output);
            }
        }





	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
