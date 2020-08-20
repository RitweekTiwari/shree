<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dye_transaction extends CI_Controller {

		public function __construct(){
        parent::__construct();
		check_login_user();
       
	    
        $this->load->model('Common_model');
        $this->load->model('Job_work_party_model');
        $this->load->model('DyeTransaction_model');
        
    	}


    	public function index(){
	        $data = array();
	        $data['name']='Fabric Return Chalan';
			$data['febName']=$this->Common_model->febric_name();
			$data['unit']=$this->DyeTransaction_model->select('unit');
			$data['branch_data']=$this->Job_work_party_model->get();
	        // pre($data['branch_data']);exit;
		      $data['main_content'] = $this->load->view('admin/dye_transaction/issue/add', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}
		  public function showRecieve(){
	        $data = array();
			$data['name']='Add Dye Recieve Transaction';
			$data['febName']=$this->Common_model->febric_name();
			$data['unit']=$this->DyeTransaction_model->select('unit');
			$data['branch_data']=$this->Job_work_party_model->get();
            
		      $data['main_content'] = $this->load->view('admin/dye_transaction/recieve/addRecieve', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}  
		
		public function showRecieveList(){
	        $data = array();
			$data['name']='RECIEVE List';
			$type='recieve';
            $data['frc_data']=$this->DyeTransaction_model->get($type);
		      $data['main_content'] = $this->load->view('admin/dye_transaction/recieve/list_recieve', $data, TRUE);
  	      $this->load->view('admin/index', $data);
		}
		public function showReturnList(){
	        $data = array();
			$data['name']='iSSUE List';
			$type='issue';
            $data['frc_data']=$this->DyeTransaction_model->get($type);
		      $data['main_content'] = $this->load->view('admin/dye_transaction/issue/list_issue', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}
		
          public function delete($id)
        {
            
           $ids = $this->input->post('ids');

		 $userid= explode(",", $ids);
		 foreach ($userid as $value) {
		  $this->db->delete( 'fabric_challan',array('id' => $value));
		}
        }

	public function addChallan($godown)
	{

		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r(count($data['obc']));exit;
			$count = count($data['pbc']);
			$id = $this->Transaction_model->getId('from_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['FromGodown'], 'arr');
			if (!$id) {
				$challan1 =
				$godown_name->outPrefix . '/OUT/' . $godown_name->outStart . '/' . $godown_name->outSuffix;
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan1 = $godown_name->outPrefix . '/ OUT /' . (string) $cc . '/' . $godown_name->outSuffix;
			}
			$id = $this->Transaction_model->getId('to_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['ToGodown'], 'arr');
			if (!$id) {
				$challan2 =  $godown_name->inPrefix . '/ IN /' . $godown_name->inStart . '/' . $godown_name->inSuffix;
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$challan2 = $godown_name->inPrefix . '/ IN /' . (string) $cc . '/' . $godown_name->inSuffix;
			}
			$data1 = [
				'from_godown' => $data['FromGodown'],
				'to_godown'  => $data['ToGodown'],
				'fromParty' => $data['FromParty'],
				'toParty'  => $data['toParty'],
				'created_at' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],
				'challan_out' => $challan1,
				'challan_in' => $challan2,
				'counter' => $cc,
				'counter2' => $cc1,
				'pcs' => $count,
				'jobworkType' => $data['workType'],

				'transaction_type' => 'dye'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				if ($_POST['color'][$i]) {
					$data2 = [
						'transaction_id' => $id,

						'order_barcode' => $data['pbc'][$i],

						'color ' => $data['color'][$i],

					];

					$this->Transaction_model->insert($data2, 'transaction_meta');
					$this->Transaction_model->update(array('isStock' => 0), 'parent_barcode', $data['pbc'][$i],  'fabric_stock_received');
					$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
		
		public function addIssue(){
			if($_POST){
				$data = $this->security->xss_clean($_POST);
				// echo "<pre>"; print_r($data);exit;
				$count =count($data['pbc']);
				$total_qty=0;
				for ($i=0; $i < $count ; $i++) { 
					$total_qty =$total_qty +  $data['quantity'][$i];
				}
				$data1 =[
					'from_godown' =>$data['FromGodown'],
					'to_godown'  => $data['ToGodown'],
					'fromParty' =>$data['FromParty'],
					'toParty'  => $data['toParty'],
					'created_at' => date('Y-m-d'),
					'created_by' => $_SESSION['userID'],
					
					'jobworkType' => $data['workType'],
					
					'transaction_type' => 'issue'

				];
				$id =	$this->DyeTransaction_model->insert($data1, 'dye_transaction');
				for ($i=0; $i < $count; $i++) { 
				$data2=[
					'dye_transaction_id' => $id,
					'pbc' =>$data['pbc'][$i],
					'fabric' => $data['fabric_name'][$i],
					'color' => $data['color'][$i],
					'hsn' => $data['hsn'][$i],
					'current_qty' => $data['quantity'][$i],
					'unit' => $data['unit'][$i],
					'remark' =>  $data['remark'][$i],
					'days_left' => $data['days'][$i],
				]	;
					$this->DyeTransaction_model->insert($data2, 'dye_transaction_meta');
				}
				
			} redirect($_SERVER['HTTP_REFERER']);
		}
		
	   
		   
 public function getPBC()
    {
      $id= $this->security->xss_clean($_POST['id']);
    $data = array();
     $data['pbc']=$this->DyeTransaction_model->getPBC_deatils($id);
     echo json_encode($data['pbc']);

    }
     public function get_godown()
    {
      $id= $this->security->xss_clean($_POST['party']);
    $data = array();
     $data['godown']=$this->DyeTransaction_model->get_godown($id);
     echo json_encode($data['godown']);

    }
		public function filter()
        {
            $data=array();
            if ($_POST) {
              $data['cat']=$this->input->post('searchByCat');
			  $data['Value']=$this->input->post('searchValue');
			  $data['type']=$this->input->post('type');
                $output = "";

				$data=$this->Frc_model->search($data);
				
                foreach ($data as $value) {
                    
                    $output .= "<tr id='tr_".$value['fc_id']."'>";
                    $output .="<td><input type='checkbox' class='sub_chk' data-id=".$value['fc_id']."></td>";
						 $output .="<td>".$value['challan_date']."</td>

                                          <td>".$value['sort_name']."</td>
                                         <td>". $value['challan_no']."</td>
                                           <td>". $value['fabric_type']."</td>
                                          
                                          <td>".$value['total_quantity']."</td>
                                          <td>".$value['unitName']."</td>
                                          <td>". $value['total_amount']."</td>";
                    
                    $output .= "<td><a href='#".$value['fc_id']."' class='text-center tip' data-toggle='modal' data-original-title='Edit'><i class='fas fa-edit blue'></i></a>
                    
                    </td>";
                   $output .= "</tr>";
                            }
              echo json_encode($output);
            }
        }
public function date_filter()
        {
            $data=array();
            if ($_POST) {
             
			  $data['from']=$this->input->post('date_from');
			  $data['to']=$this->input->post('date_to');
			  $data['type']=$this->input->post('type');
                $output = "";

				$data=$this->Frc_model->search_by_date($data);
				
                foreach ($data as $value) {
                    
                    $output .= "<tr id='tr_".$value['fc_id']."'>";
                    $output .="<td><input type='checkbox' class='sub_chk' data-id=".$value['fc_id']."></td>";
						 $output .="<td>".$value['challan_date']."</td>

                                          <td>".$value['sort_name']."</td>
                                         <td>". $value['challan_no']."</td>
                                           <td>". $value['fabric_type']."</td>
                                          
                                          <td>".$value['total_quantity']."</td>
                                          <td>".$value['unitName']."</td>
                                          <td>". $value['total_amount']."</td>";
                    
                    $output .= "<td><a href='#".$value['fc_id']."' class='text-center tip' data-toggle='modal' data-original-title='Edit'><i class='fas fa-edit blue'></i></a>
                    
                    </td>";
                   $output .= "</tr>";
                            }
              echo json_encode($output);
            }
        }
public function filter1()
							{
						$data1=array();
						$this->security->xss_clean($_POST);
									if ($_POST) {
						//	echo"<pre>";	print_r($_POST); exit;
								$data1['from']=$this->input->post('date_from');
								$data1['to']=$this->input->post('date_to');
								$data1['search']=$this->input->post('search');
								$data1['type']=$this->input->post('type');
								$data['from']=$data1['from'];
								$data['to']=$data1['to'];
								$data['type']=$data1['type'];
								$caption='Search Result For : ';
										if($data1['search']=='simple'){
											if($_POST['searchByCat']!="" || $_POST['searchValue']!=""){
												$data1['cat']=$this->input->post('searchByCat');
												$data1['Value']=$this->input->post('searchValue');
												$caption=$caption.$data1['cat']." = ".$data1['Value']." ";
											}
										$data['frc_data']=$this->DyeTransaction_model->search($data1);

							}else{
							if(isset($_POST['from_godown']) && $_POST['from_godown']!="" ){
							  $data1['cat'][]='from_godown';
							  $fab=$this->input->post('from_godown');
								$data1['Value'][]=$fab;
								$caption=$caption.'from godown'." = ".$fab." ";
								}
								$data['frc_data']=$this->DyeTransaction_model->search($data1);
							}
								if($data1['type']=='issue'){
									$data['caption']=$caption;
									$data['febName']=$this->Common_model->febric_name();
									$data['main_content'] = $this->load->view('admin/dye_transaction/issue/list_issue', $data, TRUE);
									$this->load->view('admin/index', $data);

								}	elseif($data1['type']=='receive'){
												$data['caption']=$caption;
												$data['febName']=$this->Common_model->febric_name();
												$data['main_content'] = $this->load->view('admin/dye_transaction/recieve/list_recieve', $data, TRUE);
												$this->load->view('admin/index', $data);
											}
												else{
													 $data['main_content'] = $this->load->view('admin/FRC/stock/search');
													 $this->load->view('admin/index', $data);
												}
									}
							}


	}


 ?>
