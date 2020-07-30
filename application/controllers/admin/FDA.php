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
					//echo "<pre>";	print_r($_POST);exit;
							$data=array();
							$data['fabric_type']=$_POST['fabricType'];
							$data['fabric_name']=$_POST['fabricName'];
			$sql = '';

			$output = array();

			
			if (!empty($_POST["search"]["value"])) {

				$sql .= 'SELECT design.id, design.designName, erc.desCode, design.stitch FROM design
            LEFT JOIN erc ON design.designName = erc.desName
            LEFT JOIN src ON src.fabName = design.fabricName AND src.fabCode = erc.desCode
            WHERE  design.designSeries=0 AND design.id NOT IN (SELECT design_id FROM fda_table WHERE fabric_name = "' . $data['fabric_name'] . '") OR ';
				$sql .= ' design.designName LIKE "%' . $_POST["search"]["value"] . '%" ';
				$sql .= 'OR erc.desCode LIKE "%' . $_POST["search"]["value"] . '%" ';
				$sql .= 'OR design.stitch LIKE "%' . $_POST["search"]["value"] . '%" ';
				
			} else {

				$sql .= 'SELECT design.id, design.designName, erc.desCode, design.stitch FROM design
            LEFT JOIN erc ON design.designName = erc.desName
            LEFT JOIN src ON src.fabName = design.fabricName AND src.fabCode = erc.desCode
            WHERE  design.designSeries=0 AND design.id NOT IN (SELECT design_id FROM fda_table WHERE fabric_name = "' . $data['fabric_name'] . '") ';
			}

			if (!empty($_POST["order"])) {
				$sql .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
			} else {
				$sql .= ' ORDER BY id ASC ';
			}

			if ($_POST["length"] != -1) {
				$sql .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}
			
			
			$query = $this->db->query($sql);
			
			$result = $query->result_array();
			
			$filtered_rows = $query->num_rows();
			foreach ($result as $value) {
				
				$sub_array = array();
				
				$sub_array[] =  $value['id'] ;
				$sub_array[] = $value['designName'];
				$sub_array[] = $value['desCode'];
				$sub_array[] = $value['stitch'];
				
				$data1[] = $sub_array;
			}
		$t=	$this->FDA_model->get_design_details_count($data['fabric_name']);
		
			$output = array(
				"draw" => intval($_POST["draw"]),
				'fabric_type' => $data['fabric_type'],
				'fabric_name' => $data['fabric_name'],
				"recordsTotal" => $t->count,
				"recordsFiltered" => $t->count,
				"data" => $data1
			);

			echo json_encode($output);
							
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
