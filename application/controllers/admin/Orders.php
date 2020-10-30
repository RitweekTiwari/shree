<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    check_login_user();
    $this->load->model('common_model');
    $this->load->model('login_model');
    $this->load->model('Orders_model');
    // $this->load->model('Frc_model');
    $this->load->library('pdf');
    $this->load->library('barcode');
  }
  public function index()
  {
    $data = array();
    $data['page_name'] = 'ORDER / ' . '<a href=' . base_url('admin/Orders/dashboard') . '>Home</a>';
  //  $data['all_Order_list'] = $this->Orders_model->select('order_product');
    $data['data_cat'] = $this->common_model->select('data_category');
    $data['branch_name'] = $this->common_model->select(' branch_detail');
    // $data['all_Order'] = $this->Orders_model->get_order_value();
    $data['main_content'] = $this->load->view('admin/order/order', $data, TRUE);
    $this->load->view('admin/index', $data);
  }

  public function get_order_list()
  {
    $output = array();
    $data = array();
    $record = array();

    $caption = '';
    if ($_POST) {
      if (!empty($_POST["search"]["value"])) {
        //pre($_POST["search"]["value"]);exit;
        $data['Value'] = $_POST["search"]["value"];
        $data['search'] = 'search';

        $data['to'] = date('Y-m-d');
        $data['from'] = date('Y-04-01');

        $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
      } elseif (!empty($_POST["filter"])) {
        // pre($_POST["filter"]);exit;

        if ($_POST['filter']['search'] == 'simple') {
          if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
            $data['cat'] = $_POST['filter']['searchByCat'];
            $data['Value'] = $_POST['filter']['searchValue'];

            $data['to'] = $_POST['filter']['to'];
            $data['from'] = $_POST['filter']['from'];

            $caption = $caption . $_POST['filter']['searchByCat'] . " = " . $_POST['filter']['searchValue'] . " ";
          }
          $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
        } elseif ($_POST['filter']['search'] == 'advance') {
          if (isset($_POST['filter']['financial_year']) && $_POST['filter']['financial_year'] != "") {
            $data['cat'][] = 'session.financial_year';
            $fab = $_POST['filter']['financial_year'];
            $data['Value'][] = $fab;
            $caption = $caption . 'financial_year' . " = " . $fab . " ";
          }

          if (isset($_POST['filter']['order_number']) && $_POST['filter']['order_number'] != "") {
            $data['cat'][] = 'order_table.order_number';
            $fab = $_POST['filter']['order_number'];
            $data['Value'][] = $fab;
            $caption = $caption . 'order_number' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['pcs']) && $_POST['filter']['pcs'] != "") {
            $data['cat'][] = 'order_table.pcs';
            $fab = $_POST['filter']['pcs'];
            $data['Value'][] = $fab;
            $caption = $caption . 'pcs' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['branch_order_number']) && $_POST['filter']['branch_order_number'] != "") {
            $data['cat'][] = 'order_table.branch_order_number';
            $fab = $_POST['filter']['branch_order_number'];
            $data['Value'][] = $fab;
            $caption = $caption . 'branch_order_number' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['name']) && $_POST['filter']['name'] != "") {
            $data['cat'][] = 'customer_detail.name';
            $fab = $_POST['filter']['name'];
            $data['Value'][] = $fab;
            $caption = $caption . 'name' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['orderType']) && $_POST['filter']['orderType'] != "") {
            $data['cat'][] = 'order_type.orderType';
            $doc_challan = $_POST['filter']['orderType'];
            $data['Value'][] = $doc_challan;
            $caption = $caption . 'orderType' . " = " . $doc_challan . " ";
          }
          if (isset($_POST['filter']['dataCategory']) && $_POST['filter']['dataCategory'] != "") {
            $data['cat'][] = 'data_category.dataCategory';
            $doc_challan = $_POST['filter']['dataCategory'];
            $data['Value'][] = $doc_challan;
            $caption = $caption . 'dataCategory' . " = " . $doc_challan . " ";
          }
          if (isset($data['cat']) && isset($data['Value'])) {

            $data['to'] = $_POST['filter']['to'];
            $data['from'] = $_POST['filter']['from'];

            $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
          } else {
            $this->session->set_flashdata('error', 'please enter some keyword');
            redirect($_SERVER['HTTP_REFERER']);
          }
        } elseif ($_POST['filter']['search'] == 'datefilter') {

          $data['to'] = $_POST['filter']['to'];
          $data['from'] = $_POST['filter']['from'];
          $data['Dsearch'] = $_POST['filter']['search'];
          $caption = "Order List";
          $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
        } elseif ($_POST['filter']['search'] == 'searchBranch') {
          $data['branch_name'] = $_POST['filter']['branch_name'];
          $data['branchsearch'] = $_POST['filter']['search'];
          $data['to'] = date('Y-m-d');
          $data['from'] = date('Y-04-01');
          $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
        }
      } else {
        $data['all_Order'] = $this->Orders_model->get_order_value();
      }

      foreach ($data['all_Order'] as $value) {
        $sub_array = array();
        $sub_array[] = '<input type="checkbox" class="sub_chk" data-id=' . $value['order_id'] . '>';
        $sub_array[] = $value['financial_year'];
        $sub_array[] = $value['order_date'];
        $sub_array[] = $value['order_number'];
        $sub_array[] = $value['pcs'];
        $sub_array[] = $value['branch'];
        $sub_array[] = $value['branch_order_number'];
        $sub_array[] = $value['customer_name'];
        $sub_array[] = $value['order_type'];
        $sub_array[] = $value['data_category'];

        $sub_array[] =  '
                    <a class="text-center tip"  href="' . base_url("admin/orders/get_details/") . $value['order_id'] . ' ">
                      <i class="fa fa-eye" aria-hidden="true"></i></a>';
        $sub_array[] =  '<a class="text-danger text-center tip"  href="' . base_url('admin/Orders/edit_order_product_details/') . $value['order_id'] . '" >
                                      <i class="mdi mdi-pen blue"></i>
                                    </a>
                                  ';
        $record[] = $sub_array;
      }

      $output = array(

        "recordsTotal" => $this->Orders_model->get_count("order_table"),
        "recordsFiltered" =>  $this->Orders_model->get_count("order_table"),

        "draw"   =>  intval($_POST["draw"]),
        "data" => $record
      );

      echo json_encode($output);
    }
  }
  public function get_order_chart()
  {
    $output = array();
    $flow = array();
    $record = array();
    $chart = array();
    $data = array();
    $caption = '';
    if ($_POST) {
      if (!empty($_POST["search"]["value"])) {
        //pre($_POST["search"]["value"]);exit;
        $data['Value'] = $_POST["search"]["value"];
        $data['search'] = 'search';

        $data['to'] = date('Y-m-d');
        $data['from'] = date('Y-04-01');

        $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
      } elseif (!empty($_POST["filter"])) {
        // pre($_POST["filter"]);exit;

        if ($_POST['filter']['search'] == 'simple') {
          if ($_POST['filter']['searchByCat'] != "" || $_POST['filter']['searchValue'] != "") {
            $data['cat'] = $_POST['filter']['searchByCat'];
            $data['Value'] = $_POST['filter']['searchValue'];

            $data['to'] = $_POST['filter']['to'];
            $data['from'] = $_POST['filter']['from'];

            $caption = $caption . $_POST['filter']['searchByCat'] . " = " . $_POST['filter']['searchValue'] . " ";
          }
          $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
        } elseif ($_POST['filter']['search'] == 'advance') {
          if (isset($_POST['filter']['financial_year']) && $_POST['filter']['financial_year'] != "") {
            $data['cat'][] = 'session.financial_year';
            $fab = $_POST['filter']['financial_year'];
            $data['Value'][] = $fab;
            $caption = $caption . 'financial_year' . " = " . $fab . " ";
          }

          if (isset($_POST['filter']['order_number']) && $_POST['filter']['order_number'] != "") {
            $data['cat'][] = 'order_table.order_number';
            $fab = $_POST['filter']['order_number'];
            $data['Value'][] = $fab;
            $caption = $caption . 'order_number' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['pcs']) && $_POST['filter']['pcs'] != "") {
            $data['cat'][] = 'order_table.pcs';
            $fab = $_POST['filter']['pcs'];
            $data['Value'][] = $fab;
            $caption = $caption . 'pcs' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['branch_order_number']) && $_POST['filter']['branch_order_number'] != "") {
            $data['cat'][] = 'order_table.branch_order_number';
            $fab = $_POST['filter']['branch_order_number'];
            $data['Value'][] = $fab;
            $caption = $caption . 'branch_order_number' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['name']) && $_POST['filter']['name'] != "") {
            $data['cat'][] = 'customer_detail.name';
            $fab = $_POST['filter']['name'];
            $data['Value'][] = $fab;
            $caption = $caption . 'name' . " = " . $fab . " ";
          }
          if (isset($_POST['filter']['orderType']) && $_POST['filter']['orderType'] != "") {
            $data['cat'][] = 'order_type.orderType';
            $doc_challan = $_POST['filter']['orderType'];
            $data['Value'][] = $doc_challan;
            $caption = $caption . 'orderType' . " = " . $doc_challan . " ";
          }
          if (isset($_POST['filter']['dataCategory']) && $_POST['filter']['dataCategory'] != "") {
            $data['cat'][] = 'data_category.dataCategory';
            $doc_challan = $_POST['filter']['dataCategory'];
            $data['Value'][] = $doc_challan;
            $caption = $caption . 'dataCategory' . " = " . $doc_challan . " ";
          }
          if (isset($data['cat']) && isset($data['Value'])) {

            $data['to'] = $_POST['filter']['to'];
            $data['from'] = $_POST['filter']['from'];

            $data['all_Order'] = $this->Orders_model->get_order_search_value($data);
          } else {
            $this->session->set_flashdata('error', 'please enter some keyword');
            redirect($_SERVER['HTTP_REFERER']);
          }
        } elseif ($_POST['filter']['search'] == 'datefilter') {

          $data['to'] = $_POST['filter']['to'];
          $data['from'] = $_POST['filter']['from'];
          $data['Dsearch'] = $_POST['filter']['search'];
          $caption = "Order List";
          $flow = $this->Orders_model->get_order_flow($data);
          $data['godownlist'] = self::godown_chart();


          foreach ($flow as $key => $result) {
            $chart[$key] = $result;
            foreach ($data['godownlist'] as $temp => $value) {
              $flage = self::godown_count($result['order_id'], $temp);
              if ($flage) {
                $chart[$key][$temp] = $flage;
              } else {
                $chart[$key][$temp] = "";
              }
            }
          }
        } elseif ($_POST['filter']['search'] == 'searchDataCat') {
          $flow = $this->Orders_model->get_order_flow($_POST['filter']['branch_name']);
          $data['godownlist'] = self::godown_chart();


          foreach ($flow as $key => $result) {
            $chart[$key] = $result;
            foreach ($data['godownlist'] as $temp => $value) {
              $flage = self::godown_count($result['order_id'], $temp);
              if ($flage) {
                $chart[$key][$temp] = $flage;
              } else {
                $chart[$key][$temp] = "";
              }
            }
          }
          
         
        }
      } else {
        $flow = $this->Orders_model->get_order_flow(4);
        // $godwon = $this->Orders_model->get_order_flow2();
        $data['godownlist'] = self::godown_chart();


        foreach ($flow as $key => $result) {
          $chart[$key] = $result;
          foreach ($data['godownlist'] as $temp => $value) {
            $flage = self::godown_count($result['order_id'], $temp);
            if ($flage) {
              $chart[$key][$temp] = $flage;
            } else {
              $chart[$key][$temp] = "";
            }
          }
        }
        
       
      }
     
