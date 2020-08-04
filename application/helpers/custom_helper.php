<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//-- check logged user
	if (!function_exists('check_login_user')) {
	    function check_login_user() {
	        if (check()) {
	            return;
	        }else {
						redirect(base_url());
	        }
	    }
	}


	if (!function_exists('serve_url')) {
	    function serve_url($data) {
				$data = str_replace('/', '_', $data);
				$data = str_replace(' ', '.', $data);
				return $data;
	    }
	}
	if (!function_exists('sanitize_url')) {
	    function sanitize_url($data) {
				$data = str_replace('_', '/', $data);
				$data = str_replace('.', ' ', $data);
				return $data;
	    }
	}

	if (!function_exists('get_increment')) {
	    function get_increment($data, &$inc) {
				return $inc = $inc + 1 ;
	    }
	}

	if (!function_exists('get_badge')) {
	    function get_badge($data) {
				$color = array('success', 'danger', 'primary', 'info', 'dark', 'warning', 'secondary', 'light');
				$output = '';
				if (is_array(explode(',', $data))) {
					$data = explode(',', $data);
					foreach ($data as $value) {
						$output .= '<span class="badge badge-pill badge-'.$color[array_rand($color)].'">'.$value.'</span>';
					}
				}else{
					$output .= '<span class="badge badge-pill badge-'.$color[array_rand($color)].'">'.$data.'</span>';
				}
				return $output;
	    }
	}

	if (!function_exists('pre')) {
	    function pre($data) {
	        echo "<pre>";
          print_r($data);
	        echo "</pre>";
	    }
	}

	if(!function_exists('check_power')){
	    function check_power($type){
	        $ci = get_instance();

	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_power($type);

	        return $option;
	    }
    }

	//-- current date time function
	if(!function_exists('current_datetime')){
	    function current_datetime(){
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');
	        return $date_time;
	    }
	}

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	//-- show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){

	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}
