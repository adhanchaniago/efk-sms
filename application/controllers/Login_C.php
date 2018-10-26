<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_C extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Login_M');
    //$this->load->library('Check_login');
    
  }

  public function index(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Login - '.project_name;
    $data['class'] = 'login-page';
    //$data['captcha'] = $this->Captcha_M->captcha();
    //$data['url'] =  $this->uri->uri_string();
    $this->load->view('login',$data);

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function login(){
    /*============= START Fungsi untuk cek Login =============*/

      $no_hp = $this->input->post('no_hp');
      $password = $this->input->post('password');
      
      $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
       

        $where = array(
            'no_hp' => $no_hp,
            'password' => md5($password)
            );
        $data = array('login_time' => $date);
        $cek = $this->Login_M->cek_login('login',$where)->num_rows();
        
        if($cek > 0){
        $update = $this->Login_M->update($no_hp,'login',$data);
        $data = $this->Login_M->cek_login('login',$where)->result_array();
        foreach($data as $row){
        $verifikasi = $row['verifikasi'];
        $status = $row['status'];
        $level = $row['level'];
        }
        if($status=='0'){
               
            echo 'inactive';
           
          } elseif($level=='Anggota'){
            $data_session = array(
                'no_hp' => $no_hp,
                'login_member' => "true"
                );
                
                $this->session->set_userdata($data_session); //jika username dan password benar, status nya aktiv
                                                         //maka pasang fungsi SESSION
 
           
            echo 'anggota';
 
            
        } elseif($level=='Admin'){
            $data_session = array(
                'no_hp' => $no_hp,
                'login_admin' => "true"
                );
        
        $this->session->set_userdata($data_session); //jika username dan password benar, status nya aktiv
                                                         //maka pasang fungsi SESSION
          
            echo 'admin';
 
          
        }
        }else{
          
           
           echo 'salah';
        }

      /*============= END Fungsi untuk cek Login =============*/
    }

    public function logout(){
      /*============= START Fungsi untuk Logout =============*/
        $no_hp = $this->session->userdata('no_hp');
        $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
        $data = array('logout_time' => $date);
        $update = $this->Login_M->update($no_hp,'login',$data);
        $this->session->sess_destroy();  //buang data dari SESSION yang aktif
        redirect(base_url(''));

        /*============= END Fungsi untuk Logout =============*/
    }
   
   
}
