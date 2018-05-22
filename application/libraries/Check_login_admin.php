<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Check_login_admin {
	protected $_ci;

	function __construct(){
		$CI =& get_instance();
	if(empty($CI->session->userdata('login_admin') )){
    redirect(base_url('Home'));
	}
	}

}
?>