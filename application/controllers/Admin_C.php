<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require ("/home/u422738906/public_html/vendor/autoload.php");
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
class Admin_C extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Admin_M');
    //$this->load->library('email');
    $this->load->library('Check_login_admin');
    //$this->cekPendaftaran();
    //$this->load->helper('tanggal');
  }
  
  public function index(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Admin - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $this->template->display('content/index',$data);
    

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function akses(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Akses - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['list_akses'] = $this->Admin_M->listDataAkses();

    $this->template->display('content/akses',$data);
    

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

   public function edit_akses($no_hp=NULL){
    /*============= START Fungsi untuk memanggil halaman Index =============*/
    if($no_hp==''){
      redirect(base_url('Admin/akses'));
    } else {

    $no_hp = base64_decode($no_hp);
    $data['title'] = 'Edit Akses - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    $data['url1'] = $this->uri->segment(2);
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['get_akses'] = $this->Admin_M->getEditDataAkses($no_hp);
    

    $this->template->display('content/edit_akses',$data);
    
    }
    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function edit_kategori($id=NULL){
    /*============= START Fungsi untuk memanggil halaman Index =============*/
    if($id==''){
      redirect(base_url('Admin/kategori'));
    } else {

    $id = base64_decode($id);
    $data['title'] = 'Edit Kategori Barang - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    $data['url1'] = $this->uri->segment(2);
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['get_kategori'] = $this->Admin_M->getEditDataKategori($id);
    

    $this->template->display('content/edit_kategori',$data);
    
    }
    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function edit_barang($id=NULL){
    /*============= START Fungsi untuk memanggil halaman Index =============*/
    if($id==''){
      redirect(base_url('Admin/barang'));
    } else {

    $id = base64_decode($id);
    $data['title'] = 'Edit Barang - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    $data['url1'] = $this->uri->segment(2);
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['get_barang'] = $this->Admin_M->getEditDataBarang($id);
    $data['list_kategori'] = $this->Admin_M->listDataKategori();

    $this->template->display('content/edit_barang',$data);
    
    }
    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function barang(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Barang - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['list_barang'] = $this->Admin_M->listDataBarang();
    $data['list_kategori'] = $this->Admin_M->listDataKategori();

    $this->template->display('content/barang',$data);
    

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  public function log(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Log - '.project_name;
        $data['url'] = $this->uri->uri_string();
        //$kategori = 'ATK';
        $data['list_data'] = $this->Admin_M->listLog();

        //$this->CekProfil();
        $this->template->display('content/log',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

  public function kategori(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Akses - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $data['list_kategori'] = $this->Admin_M->listDataKategori();
    
    $this->template->display('content/kategori',$data);
    

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }

  function acak($panjang){
    $karakter= '0123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
    $pos = rand(0, strlen($karakter)-1);
    $string .= $karakter{$pos};
    }
    return $string;
    }

  public function insert_akses(){
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $no_hp = $this->input->post('no_hp');
    $password = $this->acak('6');
    $data = array(  'no_hp' => $no_hp,
            'password' => md5($password),
            'register_time' => $date

           );
    $where = array('no_hp' => $no_hp);
    $cek = $this->Admin_M->cekData('no_hp','login',$where);
    if($cek==0){
      $insert = $this->Admin_M->Insert('login',$data);
      if($insert){
        $this->send($no_hp,$password);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Hak Akses Sukses Diberikan</strong></div>');
        redirect(base_url('Admin/akses'));

        
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Hak Akses Gagal Diberikan</strong></div>');
        redirect(base_url('Admin/akses'));
      }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>No HP Sudah Terdaftar</strong></div>');
        redirect(base_url('Admin/akses'));
    }
    
  }
  
   public function insert_callback($no_hp,$sendMessages){
    //$date = date("Y-m-d H:i:s", strtotime('+7 hours'));
   // $no_hp = $this->input->post('no_hp');
    //$password = $this->acak('6');
    $data = array(  'no_hp' => $no_hp,
            'callback' => $sendMessages

           );
    
    
      $insert = $this->Admin_M->Insert('smsgateway_callback',$data);
     
    
    
  }

  public function delete_akses($no_hp){
    $where = array('no_hp' => base64_decode($no_hp));
    //$data = array('deleted' => '1');
    $delete = $this->Admin_M->delete('login',$where);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Delete Hak Akses Sukses</strong></div>');
        redirect(base_url('Admin/akses'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Delete Hak Akses Gagal</div></strong>');
        redirect(base_url('Admin/akses'));
    }
  }

  public function update_akses(){
    $no_hp = $this->input->post('no_hp');
    $where = array('no_hp' => $no_hp);
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $upd_by = $this->session->userdata('no_hp');
    $data = array('updated_time' => $date,
                  'updated_by' => $upd_by,
                  'verifikasi' => $this->input->post('verifikasi'),
                  'status' => $this->input->post('status')
                );
    $delete = $this->Admin_M->update('login',$where,$data);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Update Data Hak Akses Sukses</strong></div>');
        redirect(base_url('Admin/akses'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Update Data Hak Akses Gagal</div></strong>');
        redirect(base_url('Admin/akses'));
    }
  }

  public function update_kategori(){
    $id = $this->input->post('id_kategori');
    $where = array('id_kategori' => $id);
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $upd_by = $this->session->userdata('no_hp');
    $nama_kategori = $this->input->post('nama_kategori');
    $data = array('updated_time' => $date,
                  'updated_by' => $upd_by,
                  'nama_kategori' => $nama_kategori
                );
   
      $delete = $this->Admin_M->update('master_kategori',$where,$data);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Update Data Kategori Sukses</strong></div>');
        redirect(base_url('Admin/kategori'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Update Data Kategori Gagal</div></strong>');
        redirect(base_url('Admin/kategori'));
    }
  
    
  }

  public function update_barang(){
    $id_barang = $this->input->post('id_barang');
    $id_kategori = $this->input->post('id_kategori');
    $where = array('id_barang' => $id_barang);
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $upd_by = $this->session->userdata('no_hp');
    $nama_barang = $this->input->post('nama_barang');
    $qty = $this->input->post('qty');
    $data = array('updated_time' => $date,
                  'updated_by' => $upd_by,
                  'nama_barang' => $nama_barang,
                  'id_kategori' => $id_kategori,
                  'qty' => $qty
                );
   
      $delete = $this->Admin_M->update('master_barang',$where,$data);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Update Data Barang Sukses</strong></div>');
        redirect(base_url('Admin/barang'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Update Data Barang Gagal</div></strong>');
        redirect(base_url('Admin/barang'));
    }
  
    
  }

  public function insert_kategori(){
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $no_hp = $this->session->userdata('no_hp');
    $nama_kategori = ucwords($this->input->post('nama_kategori'));
    $data = array(  'nama_kategori' => $nama_kategori,
            'created_time' => $date,
            'created_by' => $no_hp

           );
    $where = array('nama_kategori' => $nama_kategori,
                    'deleted' => '0');
    $cek = $this->Admin_M->cekData('nama_kategori','master_kategori',$where);
    if($cek==0){
      $insert = $this->Admin_M->Insert('master_kategori',$data);
    if($insert){
    $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Input Data Kategori Barang Berhasil</div>');
      redirect(base_url('Admin/kategori'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Input Data Kategori Barang Gagal</div>');
      redirect(base_url('Admin/kategori'));
    }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Nama Kategori Sudah Ada</div>');
        redirect(base_url('Admin/kategori'));
    }
    
  }

  public function insert_barang(){
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $no_hp = $this->session->userdata('no_hp');
    $nama_barang = ucwords($this->input->post('nama_barang'));
    $data = array(  'nama_barang' => $nama_barang,
            'created_time' => $date,
            'created_by' => $no_hp,
            'qty' => $this->input->post('qty'),
            'id_kategori' => $this->input->post('nama_kategori')

           );
    $where = array('nama_barang' => $nama_barang,
                    'deleted' => '0');
    $cek = $this->Admin_M->cekData('nama_barang','master_barang',$where);
    if($cek==0){
      $insert = $this->Admin_M->Insert('master_barang',$data);
    if($insert){
    $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Input Data Barang Berhasil</div>');
      redirect(base_url('Admin/barang'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Input Data Barang Gagal</div>');
      redirect(base_url('Admin/barang'));
    }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Nama Barang Sudah Ada</div>');
        redirect(base_url('Admin/barang'));
    }
    
  }

  public function delete_kategori($id){
    $where = array('id_kategori' => base64_decode($id));
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $no_hp = $this->session->userdata('no_hp');
    $data = array('deleted' => '1',
                  'deleted_time' => $date,
                  'deleted_by' => $no_hp
                );
    $delete = $this->Admin_M->update('master_kategori',$where,$data);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Delete Kategori Barang Sukses</strong></div>');
        redirect(base_url('Admin/kategori'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Delete Kategori Barang Gagal</div></strong>');
        redirect(base_url('Admin/kategori'));
    }
  }

  public function send($no_hp,$password){
   $config = Configuration::getDefaultConfiguration();
    $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjc4NzE0NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ3OTgyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.3ZMlXKv8EZXZ45QNzAHyq1ejWuFKF2PaEbKVkPzygxQ');
    $apiClient = new ApiClient($config);
    $messageClient = new MessageApi($apiClient);
    $url = "https://bit.ly/2Gz1kTV";
    $msg = "[EFK - SMS] Berikut detail akun login kamu : \nNo HP : $no_hp \nPassword : $password \nLogin : $url";
    // Sending a SMS Message
    $sendMessageRequest1 = new SendMessageRequest([
        'phoneNumber' => $no_hp,
        'message' => $msg,
        'deviceId' => 83493
    ]);

    $sendMessages = $messageClient->sendMessages([
        $sendMessageRequest1
    ]);
    
    $this->insert_callback($no_hp,print_r($sendMessages));
    //print_r($sendMessages);
            }

          public function tes(){
   $config = Configuration::getDefaultConfiguration();
    $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjc4NzE0NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ3OTgyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.3ZMlXKv8EZXZ45QNzAHyq1ejWuFKF2PaEbKVkPzygxQ');
    $apiClient = new ApiClient($config);
    $messageClient = new MessageApi($apiClient);
    $no_hp = '089687610639';
    $password = '123456';
      $msg = "[EFK - SMS] Berikut detail akun login kamu : \n No HP : $no_hp & Password : $password";
    // Sending a SMS Message
    $sendMessageRequest1 = new SendMessageRequest([
        'phoneNumber' => $no_hp,
        'message' => $msg,
        'deviceId' => 83493
    ]);

    $sendMessages = $messageClient->sendMessages([
        $sendMessageRequest1
    ]);
    echo '<pre>';
    print_r($sendMessages);
            }

   

  public function delete_barang($id){
    $where = array('id_barang' => base64_decode($id));
    $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
    $no_hp = $this->session->userdata('no_hp');
    $data = array('deleted' => '1',
                  'deleted_time' => $date,
                  'deleted_by' => $no_hp
                );
    $delete = $this->Admin_M->update('master_barang',$where,$data);
    if($delete){
      $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Delete Barang Sukses</strong></div>');
        redirect(base_url('Admin/barang'));
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Delete Barang Gagal</div></strong>');
        redirect(base_url('Admin/barang'));
    }
  }

  public function profile(){
    /*============= START Fungsi untuk memanggil halaman Index =============*/

    $data['title'] = 'Profile - '.project_name;
    //$data['class'] = 'section-white';
    $data['url'] = $this->uri->uri_string();
    $no_hp = $this->session->userdata('no_hp');
    $data['data_profil'] = $this->Admin_M->getProfilData($no_hp);;
    //$data['total'] = $this->Home_M->jumlah_anggota();
    $this->template->display('content/profil',$data);
    

    /*============= END Fungsi untuk memanggil halaman Index =============*/
  }


  public function balas_email($email, $pesan, $balasan,$nama){
    $htmlContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Balasan Pesan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
    <meta name="format-detection" content="telephone=no" />
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!--<![endif]-->
    <body style="margin:0px; padding:0px;" bgcolor="#ffffff">
    Halo < '.$nama.' > <br><br>
    Terkait dengan pesan kamu sebelumnya. <br><br>
    Pesan Kamu : '.$pesan.'. <br><br>
    Jawaban Kami : '.$balasan.'.
    </body>
</html>';

$config = Array(        
           
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1',
            'priority'  => 1
        );
$this->email->initialize($config);
$this->email->to($email);
$this->email->from('mailer@jujitsu-upn.online','Jujitsu UPN Mailer');
$this->email->subject('Balasan Pesan');
$this->email->message($htmlContent);
$this->email->send();
  }

 
  

}
