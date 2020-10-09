<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//LOCATION : application - controller - Home.php

class Backup extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
    }
  public function index()
  {
    $this->load->database();

    $this->load->dbutil();

    $prefs = array(
      'format'      => 'zip',
      'filename'    => 'my_db_backup.sql'
    );


    $backup = &$this->dbutil->backup($prefs);

    $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
    $save = 'pathtobkfolder/' . $db_name;

    $this->load->helper('file');
    // write_file($save, $backup);


    $this->load->helper('download');
    force_download($db_name, $backup);
  }
  public function unloadbase()
  {
    $this->load->dbforge();
    $this->dbforge->drop_database($this->db->database);
  }
}
