<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Akses{

	public $user;

	function __construct(){
		$this->CI =&get_instance();
		$auth = $this->CI->config->item('auth');
		$this->CI->load->helper('cookie');
		$this->CI->load->model('login');
	}

	function 
}