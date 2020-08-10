<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EMB extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('Erc_model');
      	$this->load->model('Emb_model');
    }
    public function index()
    {
        $data = array();
        $data['name'] = 'ERC';

		    $data['worker'] = $this->Emb_model->get_worker_name();
	     	$data['emb'] = $this->Emb_model->get_emb();
				$data['erc_value'] = $this->Emb_model->get_erc_value();

				//$data['erc'] = $this->Emb_model->get_erc_fresh_value();
				$data['erc'] = $this->Emb_model->get_erc_fresh_value();

        $data['main_content'] = $this->load->view('admin/master/emb/emb', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


// public function update($id)
//     {
// 		if ($_POST) {
// 							$datajob = array(
// 								'workerName' =>$_POST['job'],
// 								'rate' =>$_POST['rate']
// 							);
// 							$this->Emb_model->update($id,$datajob);
// 							redirect(base_url('admin/emb'));
//         }
//     }
		public function add_emb(){
      $data=array();
			if ($_POST) {

				$data=array(
						'designName'=> $_POST['design'],
						// 'embrate'=> $_POST['embrate'],
				);
						$id=$this->Emb_model->insert($data,'emb');
						if($id){
							for($i = 0; $i < count($_POST['job']); $i++) {
								$data = array(
                   'embId' =>$id,
									'workerName' =>$_POST['job'][$i],
									'rate' =>$_POST['rate'][$i]
								);
								$this->Emb_model->insert($data,'embmeta');
							}
							$this->session->set_flashdata(array('error' => 0, 'msg' => 'Emb Added Successfully'));
							redirect(base_url('admin/emb'));
						}
					else{
						$this->session->set_flashdata(array('error' => 1, 'msg' => 'Emb Added Faild'));
						redirect(base_url('admin/emb'));
					}
				}

        }
				public function update_embmeta($id){
					$data=array();
					if ($_POST) {

									for($i = 0; $i < count($_POST['inId']); $i++) {
										$data = array(
											'rate' =>$_POST['rate'][$i]
										);
										$this->Emb_model->update($_POST['inId'][$i],$data);
									}
									$this->session->set_flashdata(array('error' => 0, 'msg' => 'Update Successfully'));
									redirect($_SERVER['HTTP_REFERER']);

						}

						}
				public function get_emb_details($id)
				{
						$data = array();
						$data['name'] = 'Worker';
						$data['worker'] = $this->Emb_model->get_embmeta($id);
						$data['id'] = $id;
						

						$data['main_content'] = $this->load->view('admin/master/emb/edit', $data, TRUE);
						$this->load->view('admin/index', $data);
				}
				public function view_worker($id)
				{
						$data = array();
						$data['name'] = 'Worker';
						$data['jobworker'] = $this->Emb_model->get_worker_name();
						$data['worker'] = $this->Emb_model->get_embmeta($id);
						//pre($data['worker']);exit;

						$data['emb'] = $this->Emb_model->get_emb();
						$data['erc'] = $this->Emb_model->get_erc_design_name();

						$data['main_content'] = $this->load->view('admin/master/emb/view', $data, TRUE);
						$this->load->view('admin/index', $data);
				}

		public function EmbRate()
		{
			if ($_POST) {
				$data = $this->Emb_model->embRate($_POST['desName']);
				   //print_r($data);exit;
				echo $data->rate;
			}
		}

     public function delete($id)
        {
            $this->Emb_model->delete($id);
            redirect(base_url('admin/emb'));
        }
				public function deleteembmeta($id)
		 			{
		 					$this->Emb_model->delete_emeta($id);
		 					redirect(base_url('admin/emb'));
		 			}

  }
