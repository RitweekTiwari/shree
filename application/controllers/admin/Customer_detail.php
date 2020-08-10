<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Customer_detail extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Customer_model');
        $this->load->model('common_model');
    	}


    	public function index(){
	        $data = array();
					$data['name']='Customer Details';
	        $data['cust_data']=$this->Customer_model->get();
          $data['branch_name']=$this->common_model->branchDetail();
	        $data['main_content'] = $this->load->view('admin/master/customer/customer_detail', $data, TRUE);
	        $this->load->view('admin/index', $data);
				}
    	public function addCust()
    	{
    		if ($_POST)
    		{
    			$data=array(
    				'name'=>$_POST['name'],
    				'phone_no'=>$_POST['phone_no'],
    				'email'=>$_POST['email'],
						'grade' => $_POST['grade'],
            'under_branch'=>$_POST['under_branch'],
    				'address'=>$_POST['address']
    			);
    			// print_r($data);
    			$this->Customer_model->add($data);
					$this->session->set_flashdata('success', ' add Successfully !!');
    			redirect(base_url('admin/Customer_detail'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {
							$data=array(
								'name'=>$_POST['name'],
								'phone_no'=>$_POST['phone_no'],
								'email'=>$_POST['email'],
								'grade' => $_POST['grade'],
								'under_branch'=>$_POST['under_branch'],
								'address'=>$_POST['address']
							);
                $this->Customer_model->edit($id,$data);
								$this->session->set_flashdata('success','update Successfully');
                redirect(base_url('admin/Customer_detail'));

            }
        }
        public function delete($id)
        {
            $this->Customer_model->delete($id);
            redirect(base_url('admin/Customer_detail'));
        }
				public function deletecustomer(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('customer_detail', array('id' => $value));
					}
				}

        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Customer_model->search($searchByCat,$searchValue);
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

		public function userExist()
	{
			if ($_POST) {
				$output = '';
				$data = $this->Customer_model->get_user_exist($_POST['customername']);
				// echo $data;exit;
				if($data){
					// echo "yes";
					 echo TRUE;
				}else{
					// echo "no";
					 echo FALSE;
				}
			}else{
				echo json_encode(array('error'=>true, 'msg'=>'somthing want wrong :('));
			}

	}


	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
