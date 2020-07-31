<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class FDA extends CI_Controller {

		public function __construct(){
        parent::__construct();
		check_login_user();
        $this->load->model('Fabric_model');
        $this->load->model('Design_model');
	    $this->load->model('FDA_model');

    	}


    	public function index(){
	        $data = array();
	        $data['name']='Fabric Design Asign';
	        $data['fabric_data']=$this->FDA_model->get_fabric_name();

					$data['fabric_name']=$this->FDA_model->get_fda_fabric_name();
	        //echo print_r($data['fabric_data']);exit;
		      $data['main_content'] = $this->load->view('admin/FDA/asign', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}


          public function delete($id)
        {
            $this->Fabric_model->delete($id);
            redirect(base_url('admin/Fabric'));
        }
  		public function delete_fda($id)
        {
            $this->FDA_model->delete($id);
            redirect($_SERVER['HTTP_REFERER']);
        }


			public function get_fabric_name_value()
				{
						if ($_POST) {
							$data=array();
							$data['fabric_type']=$_POST['fabricType'];
							$data['fabric_name']=$_POST['fabricName'];
							$data['data_value'] = $this->FDA_model->get_design_details($_POST['fabricType'], $data['fabric_name']);
							//
							$data['data'] = $this->load->view('admin/FDA/asign_page', $data, TRUE);
		  	      $this->load->view('admin/FDA/index', $data);
				      }
		  	}

				public function get_fda_group_list(){
						$data['data_value'] = $this->FDA_model->get_fda_group_list();
						$data['data'] = $this->load->view('admin/FDA/assign_result', $data, TRUE);
						$this->load->view('admin/FDA/index', $data);
				}

				public function get_fda_details($fabric_name)
					{
								$fabric_name = sanitize_url($fabric_name);
								$data=array();
								$data['name']='Fabric Design List';
								$data['fda_data']=$this->FDA_model->get_fda_data($fabric_name);
								$data['main_content'] = $this->load->view('admin/FDA/fda_list', $data, TRUE);
			   	      $this->load->view('admin/index', $data);

			  	}



	      	public function submit_value()
				  {
						if ($_POST) {
							$data=array();
							if (is_array($_POST['selected'])) {
								for($i = 0; $i < count($_POST['selected']); $i++){
									$data=array(
										'fabric_type' =>$_POST['fabric_type'],
										'fabric_name' =>$_POST['fabric_name'],
										'design_id' =>$_POST['selected'][$i],
									);
									$insert_id=	$this->FDA_model->insert($data,'fda_table');
									if ($insert_id) {
										echo json_encode(array('error' => 0, 'msg' => 'Assign Design Success'));
									}else {
										echo json_encode(array('error' => 1, 'msg' => 'Assign Design Faild'));
									}
							}
            }
					}
				}





	}


 ?>
