<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Data_category extends CI_Controller {


		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Data_cate_model');
    	}


    	public function index(){
	        $data = array();
					$data['name']='Order Category';
	        $data['data_cate_data']=$this->Data_cate_model->get();
					$data['main_content'] = $this->load->view('admin/master/categorys/index', $data, TRUE);
					$this->load->view('admin/index', $data);
    	}
    	public function addDataCate()
    	{
    		if ($_POST)
    		{
    			$data=$this->input->post();
    			// print_r($data);
    			$this->Data_cate_model->add($data);
    			redirect(base_url('admin/Data_category'));

    		}
    	}
    	public function edit($id)
        {
            if ($_POST) {
                $data=$this->input->post();
                $this->Data_cate_model->edit($id,$data);
                redirect(base_url('admin/Data_category'));
            }
            // echo $id;
            // $this->load->view('admin/branch_detail');
            //
        }

        public function delete($id)
        {
            $this->Data_cate_model->delete($id);
            redirect(base_url('admin/Data_category'));
        }
				public function delete_category(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('data_category', array('id' => $value));
					}
				}

        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Data_cate_model->search($searchByCat,$searchValue);
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

	/* End of file Branch_detail.php */
	/* Location: ./application/controllers/admin/Branch_detail.php */

 ?>
