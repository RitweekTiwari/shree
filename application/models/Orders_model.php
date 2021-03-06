<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Orders_model extends CI_Model {

    public function allOrder()
		{
		
			$this->db->select('*');
            $this->db->from('orders');
            $this->db->order_by("id", "desc");
			$rec= $this->db->get();
			return $rec->result();

		}
		public function getFabricDetails($id)
 {
		
   $this->db->select('hsn.unit,fabric.fabHsnCode');
   $this->db->from('fabric');
   $this->db->join('hsn','hsn.hsn_code=fabric.fabHsnCode','left');
   $this->db->where('fabric.fabricName',$id);
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 	public function getFabricDesign($id)
 {
		
   $this->db->select('design.designName,fda_table.design_id');
   $this->db->from('fda_table');
   $this->db->join('design','design.id=fda_table.design_id','inner');
   $this->db->where('fda_table.fabric_name',$id);
		$this->db->order_by('design.designName', 'asc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function getDesignDetails($id)
 {
		 $this->db->select();
   $this->db->from('design_view');

   $this->db->where('barCode',$id);
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
	public function getCount()
	{
		$this->db->select('Max(counter) as count');
		$this->db->from("order_product");

		$rec = $this->db->get();
		//  print_r($rec);exit;
		return $rec->result_array();
	}
	public function getId($type,$branch)
	{
		$this->db->select('Max(counter) as count');
		$this->db->from("order_table");
		$this->db->where('data_category', $type);
		$this->db->where('branch_name', $branch);
		$rec = $this->db->get();
		//  print_r($rec);exit;
		return $rec->result_array();
	}

 public function getDesign($id)
	{
		
		$this->db->select('desCode,stitch,dye,matching');
		$this->db->from('design_view');

		$this->db->where('designName', $id);
		$this->db->where('designSeries', 0);
		return $this->db->get()->result_array();


	}
public function get_design_name()
 {
		
   $this->db->select('distinct(designName)');
   $this->db->from('design');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_order($order_id)
 {
		
   $this->db->select('order_product.*,customer_detail.name as customer,order_table.order_number');
   $this->db->from('order_table');
   $this->db->join('order_product ','order_table.order_id = order_product.order_id','inner');
   $this->db->where('order_table.order_id', $order_id);
	$this->db->join('customer_detail ', 'customer_detail.id = order_table.customer_name', 'inner');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_order_complete()
 {
		
   $this->db->select('*');
   $this->db->from('order_view');
   $this->db->where('status', 'DONE');

   $query = $this->db->get();

   $query = $query->result_array();
   return $query;
 }
 public function get_order_pending()
 {
		

   $this->db->select('*');
   $this->db->from('order_view');
   $this->db->where('status', 'PENDING');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
	public function get_branch()
	{
		
		$this->db->select('id,name');
		$this->db->from('branch_detail');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}
	public function get_customer($id)
	{
		
		$this->db->select('id,name');
		$this->db->where('under_branch', $id);
		$this->db->from('customer_detail');
		$query = $this->db->get();
		// echo $this->db->last_query($query);exit;
		$query = $query->result_array();
		return $query;
	}
	public function get_pbc_by_order($id)
 {
		
		$this->db->select('pbc');
		$this->db->from('order_product');
		$this->db->where('order_product_id', $id);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row()->pbc;
		}else{
			return 0;
		}

 }
 public function get_order_cancel()
 {
		
   $this->db->select('*');
   $this->db->from('order_cancel_cause');
	$this->db->join('order_view ', 'order_cancel_cause.order_id = order_view.order_product_id','inner');
      $this->db->join('cause_list ','cause_list.id = order_cancel_cause.cause','inner');

	$this->db->where('status', 'CANCEL');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_order_count()
 {
		
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(order_id)
                            FROM order_product
                            WHERE (status = "PENDING")
                            )
                            AS pending', TRUE);

        $this->db->select('(SELECT count(order_id)
                            FROM order_product
                            WHERE (status = "CANCEL")
                            )
                            AS cancel',TRUE);
        $this->db->select('(SELECT count(order_id)
                            FROM order_product
                            WHERE (status = "OUT")
                            )
                            AS inprocess',TRUE);
        $this->db->select('(SELECT count(order_id)
                            FROM order_product
                            WHERE (status = "DONE")
                            )
                            AS done',TRUE);
         $this->db->from('order_product');
   	 		$query = $this->db->get();
   			return $query->row();
 }

	public function get_order_product_by_id($order_id){
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('order_product');
		if($query->num_rows() == 1) {
				return true;
		}else{
				return false;
		}
	}
  public function checkorder($order){
		
        $this->db->select('*');

        $this->db->from('order_table');

        $this->db->where('order_number', $order);

        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {

            return $query->result();

        }else{

            return false;

        }

    }
	

	public function get_order_flow($cat)
	{

	$this->db->select(" ot.order_date,
    order_product.order_id,
    ot.order_number,
   branch_detail.sort_name as branch,
customer_detail.name as customer,
ot.branch_order_number,
    COUNT(order_product.order_product_id) as total");
		$this->db->select(" (
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = order_product.order_id AND c.status = 'CANCEL'
) AS cancel",True);
		$this->db->select("(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = order_product.order_id AND c.status = 'DONE'
) AS done",True);
		$this->db->select("(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = order_product.order_id AND c.status = 'PENDING'
) AS pending",True);
		$this->db->select("(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = order_product.order_id AND c.status = 'OUT'
) AS pglist",True);



		$this->db->from('order_table ot');
		$this->db->join('order_product ', 'ot.order_id = order_product.order_id', 'inner');
		$this->db->join('branch_detail ', 'ot.branch_name=branch_detail.id', 'left');
		$this->db->join('customer_detail ', 'customer_detail.id=ot.customer_name', 'left');
		$this->db->join('data_category ', 'data_category.id=ot.data_category', 'left');
		$this->db->where("data_category.id",$cat);
		$this->db->group_by("ot.order_id");
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
	public function get_order_flow2($order_id,$godown)
	{

		$this->db->select("count(*) AS temp");
		$this->db->from("godown_stock_view");
		$this->db->where('order_id', $order_id);
		$this->db->where('to_godown', $godown);
		$query = $this->db->get();
		$query = $query->row();
		return $query;
	}
		public function get_order_product($order_id)
		{
		
			$this->db->select('*');
			$this->db->from('order_product');
		 $this->db->join('order_table ','order_table.order_id = order_product.order_id','inner');
			$this->db->where('order_product.order_id', $order_id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}

		function edit_order_product_details($action, $id, $table){
		// echo "<pre>";
		// print_r($action);
		// exit;
				$this->db->where('order_product_id', $id);
				$this->db->update($table,$action);
		// print_r($this->db->last_query());exit;
				return true;
		}

		public function get_godown_name(){
			$this->db->select('id, sortname');
			$this->db->from('sub_department');
		$this->db->order_by("priority");
			$query = $this->db->get();
			$query = $query->result();
			return $query;
		}

	public function get_order_by_id2($order_id)
	{
		
		$this->db->select('order_product.*,customer_detail.name as customer,order_table.order_number,sb1.sortname as party,sb2.sortname as godown');
		$this->db->from('order_table');
		$this->db->join('order_product ', 'order_table.order_id = order_product.order_id', 'inner');
		if (isset($order_id['barcode'])) {
			$this->db->where('order_product.order_barcode', $order_id['barcode']);
		} else {
		$this->db->where('order_product.order_product_id', $order_id);
		}
		$this->db->join('customer_detail ', 'customer_detail.id = order_table.customer_name', 'inner');
		$this->db->join('sub_department sb1', 'sb1.id = order_product.godown', 'left');
		$this->db->join('sub_department sb2', 'sb2.id = order_product.to_godown', 'left');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}
	public function getPBC_deatils($id)
	{
		
		$this->db->select('fsr_id,current_stock,fabricName,godownid,from_godown');
		$this->db->from("fabric_stock_view");
		$this->db->where("parent_barcode",$id);

		$rec = $this->db->get();
		// print_r($this->db->last_query());
		// exit;
		return $rec->result_array();
	}
 public function get_design_code()
 {
		
   $this->db->select('distinct(designCode)');
   $this->db->from('design');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
 public function get_unit()
 {
		
   $this->db->select('distinct(unitName)');
   $this->db->from('unit');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
       public function OrdersDelete($id)
					{
						$this->db->where('order_id', $id);
						$this->db->delete('order_product');
					}

				public function OrdersDelete_table($id)
						{
							$this->db->where('order_id', $id);
							$this->db->delete('order_table');

						}

		public function Pending_Orders_Count()
			{
		
				$this->db->where('status', "pending");
				$res=$this->db->get('orders');
				return $res->num_rows();

			}

			function get_order_value(){
		
				$sql = 'SELECT order_table.order_id order_id,order_table.pcs,order_table.branch_order_number, order_table.order_number order_number,branch_detail.sort_name as branch, customer_detail.name customer_name, order_table.status status, order_table.order_date order_date, data_category.dataCategory data_category, session.financial_year financial_year, order_type.orderType  order_type  FROM order_table
								INNER JOIN data_category ON order_table.data_category = data_category.id
								INNER JOIN session ON session.id = order_table.session
								INNER JOIN order_type ON order_type.id = order_table.order_type
								left JOIN customer_detail ON customer_detail.id = order_table.customer_name
								Left JOIN branch_detail ON branch_detail.id = order_table.branch_name
								ORDER BY order_table.order_id desc';
				$query = $this->db->query($sql);
				$query = $query->result_array();
				return $query;
	    }
			function get_order_search_value($data){
		
			$this->db->select('order_table.order_id order_id,order_table.pcs,order_table.branch_order_number, order_table.order_number order_number,branch_detail.sort_name as branch, customer_detail.name customer_name, order_table.status status, order_table.order_date order_date, data_category.dataCategory data_category, session.financial_year financial_year, order_type.orderType  order_type');
	 	  $this->db->from('order_table');
     if(isset($data['branchsearch']))
			{
				$this->db->where('branch_name',$data['branch_name']);
			}
			if(isset($data['cat'])){
	    if(!is_array($data['cat']) ){
	    if($data['cat']!=""){
	      $this->db->like($data['cat'], $data['Value']);
	    }

	  }else{
	    $count =count($data['cat']);
	    for($i=0;$i<$count;$i++){
	      $this->db->like($data['cat'][$i], $data['Value'][$i]);
	    }
	  }
	 }
	 if(isset($data['search'])){
		 $this->db->where('session.financial_year',$data['Value']);
		 $this->db->or_where('order_table.order_number',$data['Value']);
		 $this->db->or_where('order_table.pcs',$data['Value']);
		 $this->db->or_where('order_table.branch_order_number',$data['Value']);
		 $this->db->or_where('customer_detail.sort_name',$data['Value']);
		 $this->db->or_where('order_type.orderType',$data['Value']);
		$this->db->or_where('data_category.dataCategory',$data['Value']);
	 }
	 if($data['from']==$data['to']){
		$this->db->where('order_table.order_date ', $data['from']);
	 }else{
		$this->db->where('order_table.order_date >=', $data['from']);
		$this->db->where('order_table.order_date <=', $data['to']);
	 }
			$this->db->JOIN('data_category','order_table.data_category = data_category.id','INNER');
			$this->db->JOIN('session','session.id = order_table.session','INNER');
			$this->db->JOIN('order_type','order_type.id = order_table.order_type','INNER');
			$this->db->JOIN('customer_detail', 'customer_detail.id = order_table.customer_name','INNER');
			$this->db->JOIN ('branch_detail', 'branch_detail.id = order_table.branch_name','Left');
			$this->db->order_by('order_table.order_id','desc');
			$query = $this->db->get();
		//	echo $this->db->last_query($query);exit;
			$query = $query->result_array();
			return $query;
			}

		function select($table){
		
				$this->db->select('*');
				$this->db->from($table);
				$this->db->join('order_table', 'order_table.order_number = order_table.order_number');
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;

                 }

		function select_order_product($id){
		
				$this->db->select('order_id,order_id,series_number,customer_name,unit,quantity,priority,order_barcode,remark,design_code,fabric_name,hsn,design_name,stitch,dye,matching');
				$this->db->from('order_product');
				$this->db->where('order_id',$id);
				$this->db->order_by('order_id','DESC');
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;
		         }

    	function select_order_type($table){
		
				$this->db->select('*');
				$this->db->from($table);
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;

    }

      public function delete($id)
				{
					  $this->db->where('id', $id);
			     	$this->db->delete('order_tb');
				}



		public function find_data($design_code)
		{
		
			$this->db->select('*');
			$this->db->from('order');
		  $this->db->where('obc',$design_code);

			$rec=$this->db->get();
			return $rec->result_array();
			// print_r($searchValue);
			// print_r($this->db->last_query());
		}

		function get_all_order($obc){
		        $this->db->select('*');
		        $this->db->from('order_tb');
		        $this->db->where('obc', $obc);
		        $query = $this->db->get();
		        $query = $query->row();
		        return $query;
}


     function get_designcode_value($order_id){
		
				$this->db->select('*');
				$this->db->from('order_product');
				$this->db->where('order_id', $order_id);
				$query = $this->db->get();
				$query = $query->result_array();
			// echo $this->db->last_query();exit;
				return $query;
}
       public function insert($data,$table){
			$this->db->insert($table,$data);
			return $this->db->insert_id();
	}

	  function edit_option($action, $id, $table){
        $this->db->where('id',$id);
		return $this->db->update($table,$action);

    }
		function edit_order($action, $id, $table){
				$this->db->where('order_id',$id);
				$this->db->update($table,$action);
				return;
		}
		function edit_by_node($node, $id, $action, $table){
				$this->db->where($node, $id);
		return	$this->db->update($table, $action);

		}

      function get_single_value($id,$table){
		
        $this->db->select('*');
        $this->db->from($table);
				$this->db->join('order_table', 'order_table.order_number = order_table.order_number');
        $this->db->where('order_id',$id);
        $query = $this->db->get();
				//echo $this->db->last_query();exit;
        $query = $query->row();
        return $query;
    }



	function get_order_number($name){
		
			$this->db->select('order_number');
			$this->db->from('order_table');
			$this->db->like('order_number', $name);
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
    }
    // function getLastId(){
		//     			$this->db->select("order_id");
		//     			$this->db->from('order_product');
		//     			$this->db->order_by('order_id','DESC');
		//     			$this->db->limit(1);
		//     			$query = $this->db->get();
		//     			$query = $query->row();
		//     			return $query;
		//     		}
		function getLastId(){
							$this->db->select("order_number,customer_name	");
							$this->db->from('order_table');
							$this->db->order_by('order_id','DESC');
							$this->db->limit(1);
							$query = $this->db->get();
							$query = $query->row();
							return $query;
						}
						function get_prm_data($order_number){
											$this->db->select('');
											$this->db->from('order_product');
										  $this->db->where('order_id',$order_number);
											$query = $this->db->get();
											$query = $query->result_array();
											return $query;
										}



		  function get_order_detail_value($id,$table){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('order_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			$query = $query->result_array();
			return $query;
	}

	public function getOrderDetails($id)
	{
		
		$this->db->select('*');
		$this->db->from('order_product');
		$this->db->where('order_product.order_barcode', $id);

		$this->db->join('order_table ', 'order_table.order_id = order_product.order_id', 'inner');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$query = $query->result_array();
		return $query;
	}
	public function update($id,$data)
	{
		 // print_r($designName);
		 // print_r($data);exit;
		$this->db->where('order_id', $id);
		$this->db->update('order_product', $data);
		return true;
	}

	public function get_order_by_id($order_id)
	 	{
		
	   $this->db->select('*');
	   $this->db->from('order_table');
	   $this->db->join('order_product ','order_table.order_id = order_product.order_id','inner');
	   $this->db->where('order_table.order_number', $order_id);
	   $query = $this->db->get();
	   $query = $query->result_array();
	   return $query;
	 	}

		public function last_id(){
		
		   $this->db->select('max(id) AS last_id');
		   $this->db->from('order_product');
			 $query = $this->db->get();
		   $query = $query->row();
			 return $query->last_id;
		}
  public function get_fabric_by_name($name){
		
      $this->db->select(' id, fabricName AS text');
      $this->db->from('fabric');
      $this->db->where('fabricName LIKE', $name.'%');
      $result = $this->db->get();
      return $result->result();
    }

		public function show_order_flow_chart(){
		
			$this->db->select('*');
			$this->db->from('order_flow_chart');
			$query = $this->db->get();
 	   	$query = $query->result_array();
		 	return $query;
		}
		public function get_count($table) {
		return $this->db->count_all($table);
	 }
}
