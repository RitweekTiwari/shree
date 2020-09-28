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
            return 1;
            else
            return 0;
        }
        function check_obc($obc, $godown)
        {
            $this->db->select();
            $this->db->from("check_stock");
            $this->db->where("godown", $godown);
            $this->db->where("obc", $obc);
            $query = $this->db->get();
           
            if ($query->num_rows() == 1)
            return 1;
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
    }

    /* End of file Branch_model.php */
    /* Location: ./application/models/Branch_model.php */
    ?>
