<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

Class BrowserCheck_C extends CI_Controller {
	

	public function __construct(){
		parent::__construct();
		//$this->CekBrowser();
		$this->load->library('ldap');
	}

	public function Index(){
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
			//redirect(base_url('login/login_f'));
			//$this->load->view('login_view_firefox');

			$data['title'] = 'Halaman Login - ER TRACKING';
        $this->load->view('login_view_firefox',$data);
			
		} else if ($browser == 'Chrome'){
			//$this->load->view('login_viewcn');
			//this->load->view('login_view_chrome');
			//redirect(base_url('login/login_c'));
			$data['user'] = $this->ldap->check();
        $data['title'] = 'Halaman Login - ER TRACKING';
        $this->load->view('login_view_chrome',$data);
		} else {
			//$this->load->view('login_view');
			//$this->load->view('login_view_ie');
			//redirect(base_url('login/login_c'));
			$data['user'] = $this->ldap->check();
        $data['title'] = 'Halaman Login - ER TRACKING';
        $this->load->view('login_view_chrome',$data);
		}
	}

}
?>