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
	public function getId($type)
	{
		$this->db->select('Max(counter) as count');
		$this->db->from("order_table");
		$this->db->where('data_category', $type);
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
 public function get_order_cancel()
 {

   $this->db->select('*');
   $this->db->from('order_cancel_cause');
	$this->db->join('order_product ','order_cancel_cause.order_id = order_product.order_id','inner');
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
                            WHERE (status = "INPROCESS")
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
	public function get_order_by_id2($order_id)
	{

		$this->db->select('order_product.*,customer_detail.name as customer,order_table.order_number');
		$this->db->from('order_table');
		$this->db->join('order_product ', 'order_table.order_id = order_product.order_id', 'inner');
		$this->db->where('order_product.order_product_id', $order_id);
		$this->db->join('customer_detail ', 'customer_detail.id = order_table.customer_name', 'inner');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}
	public function getPBC_deatils($id)
	{
		$this->db->select('fsr_id,current_stock,fabricName,godownid');
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
				$sql = 'SELECT order_table.order_id order_id,order_table.pcs, order_table.order_number order_number, customer_detail.name customer_name, order_table.status status, order_table.order_date order_date, data_category.dataCategory data_category, session.financial_year financial_year, order_type.orderType  order_type  FROM order_table
								INNER JOIN data_category ON order_table.data_category = data_category.id
								INNER JOIN session ON session.id = order_table.session
								INNER JOIN order_type ON order_type.id = order_type.id
								INNER JOIN customer_detail ON customer_detail.id = order_table.customer_name
								GROUP BY order_table.order_number';
				$query = $this->db->query($sql);
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
		
		$this->db->where('order_product.status !=', 'OUT');
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
}
