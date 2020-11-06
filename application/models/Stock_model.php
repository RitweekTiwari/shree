 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Stock_model extends CI_Model
    {
        
        function check_stock($obc, $godown)
        {
            $this->db->select();
            $this->db->from("godown_stock_view");
            $this->db->where("to_godown", $godown);
            $this->db->where("order_barcode", $obc);
            $this->db->where("stat", 'recieved');
            $query = $this->db->get();
            
            if($query->num_rows()==1)
            return $query->row()->trans_meta_id;
            else
            return 0;
        }
        function check_obc($obc, $godown)
        {
            $this->db->select("*");
            $this->db->from("godown_check");
            $this->db->where("to_godown", $godown);
            $this->db->where("order_barcode", $obc);
            $query = $this->db->get();
            // pre($this->db->last_query());
            // exit;
            if ($query->num_rows() == 1)
            return $query->row()->trans_meta_id;
            else
                return 0;
        }
        function check_pbc($obc, $godown)
        {
            $this->db->select("*");
            $this->db->from("dye_stock_check");
            $this->db->where("to_godown", $godown);
            $this->db->where("order_barcode", $obc);
            $query = $this->db->get();
           // pre($this->db->last_query());exit;
            if ($query->num_rows() == 1)
            return $query->row()->trans_meta_id;
            else
                return 0;
        }
        function check_stock_qty( $godown)
        {
            $this->db->select('*');
            $this->db->from("godown_stock_view");
            $this->db->where("to_godown", $godown);
            $this->db->where("stat", 'recieved');
            $query = $this->db->get();

                return $query->num_rows();
           
        }

        
        function get_stock_by_id($godown,$type)
        {
            $this->db->select('*');
            if($type=="challan"){
                $this->db->from("godown_check");

            }else{
                $this->db->from("dye_stock_check");
            }
            $this->db->where("to_godown", $godown);
            $query = $this->db->get();

            return $query->result_array();
        }
        function get_stock_history($godown)
        {
            $this->db->select('*');
            $this->db->from("stock_history_main");
            $this->db->where("godown", $godown);
            $query = $this->db->get();

            return $query->result_array();
        }
        
        function get_stock_history_id($id)
        {
            $this->db->select('stock_history.*,stock_history_main.godown,stock_history_main.date,order_view.godown as from_godown,order_view.to_godown');
            $this->db->from("stock_history");
            $this->db->where("stock_id", $id);
            $this->db->join("stock_history_main", "stock_history_main.id=stock_history.stock_id");
            $this->db->join("order_view", "order_view.order_barcode=stock_history.order_barcode");
            $this->db->order_by( "fabric_name", "to_godown", "from_godown");
            $query = $this->db->get();
           
            return $query->result_array();
        }
        function get_stock_summary($id)
        {
            $this->db->select(' `from_godown`, `to_godown`, `fabric_name`,fabric.fabricType,COUNT(fabric.fabricType)');
            $this->db->from("stock_history");
            $this->db->where("stock_id", $id);
            $this->db->join("fabric ", "fabric.fabricName=stock_history.fabric_name");
           
            $this->db->group_by("from_godown, to_godown, fabric.fabricType, stock_history.fabric_name");
            $query = $this->db->get();
        //    pre($this->db->last_query()) ;
        //     exit;
            return $query->result_array();
        }
         
    }

    /* End of file Branch_model.php */
    /* Location: ./application/models/Branch_model.php */
    ?>
