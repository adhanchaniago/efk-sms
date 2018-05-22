<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

Class NotFound_C extends CI_Controller{

    public function __construct(){
        parent::__construct();
      
    }

    public function index(){
    	/*================ Fungsi untuk memanggil Halaman 404 Not Found ================*/

    		$data['title'] = 'Halaman Tidak Dapat Ditemukan';
		$data['url'] = $this->uri->uri_string();

        if($this->session->userdata('login_member') == 'true' OR $this->session->userdata('login_admin') == 'true') {
            $this->template->display('content/404',$data);
        } else {
            $this->load->view('404');
        }

		

		/*================ Fungsi untuk memanggil Halaman 404 Not Found ================*/
    }

}