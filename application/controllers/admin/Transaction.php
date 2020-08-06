<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Transaction extends CI_Controller {

		public function __construct(){
        parent::__construct();
		check_login_user();
       
	    
        $this->load->model('Common_model');
        $this->load->model('Job_work_party_model');
        $this->load->model('Transaction_model');
		$this->load->model('Sub_department_model');
		
		}
		
	public function home($godown)

	{
		$data = array();
		$godown_name = $this->Transaction_model->get_godown_by_id($godown);
		$data['page_name'] = $godown_name.'  DASHBOARD';
		
		$data['godown'] = $godown;
		if($godown==17){
			$data['main_content'] = $this->load->view('admin/transaction/index_plain', $data, TRUE);

		}else if($godown == 19){
			$data['main_content'] = $this->load->view('admin/transaction/index_finish', $data, TRUE);
		}else{
			$data['main_content'] = $this->load->view('admin/transaction/index', $data, TRUE);
		}
		$this->load->view('admin/index', $data);
	}
		
	public function showChallan($godown){
			$data = array();
			$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
			$link=' <a href='.base_url('admin/transaction/home/') . $godown. '>Home</a>';
			$data['page_name']= $data['godown'].'  DASHBOARD /'.$link;
			$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
			foreach($plain_godown as $row){
				$data['plain'][]=$row['godownid'];
			}
			
			$data['id'] = $godown;
			$data['job'] = $this->Transaction_model->get_jobwork_by_id($godown);
			$data['branch_data']=$this->Job_work_party_model->get();
	        //echo print_r($data['fabric_data']);exit;
		    $data['main_content'] = $this->load->view('admin/transaction/challan/add', $data, TRUE);
  	      	$this->load->view('admin/index', $data);
		}
	public function showDispatch($godown)
	{
		$data = array();
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$data['id']= $godown;
		$data['job'] = $this->Transaction_model->get_jobwork_by_id($godown);
		$data['branch_data'] = $this->Job_work_party_model->get();
		//echo print_r($data['fabric_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
		
		  public function showRecieve($godown){
	        $data = array();
			$data['page_name']= '  DASHBOARD';
		
			$data['branch_data']=$this->Job_work_party_model->get();
            
		      $data['main_content'] = $this->load->view('admin/transaction/bill/add', $data, TRUE);
  	      $this->load->view('admin/index', $data);
    	}  
		
		public function showRecieveList($godown){
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
			$data['page_name']= $data['godown']. '  DASHBOARD /' . $link;
			
            $data['frc_data']=$this->Transaction_model->get('to_godown', $godown, 'challan');
		      $data['main_content'] = $this->load->view('admin/transaction/list_in', $data, TRUE);
  	      $this->load->view('admin/index', $data);
		}

	public function showDispatch_list($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;

		$data['frc_data'] = $this->Transaction_model->get('from_godown', $godown, 'dispatch');
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/list_dispatch', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_TC($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /'. $link;
		$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
			foreach($plain_godown as $row){
				$data['plain'][]=$row['godownid'];
			}
			
			$data['id'] = $godown;
		
		$data['main_content'] = $this->load->view('admin/transaction/tc/create', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function show_Add_TC($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
			foreach($plain_godown as $row){
				$data['plain'][]=$row['godownid'];
			}
		$data['data']=$this->Transaction_model->get_tc($godown);
		//echo "<pre>";print_r($data['data']);exit;	
			$data['id'] = $godown;
		$data['content'] = $this->load->view('admin/transaction/tc/tc_index', $data, TRUE);
		$data['main_content'] = $this->load->view('admin/transaction/tc/add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
		public function show_TC_list($godown)
	{
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
		$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
			foreach($plain_godown as $row){
				$data['plain'][]=$row['godownid'];
			}
		$data['data']= $this->Transaction_model->get('from_godown', $godown, 'tc');
			$data['id'] = $godown;
		
		$data['main_content'] = $this->load->view('admin/transaction/tc/tc_list', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
		public function showReturnList($godown){
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
			$data['page_name']= $data['godown']. '  DASHBOARD /' . $link;
			
            $data['frc_data']=$this->Transaction_model->get('from_godown', $godown,'challan');
		      $data['main_content'] = $this->load->view('admin/transaction/list_out', $data, TRUE);
  	      $this->load->view('admin/index', $data);
		}
	
		public function showStock($godown)
	{
		
		$data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
		$data['godownid']=$godown;
		$data['page_name'] = $data['godown']. '  DASHBOARD /' . $link;
		$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
		$found=0;
		foreach($plain_godown as $row){
		if($godown==$row['godownid']){
			$found=1;
		$data['plain_data'] = $this->Transaction_model->get_plain_stock($godown);
		$data['frc_data'] = $this->Transaction_model->get_frc_stock($godown);
		//$data['godown_data'] = $this->Transaction_model->get_stock($godown);	
		//echo "<pre>";print_r($data['godown_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/stock_plain', $data, TRUE);

		}
		}
		if($found==0){
		$data['frc_data'] = $this->Transaction_model->get_stock($godown);
		$data['main_content'] = $this->load->view('admin/transaction/stock', $data, TRUE);
		}
		

		$this->load->view('admin/index', $data);
	}
	
	public function viewChallan($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_trans_by_id($id);
		
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['to_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub2']. '  DASHBOARD /' . $link;
		$data['godown']=$data['trans_data'][0]['to_godown'];
		$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
		$data['id'] = $id;
		$data['branch_data']=$this->Job_work_party_model->get();
		//echo "<pre>"; print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/challan/view', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function viewChallanOut($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_trans_by_id($id);
		$data['frc_data'] = $this->Transaction_model->get_by_id($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['to_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub2']. '  DASHBOARD /' . $link;
		$data['job2'] = $this->Transaction_model->get_jobwork_by_id($data['trans_data'][0]['to_godown']);
		$data['branch_data']=$this->Job_work_party_model->get();
		$data['id'] = $id;
		
		//echo "<pre>"; print_r($data['frc_data']);exit;
		$data['main_content'] = $this->load->view('admin/transaction/challan/viewOut', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
	public function viewDispatch($id)
	{
		$data = array();
		$data['trans_data'] = $this->Transaction_model->get_dispatch($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['trans_data'][0]['from_godown'] . '>Home</a>';
		$data['page_name'] = $data['trans_data'][0]['sub1'] . '  DASHBOARD /' . $link;

		$data['id'] = $id;

		$data['main_content'] = $this->load->view('admin/transaction/dispatch/view', $data, TRUE);
	
		$this->load->view('admin/index', $data);
	}
	public function viewtc($id)
	{
		$data = array();
		$data['data']= $this->Transaction_model->view_tc($id);
		$link = ' <a href=' . base_url('admin/transaction/home/') . $data['data'][0]['from_godown'] . '>Home</a>';
		$data['page_name'] = $data['data'][0]['sub1'] . '  DASHBOARD /' . $link;
		
		$data['id'] = $id;

		$data['main_content'] = $this->load->view('admin/transaction/tc/view', $data, TRUE);
	
		$this->load->view('admin/index', $data);
	}

	public function getChallan($id)
	{
		$query = '';

		$output = array();

		$data = array();

		if (!empty($_GET["search"]["value"])) {

			$query .= 'SELECT * FROM transaction_meta WHERE transaction_id = "' . $id . '" AND';
			$query .= ' pbc LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR order_barcode LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR order_number LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR fabric_name LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR hsn LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR design_name LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR design_code LIKE "%' . $_GET["search"]["value"] . '%" ';
			$query .= 'OR unit LIKE "%' . $_GET["search"]["value"] . '%" ';
		} else {

			$query .= 'SELECT * FROM transaction_meta join order_view on order_view.order_barcode=transaction_meta.order_barcode WHERE transaction_id = "' . $id . '" ';
		}

		if (!empty($_GET["order"])) {
			$query .= ' ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
		} else {
			$query .= ' ORDER BY order_view.order_barcode ASC ';
		}

		if ($_GET["length"] != -1) {
			$query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
		}

		$sql = $this->db->query($query);
		$result = $sql->result_array();
		$filtered_rows = $sql->num_rows();
	
            $c=1;$i=1;                       
         foreach ($result as $value) {
			 if($value['stat']=='recieved'){
				 $c+=1;
			 }
			 $i+=1;
			$sub_array= array();
			$sub_array[]="<input type=checkbox class=sub_chk data-id=".$value['transaction_id'].">";
			$sub_array[] = $value['pbc'];
			$sub_array[]= $value['order_barcode'];
			$sub_array[] = $value['order_number'];
			$sub_array[] = $value['fabric_name'];
			$sub_array[] = $value['hsn'];
			$sub_array[] = $value['design_name'];
			$sub_array[] = $value['design_code'];
			$sub_array[] = $value['dye'];
			$sub_array[] = $value['matching'];
			$sub_array[] = $value['quantity'];
			$sub_array[] =  $value['unit'];
			$sub_array[] =   $value['image'];
			$sub_array[] = $value['days_left'];
			$sub_array[] =  $value['remark'];
			$sub_array[] =  $value['stat'];
			$data[] = $sub_array;                    
		 }
		 if($c==$i){
			 $recieved=true;
		 }else{
			$recieved = false;
		 }
		$output = array(
			"recieved"=> $recieved,
			"draw" => intval($_GET["draw"]),
			"recordsTotal" => $filtered_rows,
			"recordsFiltered" => $filtered_rows,
			"data" => $data
		);

		echo json_encode($output);

	}
	public function recieve()
	{
		$id = $this->security->xss_clean($_POST['trans_id']);
		$data['status']='old';
		$this->Transaction_model->update($data,'transaction_id', $id, "transaction");
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function recieve_obc()
	{
		$obc = $this->security->xss_clean($_POST['obc']);
		$trans_id= $this->security->xss_clean($_POST['trans_id']);
		$id=$this->security->xss_clean($_POST['godown']);
		$plain_godown=$this->Transaction_model->get_distinct_plain_godown();
		foreach($plain_godown as $row){
				$plain[]=$row['godownid'];
			}
		//print_r($plain_godown);exit;
		try{

		$status = $this->Transaction_model->check_obc_by_trans_id($obc, $trans_id);
	 //echo "<pre>"; print_r($status);exit;
		if($status){
					
			$data['stat'] = 'recieved';
		$st=	$this->Transaction_model->update($data, 'trans_meta_id', $status->trans_meta_id, "transaction_meta");
		if(in_array($id,$plain)){
			$data=array();
			$data['status'] = 'DONE';
			$data['godown']=$id;	
			$st1=	$this->Transaction_model->update($data, 'order_barcode', $obc, "order_product");
			if($st1){
				echo "1";
			}else{
				echo "2";
			}

			}else{
				if($st){
				echo "1";
			}else{
				echo "2";
			}
			}
		}else{
			echo "0";
		}
		} catch (\Exception $e) {
			$error = $e->getMessage();
			echo $error;
		}
		
	}

	
	public function print_packing_slip()
	{

		$ids =  $this->security->xss_clean($_POST['ids']);
		

		//print_r($_POST['ids']);exit;
		foreach ($ids as $value) {
			if ($value != "") {
				
				$data1['id'] = $value;
				$r = $this->Transaction_model->get_dispatch($data1);
				
				$data['trans_data'][]= $r[0];
			}
		}
		//echo '<pre>';	print_r($data['trans_data']);exit;
		$date=date_create($data['trans_data'][0]['created_at']);
		
	 $html='<center><h1>SHREE NIKETAN SAREES PVT. LTD. CHANDAULI</h1></center>';	
	 $html=$html.'<center><h4 >PACKING SLIP</h4></center>';	
      $html=$html.'To :'. $data['trans_data'][0]['Party_name'].'';
	  $html=$html.'<span style="float:right">Challan no :'. $data['trans_data'][0]['challan_out'].'</span><br>';
	   $html=$html.'<div style="float:right">Date :'. date_format($date,"d/m/y ").'</div>';
		 $data['title']='SHREE NIKETAN SAREES PVT. LTD. CHANDAULI';
	  $data['head']=$html;
	 
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/index', $data, TRUE);
	 
		
		$this->load->view('admin/print/index', $data);
	}
	public function return_print_multiple()
	{
		$type =  $this->security->xss_clean($_POST['type']);
		if (isset($_POST['ids'])) {
			$ids =  $this->security->xss_clean($_POST['ids']);
			$godown =  $this->security->xss_clean($_POST['godown']);
			
			//print_r($_POST['ids']);exit;
			foreach ($ids as $value) {
				if ($value != "") {
					$data1['godown'] = $godown;
					$data1['id'] = $value;
					if ($type == 'tc') {
						$r = $this->Transaction_model->get_tc_stock($data1);
					} else {
						$r = $this->Transaction_model->get_stock($data1);
					}
					if(isset($r[0])){
						$data['data'][] = $r[0];
					}
					
				}
			}
		}

		if (isset($_POST['barcode'])) {
			$data['godown'] =  $this->security->xss_clean($_POST['godown']);
			$data['barcode'] =  $this->security->xss_clean($_POST['barcode']);
			$r = $this->Transaction_model->get_stock_by_obc($data);
			if (isset($r[0])) {
				$data['data'][] = $r[0];
			}
		}

		if (isset($data['data'])  && $data['data'][0]!= '') {
		//echo '<pre>';	print_r($data['data']);exit;
		if($type=='barcode2'){
		$data['main_content'] = $this->load->view('admin/transaction/dispatch/print', $data, TRUE);

		} else if($type == 'tc') {
			$data['main_content'] = $this->load->view('admin/transaction/tc/print', $data, TRUE);
		}
		else{
		$data['main_content'] = $this->load->view('admin/transaction/challan/multi_list_print', $data, TRUE);

		}
		} else {
			$data['main_content'] = 'No Result Found';
		}
		$this->load->view('admin/print/index', $data);
	}
	
	public function delete()
        {
            
           $ids = $this->input->post('ids');

		 $userid= explode(",", $ids);
		 foreach ($userid as $value) {
		  $this->db->delete('transaction',array('transaction_id' => $value));
			$this->db->delete('transaction_meta', array('transaction_id' => $value));
			}
     	}
  		
		public function addBill(){
			if($_POST){
				$data = $this->security->xss_clean($_POST);
				// echo "<pre>"; print_r($data);exit;
				$count =count($data['pbc']);
				$total_qty=0; 
				$total_val =0;
				for ($i=0; $i < $count ; $i++) { 
					$total_qty =$total_qty +  $data['qty'][$i];
					$total_val =$total_val + $data['total'][$i];
				}
			$id = $this->Transaction_model->getId();
			if (!$id) {
				$challan = "OUT1";
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = "OUT" . (string) $cc;
			}
				$data1 =[
					'challan_from' =>$data['fromGodown'],
					'challan_to'  => $data['toGodown'],
					'challan_date' => $data['PBC_date'],
					'created_by' => $_SESSION['userID'],
					'challan_out' =>  $data['PBC_challan'],
					'total_pcs' => $count,
					'total_quantity' => $total_qty,
					'total_amount' => $total_val,
					'fabric_type' => $data['fabType'][0],
					'unit' => $data['unit'][0],
					'challan_type' => 'bill'
				];
				$id =	$this->Frc_model->insert($data1, 'fabric_challan');
				for ($i=0; $i < $count; $i++) { 
				$data2=[
					'fabric_challan_id' => $id,
					'parent_barcode' =>$data['pbc'][$i],
					'fabric_id' => $data['fabric_name'][$i],
					'fabric_type' =>$data['fabType'][$i],
					'hsn' => $data['hsn'][$i],
					'stock_quantity' => $data['qty'][$i],
					'stock_unit' => $data['unit'][$i],
					'ad_no ' => $data['ADNo'][$i],
					'color_name ' => $data['color'][$i],
					'purchase_code' => $data['pcode'][$i],
					'purchase_rate' => $data['prate'][$i],
					'total_value' =>$data['total'][$i]
				]	;
					$this->Transaction_model->insert($data2, 'fabric_stock_received');
				}
				
			} redirect($_SERVER['HTTP_REFERER']);
		}
	

		public function addTC(){
			
			if($_POST){
				$data = $this->security->xss_clean($_POST);
				// echo "<pre>"; print_r($data);exit;
				$count =count($data['fquantity']);
			
				for ($i=0; $i < $count; $i++) { 
				$data2=[
					
					'finish_qty ' => $data['fquantity'][$i],
					'is_tc' =>0
				]	;

				
				$this->Transaction_model->update($data2,'trans_meta_id', $data['id'][$i],  'transaction_meta');
				
				}
			redirect($_SERVER['HTTP_REFERER']);
			}
		
		}

		public function add_tc_challan($godown){
			
			if($_POST){
				$data = $this->security->xss_clean($_POST);
				// echo "<pre>"; print_r($data);exit;
				$count =count($data['pbc']);
			$id = $this->Transaction_model->getId('from_godown',$godown,'tc');
			if (!$id) {
				$challan = 'TC/1';
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = 'TC' . (string) $cc;
			}
				$data1 =[
					'from_godown' =>$godown,
					
					'created_at' => date('Y-m-d'),
					'created_by' => $_SESSION['userID'],
				'challan_out' => $challan,
				'counter' => $cc,
				'pcs' => $count,
					'jobworkType' => "",
					
					'transaction_type' => 'tc'

				];
				$id =	$this->Transaction_model->insert($data1, 'transaction');
				for ($i=0; $i < $count; $i++) { 
				$data2=[
					'transaction_id' => $id,
					
					'order_barcode' =>$data['obc'][$i],
					
					'finish_qty ' => $data['fqty'][$i],
					
				]	;
				$this->Transaction_model->update(array('is_tc'=>1),'trans_meta_id', $data['id'][$i],  'transaction_meta');
					
						$this->Transaction_model->insert($data2, 'transaction_meta');
					
					

				}
				
			} redirect($_SERVER['HTTP_REFERER']);
		}

		public function addChallan($godown){
			
			if($_POST){
				$data = $this->security->xss_clean($_POST);
				// echo "<pre>"; print_r($data);exit;
				$count =count($data['pbc']);
			$id = $this->Transaction_model->getId('from_godown',$godown,'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['FromGodown']);
			if (!$id) {
				$challan1 =
				substr($godown_name,0, 4).'OUT/1';
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan1 = substr($godown_name, 0,4) . 'OUT/'. (string) $cc;
			}
			$id = $this->Transaction_model->getId('to_godown', $godown, 'challan');
			$godown_name = $this->Transaction_model->get_godown_by_id($data['ToGodown']);
			if (!$id) {
				$challan2 = substr($godown_name, 0,4) . 'IN/1';
			} else {
				$cc1 = $id[0]['count'];
				$cc1 = $cc1 + 1;
				$challan2 = substr($godown_name,0, 4) . 'IN/' . (string) $cc;
			}
				$data1 =[
					'from_godown' =>$data['FromGodown'],
					'to_godown'  => $data['ToGodown'],
					'fromParty' =>$data['FromParty'],
					'toParty'  => $data['toParty'],
					'created_at' => date('Y-m-d'),
					'created_by' => $_SESSION['userID'],
				'challan_out' => $challan1,
				'challan_in' => $challan2,
				'counter' => $cc,
				'counter2' => $cc1,
				'pcs' => $count,
					'jobworkType' => $data['workType'],
					
					'transaction_type' => 'challan'

				];
				$id =	$this->Transaction_model->insert($data1, 'transaction');
				for ($i=0; $i < $count; $i++) { 
				$data2=[
					'transaction_id' => $id,
					
					'order_barcode' =>$data['obc'][$i],
					
					'finish_qty ' => $data['quantity'][$i],
					
				]	;

					$this->Transaction_model->insert($data2, 'transaction_meta');
				$this->Transaction_model->update(array('status' => 'OUT'),'order_barcode', $data['obc'][$i],  'order_product');
				$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');
				}
				
			} redirect($_SERVER['HTTP_REFERER']);
		}

	public function addDispatch($godown)
	{
		
		if ($_POST) {
			$data = $this->security->xss_clean($_POST);
			// echo "<pre>"; print_r($data);exit;
			$count = count($data['pbc']);
			$id = $this->Transaction_model->getId('from_godown',$godown,'dispatch');
			if (!$id) {
				$challan = 'PKG-SL/1' ;
			} else {
				$cc = $id[0]['count'];
				$cc = $cc + 1;
				$challan = 'PKG-SL/' . (string) $cc;
			}
			$data1 = [
				'from_godown' => $data['FromGodown'],
				'to_godown'  => $data['ToGodown'],
				'fromParty' => $data['FromParty'],
				'toParty'  => $data['toParty'],
				'created_at' => date('Y-m-d'),
				'created_by' => $_SESSION['userID'],
				'challan_out' => $challan,
				'counter' => $cc,
				'pcs' => $count,
				'jobworkType' => $data['workType'],

				'transaction_type' => 'dispatch'

			];
			$id =	$this->Transaction_model->insert($data1, 'transaction');
			for ($i = 0; $i < $count; $i++) {
				$data2 = [
					'transaction_id' => $id,

					'order_barcode' => $data['obc'][$i],
					'stat' => 'pending',
					'finish_qty ' => $data['quantity'][$i],

				];

				$this->Transaction_model->insert($data2, 'transaction_meta');
				$this->Transaction_model->update(array('stat' => 'out'), 'trans_meta_id', $data['trans_id'][$i],  'transaction_meta');

			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getOrderDetails()
	{
		$data['obc'] = $this->security->xss_clean($_POST['id']);
		$data['godown'] = $this->security->xss_clean($_POST['godown']);
		
		$data['order'] = $this->Transaction_model->getOrderDetails($data);
		if ($data['order']) {
			echo json_encode($data['order']);
		} else {
			echo json_encode(0);
		}
	}
	
     public function get_godown()
    {
      $id= $this->security->xss_clean($_POST['party']);
    	$data = array();
     $data['godown']=$this->Transaction_model->get_godown($id);
     echo json_encode($data['godown']);

    }
		
		

		public function filter()
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
										$data['frc_data']=$this->Transaction_model->search1($data1);

							}else{
							if(isset($_POST['sort_name']) && $_POST['sort_name']!="" ){
								$data1['cat'][]='sort_name';
								$fab=$this->input->post('sort_name');
								$data1['Value'][]=$fab;
								$caption=$caption.' sort_name'." = ".$fab." ";
								}
								if(isset($_POST['challan']) && $_POST['challan']!="" ){
								  $data1['cat'][]='challan_out';
										$fab=$this->input->post('challan');
									$data1['Value'][]=$fab;
									$caption=$caption.'Challan No'." = ".$fab." ";
									}
									if(isset($_POST['unitName']) && $_POST['unitName']!="" ){
										 $data1['cat'][]='unitName';
											$fab=$this->input->post('unitName');
									   $data1['Value'][]=$fab;
										$caption=$caption.'unitName'." = ".$fab." ";
										}
										if(isset($_POST['total_amount']) && $_POST['total_amount']!="" ){
										$data1['cat'][]='total_amount';
										$fab=$this->input->post('total_amount');
										$data1['Value'][]=$fab;
										$caption=$caption.'total_amount'." = ".$fab." ";
										}
										if(isset($_POST['total_quantity']) && $_POST['total_quantity']!="" ){
											$data1['cat'][]='total_quantity';
											$fab=$this->input->post('total_quantity');
											$data1['Value'][]=$fab;
											$caption=$caption.'total_quantity'." = ".$fab." ";
											}
											if(isset($_POST['fabric_type']) && $_POST['fabric_type']!="" ){
										  $data1['cat'][]='fabric_type';
											$fab=$this->input->post('fabric_type');
											$data1['Value'][]=$fab;
											$caption=$caption.'fab_type'." = ".$fab." ";
											}
								$data['frc_data']=$this->Transaction_model->search1($data1);
							}
								if($data1['type']=='recieve'){
									$data['caption']=$caption;
									$data['febName']=$this->Common_model->febric_name();
									$data['main_content'] = $this->load->view('admin/transaction/bill/list_bill', $data, TRUE);
									$this->load->view('admin/index', $data);

								}	elseif($data1['type']=='return'){
												$data['caption']=$caption;
												$data['febName']=$this->Common_model->febric_name();
												$data['main_content'] = $this->load->view('admin/transaction/challan/list_challan', $data, TRUE);
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
