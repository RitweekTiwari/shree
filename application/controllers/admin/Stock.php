<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Stock_model');
        $this->load->model('common_model');
        $this->load->model('Transaction_model');
    }

    public function StockCheck($godown)
    {
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $data['id'] = $godown;

        $data['main_content'] = $this->load->view('admin/transaction/check_stock/check_stock', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function stock_check_dye($godown)
    {
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $data['id'] = $godown;

        $data['main_content'] = $this->load->view('admin/transaction/check_stock/check_stock_dye', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
    public function stock_list($godown)
    {
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $data['id'] = $godown;
        $data['stock'] = $this->Stock_model->get_stock_history($godown);
        $data['main_content'] = $this->load->view('admin/transaction/check_stock/list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function view_stock_list($id)
    {
        $data['stock'] = $this->Stock_model->get_stock_history_id($id);
        //pre($data['stock']);exit;
        $data['godown'] = $this->Transaction_model->get_godown_by_id($data['stock'][0]['godown']);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $data['stock'][0]['godown']. '>Home</a>';
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $data['id'] = $data['stock'][0]['godown'];
       
        $data['main_content'] = $this->load->view('admin/transaction/check_stock/stock_list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function recieve_obc()
    {
        $obc = $this->security->xss_clean($_POST['obc']);
        $id = $this->security->xss_clean($_POST['godown']);
       try {

                $status = $this->Stock_model->check_obc($obc, $id);
                if ($status!=0) {
                    $data['check_stock'] = 1;
                    $st =    $this->Transaction_model->update($data, 'trans_meta_id', $status, "transaction_meta");
                    if (!empty($st)) {
                        echo 1;
                    } else {
                        echo 2;
                    }
                } else {
                    echo 0;
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
       
    }
    
    public function save_stock()
    {
        $print = $this->security->xss_clean($_POST['print']);
        $godown = $this->security->xss_clean($_POST['godown']);
        $data['stock'] = $this->Stock_model->get_stock_by_id($godown);
        //pre($data['stock']);exit;
        $data1=array();
        $data1['godown']= $godown;
        $data1['date']= date("y-m-d");
        $data1['created']= current_datetime();

        $id =    $this->common_model->insert($data1, 'stock_history_main');
         foreach($data['stock'] as $row){
            $data1 = array();
            $data1['stock_id'] =  $id;
            $data1['order_number'] = $row['order_number'];
            $data1['unit'] = $row['unit'];
            $data1['fabric_name'] = $row['fabric_name'];
            $data1['order_barcode'] = $row['order_barcode'];
            $data1['design_name'] = $row['design_name'];
            $data1['dye'] = $row['dye'];
            $data1['pbc'] = $row['pbc'];
            $data1['finish_qty'] = $row['finish_qty'];
            $data1['matching'] = $row['matching'];
            $this->common_model->insert($data1, 'stock_history');
         }
        $data['stock'] = $this->Stock_model->get_stock_by_id($godown);
         if($print==1){
            $data['main_content'] = $this->load->view('admin/transaction/check_stock/check_stock_index', $data, TRUE);
            $this->load->view('admin/print/index', $data);
         }else{
             echo 0;
         }

        
    }
    public function getBill($id)
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

            $query .= 'SELECT * FROM godown_check  WHERE  to_godown = "' . $id . '" ';
        }

        if (!empty($_GET["order"])) {
            $query .= ' ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY order_barcode ASC ';
        }

        if ($_GET["length"] != -1) {
            $query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
        }

        $sql = $this->db->query($query);
        $result = $sql->result_array();
        $filtered_rows = $sql->num_rows();


        $c = 1;
        $i = 1;
        foreach ($result as $value) {
            if ($value['stat'] == 1) {
                $c += 1;
            }
            $i += 1;
            $sub_array = array();
            
            $sub_array[] = $value['pbc'];
            $sub_array[] = $value['order_barcode'];
            $sub_array[] = $value['order_number'];
            $sub_array[] = $value['fabric_name'];
            $sub_array[] = $value['hsn'];
            $sub_array[] = $value['design_name'];
            $sub_array[] = $value['design_code'];
            $sub_array[] = $value['dye'];
            $sub_array[] = $value['matching'];
            $sub_array[] = $value['quantity'];
            $sub_array[] =  $value['rate'];
            $sub_array[] =   $value['rate'] * $value['quantity'];
            $sub_array[] =  $value['unit'];

            $sub_array[] =  $value['stat'];
            $data[] = $sub_array;
        }
       
        // pre($c. " ".$i);exit;
        if ($c == $i) {
            $recieved = true;
        } else {
            $recieved = false;
        }
        $output = array(
            "recieved" => $recieved,
            "draw" => intval($_GET["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $filtered_rows,
            "data" => $data
        );

        echo json_encode($output);
    }
    public function getDye($id)
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

            $query .= 'SELECT * FROM dye_stock_check  WHERE  to_godown = "' . $id . '" ';
        }

        if (!empty($_GET["order"])) {
            $query .= ' ORDER BY ' . $_GET['order']['0']['column'] . ' ' . $_GET['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY order_barcode ASC ';
        }

        if ($_GET["length"] != -1) {
            $query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
        }

        $sql = $this->db->query($query);
        $result = $sql->result_array();
        $filtered_rows = $sql->num_rows();


        $c = 1;
        $i = 1;
        foreach ($result as $value) {
            if ($value['stat'] == 1) {
                $c += 1;
            }
            $i += 1;
            $sub_array = array();

            $sub_array[] = $value['order_barcode'];
          
            $sub_array[] = $value['fabricName'];
            $sub_array[] = $value['hsn'];
        
            $sub_array[] = $value['color'];
            $sub_array[] = $value['current_stock'];
           
            $sub_array[] =  $value['stock_unit'];

            $sub_array[] =  $value['stat'];
            $data[] = $sub_array;
        }

        // pre($c. " ".$i);exit;
        if ($c == $i) {
            $recieved = true;
        } else {
            $recieved = false;
        }
        $output = array(
            "recieved" => $recieved,
            "draw" => intval($_GET["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $filtered_rows,
            "data" => $data
        );

        echo json_encode($output);
    }
    public function showStock($godown)
    {
        
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['godownid'] = $godown;
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $plain_godown = $this->Transaction_model->get_distinct_plain_godown();
        // echo "<pre>";
        // print_r($plain_godown);
        // exit;
        $found = 0;
        foreach ($plain_godown as $row) {
            if ($godown == $row['godownid']) {
                $found = 1;
                $data['plain_data'] = $this->Transaction_model->get_plain_stock($data);
                $data['frc_data'] = $this->Transaction_model->get_frc_stock($data);

                $data['dye_data'] = $this->Transaction_model->get_dye_stock($data);
               // pre($data['dye_data']);exit;
                $data['main_content'] = $this->load->view('admin/transaction/stock_plain', $data, TRUE);
            }
        }
        if ($found == 0) {
            if ($godown == 23) {
                $data['frc_data'] = $this->Transaction_model->get_stock($godown, 'all');
            } else {

                $data['frc_data'] = $this->Transaction_model->get_stock($godown, 'challan');
            }
            //echo "<pre>";print_r($data['frc_data']);exit;
            $data['main_content'] = $this->load->view('admin/transaction/stock', $data, TRUE);
        }


        $this->load->view('admin/index', $data);
    }
}
