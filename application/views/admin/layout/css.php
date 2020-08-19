<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$godown = $this->db->get('sub_department')->result();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('optimum/admin') ?>/assets/images/favicon.png">
    <title><?php echo $system_title . " || " . $system_name ?></title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/multicheck/multicheck.css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('optimum/admin') ?>/dist/css/style.min.css" rel="stylesheet" media='all'>
    <link href="<?php echo base_url('optimum/admin') ?>/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/libs/select2/dist/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url('optimum/admin') ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('optimum/admin') ?>/assets/libs/select2/dist/js/select2.min.js"></script>

    <link href="<?php echo base_url('optimum/admin') ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Datatable -->



    <link href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/DataTables-1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Select-1.3.1/css/select.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/FixedHeader-3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">


    <style>
        .tip {
            display: inline-block;
            font-size: 18px;
            margin: 0 4px;
        }

        #overlay {
            font-family: monospace;
            width: 100%;
            height: 100%;
            background: #f0f0f0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            display: none;
        }

        td.details-control {
            background: url('<?php echo base_url('optimum/admin') ?>/assets/images/plus.png') no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url('<?php echo base_url('optimum/admin') ?>/assets/images/minus.png') no-repeat center center;
        }

        div#overlay img {
            position: relative;
            top: 50%;
            left: 50%;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #2255a4;
        }
    </style>
</head>

<body>