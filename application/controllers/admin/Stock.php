<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Stock_model');
        $this->load->model('Transaction_model');
    }

    public function StockCheck($godown)
    {
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $data['id'] = $godown;

        $data['main_content'] = $this->load->view('admin/transaction/check_stock', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    public function recieve_obc()
    {
        $obc = $this->security->xss_clean($_POST['obc']);
        $id = $this->security->xss_clean($_POST['godown']);
        $exist = $this->Stock_model->check_obc($obc, $id);

        if ($exist==0) {


            try {

                $status = $this->Stock_model->check_stock($obc, $id);
                if ($status==1) {
                    $id =    $this->Transaction_model->insert(array('obc' => $obc, 'godown' => $id), 'check_stock');
                    if (!empty($id)) {
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
        } else {
            echo 3;
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

            $query .= 'SELECT * FROM check_stock join godown_stock_view on check_stock.obc=godown_stock_view.order_barcode  WHERE godown_stock_view.stat="recieved" and check_stock.godown = "' . $id . '" ';
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

        
        $i = 0;
        foreach ($result as $value) {
           
            $i += 1;
            $sub_array = array();
            $sub_array[] = "<input type=checkbox class=sub_chk data-id=" . $value['transaction_id'] . ">";
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
            $sub_array[] =   $value['image'];

            $sub_array[] =  $value['stat'];
            $data[] = $sub_array;
        }
        $c=$this->Stock_model->check_stock_qty( $id);
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
        // if ($_POST) {
        // 	//pre($_POST);exit;
        // 	$data['from'] = $this->input->post('date_from');
        // 	$data['to'] = $this->input->post('date_to');
        // 	$data['search'] = $this->input->post('search');
        // 	$data['type'] = $this->input->post('type');
        // 	$caption = 'Search Result For : ';
        // 	if ($_POST['search'] == 'simple') {
        // 		if ($_POST['searchByCat'] != "" || $_POST['searchValue'] != "") {
        // 			$data['cat'] = $this->input->post('searchByCat');
        // 			$data['Value'] = $this->input->post('searchValue');
        // 			$caption = $caption . $data['cat'] . " = " . $data['Value'] . " ";
        // 			$data['caption'] = $caption;
        // 		}
        // 	} else {

        // 		if (isset($_POST['challan_to']) && $_POST['challan_to'] != "") {
        // 			$data['cat'][] = 'challan_to';
        // 			$fab = $this->input->post('challan_to');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Godown' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['fabricName']) && $_POST['fabricName'] != "") {
        // 			$data['cat'][] = 'fabricName';
        // 			$fab = $this->input->post('fabricName');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Fabric Name' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['pbc']) && $_POST['pbc'] != "") {
        // 			$data['cat'][] = 'parent_barcode';
        // 			$fab = $this->input->post('pbc');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'PBC' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['challan']) && $_POST['challan'] != "") {
        // 			$data['cat'][] = 'challan_no';
        // 			$fab = $this->input->post('challan');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Challan No' . " = " . $fab . " ";
        // 		}

        // 		if (isset($_POST['Color']) && $_POST['Color'] != "") {
        // 			$data['cat'][] = 'color_name';
        // 			$fab = $this->input->post('Color');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Color' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['Ad_No']) && $_POST['Ad_No'] != "") {
        // 			$data['cat'][] = 'ad_no';
        // 			$fab = $this->input->post('Ad_No');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Ad_no' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['unit']) && $_POST['unit'] != "") {
        // 			$data['cat'][] = 'stock_unit';
        // 			$fab = $this->input->post('unit');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Unit' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['rate']) && $_POST['rate'] != "") {
        // 			$data['cat'][] = 'purchase_rate';
        // 			$fab = $this->input->post('rate');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Purchase_Rate' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['total']) && $_POST['total'] != "") {
        // 			$data['cat'][] = 'total_value';
        // 			$fab = $this->input->post('total');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Total' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['current_stock']) && $_POST['current_stock'] != "") {
        // 			$data['cat'][] = 'current_stock';
        // 			$fab = $this->input->post('current_stock');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'Curr_qty' . " = " . $fab . " ";
        // 		}
        // 		if (isset($_POST['fabric_type']) && $_POST['fabric_type'] != "") {
        // 			$data['cat'][] = 'fabric_type';
        // 			$fab = $this->input->post('fabric_type');
        // 			$data['Value'][] = $fab;
        // 			$caption = $caption . 'fab_type' . " = " . $fab . " ";
        // 		}

        // 		if (isset($data['cat']) && isset($data['Value'])) {
        // 			//echo"<pre>";	print_r( $data); exit;
        // 			$data['caption'] = $caption;
        // 		} else {
        // 			$this->session->set_flashdata('error', 'please enter some keyword');
        // 			redirect($_SERVER['HTTP_REFERER']);
        // 		}
        // 	}
        // }
        $data['godown'] = $this->Transaction_model->get_godown_by_id($godown);
        $link = ' <a href=' . base_url('admin/transaction/home/') . $godown . '>Home</a>';
        $data['godownid'] = $godown;
        $data['page_name'] = $data['godown'] . '  DASHBOARD /' . $link;
        $plain_godown = $this->Transaction_model->get_distinct_plain_godown();
        $found = 0;
        foreach ($plain_godown as $row) {
            if ($godown == $row['godownid']) {
                $found = 1;
                $data['plain_data'] = $this->Transaction_model->get_plain_stock($data);
                $data['frc_data'] = $this->Transaction_model->get_frc_stock($data);

                //echo "<pre>";print_r($data['godown_data']);exit;
                $data['main_content'] = $this->load->view('admin/transaction/stock_plain', $data, TRUE);
            }
        }
        if ($found == 0) {
            if ($godown == 23) {
                $data['frc_data'] = $this->Transaction_model->get_stock($godown, 'all');
            } else {

                $data['frc_data'] = $this->Transaction_model->get_stock($godown, 'challan');
            }

            $data['main_content'] = $this->load->view('admin/transaction/stock', $data, TRUE);
        }


        $this->load->view('admin/index', $data);
    }
}
