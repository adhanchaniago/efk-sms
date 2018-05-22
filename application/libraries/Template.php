<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Template {
	protected $_ci;
	function __construct(){
		$this->_ci =&get_instance();
		$this->_ci->load->model('Login_M');
	}

	function display($template,$data=NULL){
		$no_hp = $this->_ci->session->userdata('no_hp');
		$nama = $this->_ci->Login_M->getNama($no_hp);

		if($nama!=''){
			$data['nama'] = $nama;
		} else {
			$data['nama'] = $this->_ci->session->userdata('no_hp');
		}

		if(!empty($this->_ci->session->userdata('login_admin'))) {
			$menu = 'menu_admin';
		} else {
			$menu = 'menu_member';
		}

		$data['_menu'] = $this->_ci->load->view('template/'.$menu,$data, true);
		$data['_content'] = $this->_ci->load->view($template,$data, true);
		$data['_footer'] = $this->_ci->load->view('template/footer',$data, true);

		$this->_ci->load->view('template/template.php',$data);
	}
}

?>