//pre($data['chart']);exit;
      foreach ($chart as $value) {
        $sub_array = array();
        $sub_array[] = $value['order_date'];
        $sub_array[] = $value['order_number'];
        $sub_array[] = $value['branch'];
        $sub_array[] = $value['branch_order_number'];
        $sub_array[] = $value['customer'];
        
        $sub_array[] = $value['total'];
        $sub_array[] = $value['pglist'];
        $sub_array[] = $value['pending'];
        $sub_array[] = $value['cancel'];
        $sub_array[] = $value['done'];
        $sub_array[] = $value['8'];
        $sub_array[] = $value['9'];
        $sub_array[] = $value['10'];
        $sub_array[] = $value['11'];
        $sub_array[] = $value['12'];
        $sub_array[] = $value['13'];
        $sub_array[] = $value['14'];
        $sub_array[] = $value['15'];
        $sub_array[] = $value['16'];
        $sub_array[] = $value['17'];
        $sub_array[] = $value['18'];
        $sub_array[] = $value['19'];
        $sub_array[] = $value['20'];
        $sub_array[] = $value['21'];
        $sub_array[] = $value['22'];
        $sub_array[] = $value['23'];
        $sub_array[] = $value['24'];
        
        $record[] = $sub_array;
      }

      $output = array(

        "recordsTotal" => count($record),
        "recordsFiltered" =>  count($record),

        "draw"   =>  intval($_POST["draw"]),
        "data" => $record
      );

      echo json_encode($output);
    }
  }
  public function dashboard()
  {
    $data = array();
    $data['page_name'] = 'ORDER DASHBORD';
    $data['cause'] = $this->common_model->select('cause_list');
    $data['order_count'] = $this->Orders_model->get_order_count();
    $data['get_complete'] = $this->Orders_model->get_order_complete();

    $data['get_cancel'] = $this->Orders_model->get_order_cancel();
    $data['get_pending'] = $this->Orders_model->get_order_pending();
    $data['main_content'] = $this->load->view('admin/order/dashboard', $data, TRUE);
    $this->load->view('admin/index', $data);
  }

  public function order_flow()
  {
    $data = array();
    // $chart = array();
    $data['page_name'] = 'ORDER FLOW CHART';
    //$flow = $this->Orders_model->get_order_flow();
    // $godwon = $this->Orders_model->get_order_flow2();

    $data['godownlist'] = self::godown_chart();


    // foreach ($flow as $key => $result) {
    //   $chart[$key] = $result;
    //   foreach ($data['godownlist'] as $temp => $value) {
    //     $flage = self::godown_count($result['order_id'], $temp);
    //     if ($flage) {
    //       $chart[$key][$temp] = $flage;
    //     } else {
    //       $chart[$key][$temp] = 0;
    //     }
    //   }
    // }
    // $data['chart'] = $chart;

    // pre($chart);exit;
    $data['main_content'] = $this->load->view('admin/order/order_flow_chart', $data, TRUE);
    $this->load->view('admin/index', $data);
  }


  public function godown_chart()
  {
    $godown = $this->Orders_model->get_godown_name();
    $temp = array();
    foreach ($godown as $value) {
      $temp[$value->id] =  $value->sortname;
    }
    return $temp;
  }

  public function godown_count($id, $godown)
  {
    $godwon = $this->Orders_model->get_order_flow2($id, $godown);
    return $godwon->temp;
  }

  public function add_new_order()
  {
    if ($_POST) {
      $id = $this->Orders_model->getId($_POST['category'], $_POST['branch_name']);
      if (!$id) {
        if ($_POST['category'] == 3) {
          $orderno = "ORD1";
        } else {
          $orderno = "STK1";
        }

        $cc = 1;
      } else {
        $cc = $id[0]['count'];
        $cc = $cc + 1;
        if ($_POST['category'] == 3) {
          $orderno = "ORD" . (string) $cc;
        } else {
          $orderno = "STK" . (string) $cc;
        }
      }
      $count = 0;
      for ($i = 0; $i < count($_POST['serial_number']); $i++) {
        for ($j = 0; $j < $_POST['pcs'][$i]; $j++) {
          $count = $count + 1;
        }
      }

      $data = array(
        'branch_order_number' => $_POST['branch_order_number'],
        'branch_name' => $_POST['branch_name'],
        'order_number' => $orderno,
        'customer_name' => $_POST['customer_name'],
        'session' => $_POST['session'],
        'data_category' => $_POST['category'],
        'order_type' => $_POST['order_type'],
        'order_date' => date('Y-m-d'),
        'counter' => $cc,
        'pcs' => count($_POST['fabric_name'])
      );
      $order_number =  $this->Orders_model->insert($data, 'order_table');
      if ($order_number) {
        $counter = $this->Orders_model->getCount();
        $cc = $counter[0]['count'];
        for ($i = 0; $i < count($_POST['serial_number']); $i++) {
          for ($j = 0; $j < $_POST['pcs'][$i]; $j++) {
            $cc = $cc + 1;

            $pbc = "O" . (string) $cc;
            if ($_POST['design_name'][$i] != "") {


              $data = array(

                'order_id' => $order_number,
                'series_number' => $_POST['serial_number'][$i],
                'counter' => $cc,
                'unit' => $_POST['unit'][$i],
                'quantity' => $_POST['quantity'][$i],
                'priority' => $_POST['priority'][$i],
                'order_barcode' => $pbc,
                'design_barcode' => $_POST['design_barcode'][$i],
                'design_name' => $_POST['design_name'][$i],
                'design_code' => $_POST['design_code'][$i],
                'remark' => $_POST['remark'][$i],
                'fabric_name' => $_POST['fabric_name'][$i],
                'hsn' => $_POST['hsn'][$i],
                'stitch' => $_POST['stitch'][$i],
                'dye' => $_POST['dye'][$i],
                'matching' => $_POST['matching'][$i],
                'order_status' => $_POST['status'][$i]
              );
              $this->Orders_model->insert($data, 'order_product');
            }
          }
        }
        $txt = 'order save <a href="' . base_url('admin/Orders') . '"> show order </a>';
        $this->session->set_flashdata(array('error' => 0, 'msg' => $txt));
        redirect(base_url('admin/Orders/addOrders'));
      } else {
        $this->session->set_flashdata(array('error' => 1, 'msg' => 'order data not save try again'));
        redirect(base_url('admin/Orders/addOrders'));
      }
    }
  }
  public function customerName()
  {
    if ($_POST) {
      $data['name'] = $this->Orders_model->get_customer($_POST['id']);
      $type = $_POST['category'];
      $id = $this->Orders_model->getId($type, $_POST['id']);
      if (!$id) {
        if ($type == 3) {
          $data['orderno'] = "ORD1";
        } else {
          $data['orderno'] = "STK1";
        }

        $cc = 1;
      } else {
        $cc = $id[0]['count'];
        $cc = $cc + 1;
        if ($type == 3) {
          $data['orderno'] = "ORD" . (string) $cc;
        } else {
          $data['orderno'] = "STK" . (string) $cc;
        }
      }
      $counter = $this->Orders_model->getCount();
      $data['count'] = $counter[0]['count'];
      echo json_encode($data);
    }
  }
  public function addOrders()
  {
    $data = array();
    $data['page_name'] = 'Add Orders / ' . '<a href=' . base_url('admin/Orders/dashboard') . '>Home</a>';
    $data['febName'] = $this->common_model->febric_name();
    $data['designname'] = $this->Orders_model->get_design_name();
    $data['designCode'] = $this->Orders_model->get_design_code();
    $data['unit'] = $this->Orders_model->get_unit();
    $data['branch_name'] = $this->Orders_model->get_branch();

    $data['all_Order'] = $this->Orders_model->select_order_type('order_type');
    $data['data_cat'] = $this->common_model->select('data_category');
    $data['customer'] = $this->common_model->select('customer_detail');
    $data['all_session'] = $this->Orders_model->select_order_type('session');
    $data['main_content'] = $this->load->view('admin/order/addOrder', $data, TRUE);
    $this->load->view('admin/index', $data);
  }
  public function getOrder_id($type)
  {
    $type = sanitize_url($type);
  }

  public function getOrderDetails()
  {
    $id = $this->security->xss_clean($_POST['id']);

    $data = array();
    $data['order'] = $this->Orders_model->getOrderDetails($id);

    if ($data['order']) {
      if (isset($_POST['godown'])) {
        $godown = $this->security->xss_clean($_POST['godown']);
        if ($data['order'][0]['godown'] == $godown) {
          echo json_encode($data);
        } else {
          echo json_encode(2);
        }
      } else {
        echo json_encode($data['order']);
      }
    } else {
      echo json_encode(0);
    }
  }

  public function getFabricDetails()
  {
    $id = $this->security->xss_clean($_POST['id']);
    $data = array();
    $data['order'] = $this->Orders_model->getFabricDetails($id);
    echo json_encode($data['order']);
  }
  public function getFabricDesign()
  {
    $id = $this->security->xss_clean($_POST['id']);
    $data = array();
    $data['febName'] = $this->Orders_model->getFabricDetails($id);
    $data['design'] = $this->Orders_model->getFabricDesign($id);
    echo json_encode($data);
  }
  public function getFabricName()
  {
    if ($_POST) {
      $fabric = $this->security->xss_clean($_POST);
      $data['febName'] = $this->Orders_model->get_fabric_by_name($fabric['search']);
      echo json_encode($data['febName']);
    }
  }
  public function getDesignDetails()
  {
    $id = $this->security->xss_clean($_POST['id']);
    $data = array();
    $data['design'] = $this->Orders_model->getDesignDetails($id);
    echo json_encode($data['design']);
  }
  public function getDesign()
  {
    $id = $this->security->xss_clean($_POST['id']);
    $data = array();
    $data['design'] = $this->Orders_model->getDesign($id);
    echo json_encode($data['design']);
  }
  public function CheckOrder()
  {
    $order = $this->security->xss_clean($_POST['order']);
    $query = $this->Orders_model->checkorder($order);
    if ($query) {
      echo "taken";
    } else {
      echo "not_taken";
    }
  }





  // Dashbord Actions

  public function update_status($status, $order_id)
  {

    if (self::check_order($order_id)) {
      try {
        $data = [
          'status' => $status
        ];
        $this->Orders_model->edit_by_node('order_id', $order_id, $data, 'order_product');
        $this->session->set_flashdata(array('error' => 0, 'msg' => 'ORDER FOUND'));
        redirect($_SERVER['HTTP_REFERER']);
      } catch (\Exception $e) {
        $error = $e->getMessage();
        $this->session->set_flashdata(array('error' => 1, 'msg' => $error));
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->session->set_flashdata(array('error' => 1, 'msg' => 'ORDER NOT FOUND'));
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function check_order($order_id)
  {
    return $this->Orders_model->get_order_product_by_id($order_id);
  }

  public function get_details($order_id)
  {
    $order_id = sanitize_url($order_id);
    $data = array();
    $data['page_name'] = 'Order List / ' . '<a href=' . base_url('admin/Orders/dashboard') . '>Home</a>';
    $data['order_data'] = $this->Orders_model->get_order($order_id);
    $data['main_content'] = $this->load->view('admin/order/show_order', $data, TRUE);
    $this->load->view('admin/index', $data);
  }
  public function return_print_multiple()
  {
    if (isset($_POST['ids'])) {
      $ids =  $this->security->xss_clean($_POST['ids']);
      //print_r($_POST['ids']);exit;
      foreach ($ids as $value) {
        if ($value != "") {
          $data['data'][] = $this->Orders_model->get_order_by_id2($value);
        }
      }
    }
    if (isset($_POST['barcode'])) {
      $data['barcode'] =  $this->security->xss_clean($_POST['barcode']);
      $data['data'][] = $this->Orders_model->get_order_by_id2($data);
    }
    //echo '<pre>';	print_r($data['data']);exit;
    if ($data['data'][0] != '') {
      $data['main_content'] = $this->load->view('admin/order/receive_print', $data, TRUE);
    } else {
      $data['main_content'] = 'No Result Found';
    }

    $this->load->view('admin/print/index', $data);
  }

  public function edit_order_product_details($order_id)
  {
    $order_id = sanitize_url($order_id);
    $data = array();
    $data['febName'] = $this->common_model->febric_name();
    $data['page_name'] = 'Edit Order List / ' . '<a href=' . base_url('admin/Orders/dashboard') . '>Home</a>';
    $data['order_data'] = $this->Orders_model->get_order($order_id);
    //  echo"<pre>"; print_r($data['order_data']);exit;
    $data['main_content'] = $this->load->view('admin/order/edit_order_details', $data, TRUE);
    $this->load->view('admin/index', $data);
  }


  public function edit_order_product()
  {
    if ($_POST) {
      $data = $this->input->post();
      $data = $this->security->xss_clean($data);
      // echo"<pre>"; print_r($data);exit;
      for ($i = 0; $i < count($data['serial_number']); $i++) {

        $data1 = array(


          'series_number' => $data['serial_number'][$i],

          'unit' => $data['unit'][$i],
          'quantity' => $data['quantity'][$i],
          'priority' => $data['priority'][$i],

          'design_barcode' => $data['design_barcode'][$i],
          'design_name' => $data['design_name'][$i],
          'design_code' => $data['design_code'][$i],
          'remark' => $data['remark'][$i],
          'fabric_name' => $data['fabric_name'][$i],
          'hsn' => $data['hsn'][$i],
          'stitch' => $data['stitch'][$i],
          'dye' => $data['dye'][$i],
          'matching' => $data['matching'][$i],
          'order_status' => $_POST['status'][$i]
        );
        $this->Orders_model->edit_order_product_details($data1, $data['pro_id'][$i], 'order_product');
      }



      $this->session->set_flashdata(array('error' => 0, 'msg' => 'ORDER PRODUCT UPDATE DONE'));

      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function assignPbc()
  {
    if ($_POST) {
      $data = $this->input->post();
      $data = $this->security->xss_clean($data);
      //echo "<pre>"; print_r($_POST);exit;
      try {
        $obc = $this->Orders_model->get_order_by_id2($data['order_product_id']);

        if (isset($obc[0]['pbc']) && $obc[0]['pbc'] != "") {
          $this->Orders_model->edit_by_node('parent_barcode', $obc[0]['pbc'],  array('isStock' => 1), 'fabric_stock_received');
        }
        $id = $data['id'];
        $pbc =  $this->Orders_model->getPBC_deatils($id);
        // print_r($pbc);exit;
        if (isset($pbc[0])) {
          if ($pbc[0]['fabricName'] == $data['fabric']) {
            $data1['quantity'] = $pbc[0]['current_stock'];
            $data1['pbc'] = $data['id'];
            $data1['godown'] = $pbc[0]['from_godown'];
            $data1['to_godown'] = $pbc[0]['godownid'];
            
            // print_r($data1);
            // exit;
            $this->Orders_model->edit_by_node('order_product_id', $data['order_product_id'], $data1, 'order_product');
            $this->Orders_model->edit_by_node('fsr_id', $pbc[0]['fsr_id'],  array('isStock' => 0), 'fabric_stock_received');
            echo '1';
          } else {
            echo '0';
          }
        } else {
          echo '2';
        }
      } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
    }
  }

  public function deassign()
  {
    if ($_POST) {
      $data = $this->input->post();
      $data = $this->security->xss_clean($data);
      //echo "<pre>"; print_r($_POST);exit;
      try {

        $ids =  $this->security->xss_clean($_POST['ids']);
        //print_r($_POST['ids']);exit;
        $c = 0;
        $i = 0;
        $j = 0;
        foreach ($ids as $value) {
          if ($value != "") {
            $obc = $this->Orders_model->get_order_by_id2($value);

            if (isset($obc[0]['pbc']) && $obc[0]['pbc'] != "") {
              $i +=   $this->Orders_model->edit_by_node('parent_barcode', $obc[0]['pbc'],  array('isStock' => 1), 'fabric_stock_received');
              $data1['quantity'] = 0;
              $data1['pbc'] = "";
              $data1['godown'] = 0;
              $j +=  $this->Orders_model->edit_by_node('order_product_id', $value, $data1, 'order_product');
            }

            $c += 1;
          }
        }
        if ($i == $c && $j == $c) {
          echo '1';
        } else {
          echo "0";
        }
      } catch (\Exception $e) {
        $error = $e->getMessage();
        // echo $error;
      }
    }
  }

  public function cancel_status()
  {
    if ($_POST) {
      //  echo "<pre>"; print_r($_POST);exit;
      try {

        $ids = $this->input->post('ids');
        $userid = explode(",", $ids);
        foreach ($userid as $value) {
          $pbc = $this->Orders_model->get_pbc_by_order($value);
          // pre($pbc);  exit;

          $this->Orders_model->edit_by_node('parent_barcode', $pbc, array('isStock' => 1), 'fabric_stock_received');

          $data = [
            'status' => 'CANCEL',
            'quantity' => 0,
            'pbc' => ""
          ];
          $this->Orders_model->edit_by_node('order_product_id', $value, $data, 'order_product');
          $data1 = [
            'order_id' => $value,
            'cause' => $this->input->post('cause'),
            'date' => $this->input->post('date'),
          ];
          $this->Orders_model->insert($data1, 'order_cancel_cause');
        }
      } catch (\Exception $e) {
        $error = $e->getMessage();
        $this->session->set_flashdata(array('error' => 1, 'msg' => $error));
        redirect($_SERVER['HTTP_REFERER']);
      }
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function done_status()
  {
    if ($_POST) {
      //  echo "<pre>"; print_r($_POST);exit;
      try {
        $data = [
          'status' => 'DONE'
        ];
        $ids = $this->input->post('ids');
        $userid = explode(",", $ids);
        foreach ($userid as $value) {
          $this->Orders_model->edit_by_node('order_product_id', $value, $data, 'order_product');
        }
      } catch (\Exception $e) {
        $error = $e->getMessage();
        $this->session->set_flashdata(array('error' => 1, 'msg' => $error));
        redirect($_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function deleteOrders($id)
  {
    $this->Orders_model->OrdersDelete_table($id);
    redirect(base_url('admin/Orders'));
  }

  public function deleteorder()
  {
    $ids = $this->input->post('ids');
    $userid = explode(",", $ids);
    foreach ($userid as $value) {
      $this->db->delete('order_table', array('order_product_id' => $value));
    }
  }
  public function editOrders($id)
  {
    if ($_POST) {
      $data = $this->input->post();
      // $data=$this->input->post('')
      $this->Orders_model->edit_order($data, $id, 'order_table');
      redirect(base_url('admin/Orders'));
    }
  }


  // public function order_number(){
  //   if(isset($_POST['search'])){
  //       $search = $_POST['search'];
  //       $data = $this->Orders_model->get_order_number($search);
  //       echo print_r($data);exit;
  //       foreach ($data as $value) {
  //         $response[] = array("value"=>$value['order_number'],"label"=>$value['order_number']);
  //         }
  //       }
  //       echo json_encode($response);
  // }

  public function get_order_details()
  {
    $data = array();
    if ($_POST) {
      $output = '';
      $data['all_Order_list'] = $this->Orders_model->get_order_detail_value($_POST['oreder_id'], 'order_product');
      $data['data'] = $this->load->view('admin/order/show_order', $data, TRUE);
      $this->load->view('admin/order/index', $data);
    }
  }

  public function back()
  {
    redirect(base_url('admin/Orders'));
  }

  public function get_order_number()
  {
    $lastId = $this->Orders_model->getLastId();
    //echo print_r($lastId);exit;
    $pre = explode("ORD", $lastId->order_number);
    $newId = (int) ($pre[1]) + 1;
    //echo print_r($newId);exit;
    $id = "ORD" . (string) $newId;
    return $id;
  }


  public function add_cell()
  {
    $data = array();
    $data['order_tb_value'] = $this->Orders_model->getLastId();
    //echo print_r($data['order_tb_value']);exit;
    $data = array(
      'order_id' => $data['order_tb_value']->order_number,
      'customer_name' => $data['order_tb_value']->customer_name
    );
    //echo print_r($data);exit;
    $order_number = $this->Orders_model->insert($data, 'order_product');
    echo $customer_name;
    echo $order_id;
  }

  public function get_order_data()
  {
    $data = array();
    $data['order_tb_value'] = $this->Orders_model->getLastId();
    $value = $data['order_tb_value']->order_number;
    $data = $this->Orders_model->select_order_product($value);
    // echo "<pre>";
    // echo print_r($data);exit;
    header('Content-type: application/json');
    echo json_encode($data);
  }

  public function get_order_prm()
  {
    $data = array();
    if ($_POST) {
      $data = $this->Orders_model->select_order_product($_POST['order_number']);
      //echo print_r($data['order_tbl_value']);exit;

      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function update()
  {
    $id = $_POST['order_id'];
    if (isset($_POST['series_number'])) {
      $data = array();
      $data['series_number'] = $_POST['series_number'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['customer_name'])) {
      $data = array();
      $data['customer_name'] = $_POST['customer_name'];
      // echo $id;
      // echo print_r($data);exit;
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['unit'])) {
      $data = array();
      $data['unit'] = $_POST['unit'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['quantity'])) {
      $data = array();
      $data['quantity'] = $_POST['quantity'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['priority'])) {
      $data = array();
      $data['priority'] = $_POST['priority'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['order_barcode'])) {
      $data = array();
      $data['order_barcode'] = $_POST['order_barcode'];
      echo $id;
      echo print_r($data);
      exit;
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['remark'])) {
      $data = array();
      $data['remark'] = $_POST['remark'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['design_code'])) {
      $data = array();
      $data['design_code'] = $_POST['design_code'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['fabric_name'])) {
      $data = array();
      $data['fabric_name'] = $_POST['fabric_name'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['hsn'])) {
      $data = array();
      $data['hsn'] = $_POST['hsn'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['design_name'])) {
      $data = array();
      $data['design_name'] = $_POST['design_name'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['stitch'])) {
      $data = array();
      $data['stitch'] = $_POST['stitch'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['dye'])) {
      $data = array();
      $data['dye'] = $_POST['dye'];
      $status = $this->Orders_model->Update($id, $data);
    }
    if (isset($_POST['matching'])) {
      $data = array();
      $data['matching'] = $_POST['matching'];
      $status = $this->Orders_model->Update($id, $data);
    }

    if ($status == 'true') {
      echo "success";
    }
  }
}
