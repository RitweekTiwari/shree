<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fabric extends CI_Controller {

		public function __construct(){
        parent::__construct();
				check_login_user();
        $this->load->model('Fabric_model');
				$this->load->model('Hsn_model');
    	}


    	public function index(){
	        $data = array();
	        $data['name']='Fabric';
	        $data['fabric_data']=$this->Fabric_model->get();
					$data['hsn_data']=$this->Hsn_model->hsn();
					$data['main_content'] = $this->load->view('admin/master/fabric/fabric', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}
    	public function addFabric()
    	{
    		if ($_POST)
    		{
    			$data=array(
    				'fabricName'=>$_POST['fabricName'],
    				'fabHsnCode'=>$_POST['fabHsnCode'],
    				'fabricType'=>$_POST['fabricType'],
    				'fabricCode'=>$_POST['fabricCode']
    			);
    			// print_r($data);
    			$this->Fabric_model->add($data);
    			redirect(base_url('admin/Fabric'));

    		}
    	}
        public function edit($id)
        {
            if ($_POST) {
               $data=array(
    				'fabricName'=>$_POST['fabricName'],
    				'fabHsnCode'=>$_POST['fabHsnCode'],
    				'fabricType'=>$_POST['fabricType'],
    				'fabricCode'=>$_POST['fabricCode']
    			);
                // print_r($data);
                $this->Fabric_model->edit($id,$data);
                redirect(base_url('admin/Fabric'));

            }
        }
        public function delete($id)
        {
            $this->Fabric_model->delete($id);
            redirect(base_url('admin/Fabric'));
        }
				public function deletefabric(){
					$ids = $this->input->post('ids');
					 $userid= explode(",", $ids);
					 foreach ($userid as $value) {
							$this->db->delete('fabric', array('id' => $value));
					}
				}


        public function filter()
        {
            $data=array();
            if ($_POST) {
              $searchByCat=$this->input->post('searchByCat');
              $searchValue=$this->input->post('searchValue');
                $output = "";
                $data=$this->Fabric_model->search($searchByCat,$searchValue);
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

		public function fabricExist()
			 {
					if ($_POST) {
						$output = '';
						$data = $this->Fabric_model->get_fabric_exist($_POST['fabricName']);
						//echo print_r($data);exit;
						if($data){

							 echo TRUE;
						}else{

							echo FALSE;
						}
					}else{
						echo json_encode(array('error'=>true, 'msg'=>'somthing want wrong :('));
					}

			}

	}

	/* End of file Dashboard.php */
	/* Location: ./application/controllers/admin/Dashboard.php */
 ?>
