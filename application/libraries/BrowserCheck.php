<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class BrowserCheck {
	protected $_ci;

	function __construct(){
		$CI =& get_instance();
	/*if(empty($CI->session->userdata('login') )){
    redirect(base_url('login'));
	}*/

	$CI->CekBrowser();
	}

	function CekBrowser(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') )
			{
				$browser = 'Mozilla Firefox';
			}
			else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') )
			{
				$browser = 'Chrome';
			}
			else
			{
				$browser = 'Other';
			}
			//echo $browser;
		if ($browser == 'Mozilla Firefox'){
			//$this->load->view('login_viewcn');
			redirect(base_url('login/login_f'));
			//$this->load->view('login_view_firefox');
			
		} else if ($browser == 'Chrome'){
			//$this->load->view('login_viewcn');
			$//this->load->view('login_view_chrome');
			redirect(base_url('login/login_c'));
		} else {
			//$this->load->view('login_view');
			//$this->load->view('login_view_ie');
			redirect(base_url('login/login_c'));
		}
	}

}
?>