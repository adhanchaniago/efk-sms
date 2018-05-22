<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home_C extends CI_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Login_M');
        $this->load->model('Home_M');
        $this->load->library('Check_login');
       
        //$this->check_login(); //panggil fungsi check_login di file ini
        //$this->cek_akses(); //panggil fungsi cek_akses di file ini
    }

    public function index(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Home - '.project_name;
        $data['url'] = $this->uri->uri_string();
         $this->CekProfil();
        $this->template->display('content/index',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

    public function stock(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Stock Barang - '.project_name;
        $data['url'] = $this->uri->uri_string();
        //$kategori = 'ATK';
        $data['list_data'] = $this->Home_M->listStock();
        $this->CekProfil();
        $this->template->display('content/stock',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

    public function log(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Aktifitas Stock - '.project_name;
        $data['url'] = $this->uri->uri_string();
        //$kategori = 'ATK';
        $data['list_data'] = $this->Home_M->listLog();

        $this->CekProfil();
        $this->template->display('content/log',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

     public function edit_stock($id){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Stock Barang - '.project_name;
        $data['url'] = $this->uri->uri_string();
        $data['url1'] = $this->uri->segment(2);
        //$kategori = 'ATK';
        $id = base64_decode($id);
        $data['stock'] = $this->Home_M->getEditStock($id);
        $this->CekProfil();
        $this->template->display('content/edit_stock',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

    public function update_stock(){
        $qty_in = $this->input->post('qty_in');
        $qty_out = $this->input->post('qty_out');
        $id = $this->input->post('id_barang');
        $date = date("Y-m-d H:i:s", strtotime('+7 hours'));
        $no_hp = $this->session->userdata('no_hp');
        $name = $this->Home_M->getProfilName($no_hp);
        $explode = explode(" ", $name);

        $count = count($explode);
        
        for($i=0;$i<$count;$i++){

        $string .= substr($explode[$i], 0, 1);
        echo $string;
      
    }
        $note = ucwords($this->input->post('note'));
        if($note==""){
            $note = '-';
        }
        if($qty_in != '' OR $qty_in > 0){
            $keterangan = "Menambahkan Stock";
            $update = $this->Home_M->tambahStock($qty_in,$id,$string,$note,$date,$keterangan,$no_hp);
        } else {
            $keterangan = "Mengurangi Stock";
            $update = $this->Home_M->kurangStock($qty_out,$id,$string,$note,$date,$keterangan,$no_hp);
        }

        if($update){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Stock Barang Berhasil Diubah</strong></div>');
          redirect(base_url('Home/stock'));
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Stock Barang Gagal Diubah</strong></div>');
          redirect(base_url('Home/stock'));
        }
    }


    public function profile(){
        /*================ Fungsi untuk memanggil halaman Profil ================*/

        $data['title'] = 'Profil - '.project_name;
        $data['url'] = $this->uri->uri_string();
        $no_hp = $this->session->userdata('no_hp');
        $data['profil'] = $this->getProfil($no_hp);
        

        if($data['profil'] == '1'){
             $data['data_profil'] = $this->getProfilData($no_hp);
            $this->template->display('content/profil',$data);
        } else {
            $this->template->display('content/isi_profil',$data);
        }

        /*================ Fungsi untuk memanggil halaman Profil ================*/
    }

    public function insert_profil(){


                $no_hp = $this->session->userdata('no_hp');
                $nama_anggota = ucwords($this->input->post('nama'));
                $id_anggota = $this->getIdAnggota($no_hp,$nama_anggota);
               
                $data = array(
                            'id_anggota' => $id_anggota,
                            'nama_anggota' => $nama_anggota,
                            'no_hp' => $no_hp,
                            'foto' => 'avatar_placeholder.jpg',
                            'register_time' => date("Y-m-d H:i:s", strtotime('+7 hours'))
                            
                             );
               
            
                        $data = $this->Home_M->Insert('anggota', $data);
                        if($data){
                             $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center"><strong>Hooray Profile Berhasil Di Input</strong></div>');
                               redirect(base_url('Home/profile'));
                        } else {
                              $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center"><strong>Yahhh Profile Gagal Di Input</strong></div>');
                               redirect(base_url('Home/profile'));
                        }
              

        
    }

    public function getIdAnggota($no_hp,$nama_anggota){
        //$date = date('Y-m-d');
        $name = $nama_anggota;
        $explode = explode(" ", $name);

        $count = count($explode);
        
        for($i=0;$i<$count;$i++){

        $string .= substr($explode[$i], 0, 1);
        //echo $string;
      
    }

        $kode = $string.'-'.$no_hp;
        //$kode_otomatis = $this->Home_M->kode_otomatis($kode);

        return $kode;
    }

    public function getProfil($no_hp){
        return $this->Home_M->getProfil($no_hp);

    }

    public function getProfilData($no_hp){
        return $this->Home_M->getProfilData($no_hp);

    }

    public function CekProfil(){
        $no_hp = $this->session->userdata('no_hp');
        $profil = $this->getProfil($no_hp);

        if($profil=='0'){
            redirect(base_url('Home/profile'));
        }
    }

    public function sign($no_hp){
        $name = $this->Home_M->getProfilName($no_hp);
        $explode = explode(" ", $name);

        $count = count($explode);
        
        for($i=0;$i<$count;$i++){

        $string .= substr($explode[$i], 0, 1);
        return $string;
      
    }

   
  }


    /* ============= Backup 3 januari 2018, Job = HQ tanpa di kasih hak akses bisa masuk (HQ bisa akses semua) ===========

    public function cek_akses(){
        $where = array('ac' => strtoupper($this->session->userdata('ac')));
            $hak_akses = $this->Login_M->cek_akses("cek_akses",$where);
            $login = $this->session->userdata('cek');
            if($login=='Headquarter'){
            if($hak_akses->status == 'Ijinkan'){
                $super_user_session = array(
                'superUser' => $hak_akses->is_super_user
                );
               $this->session->set_userdata($super_user_session);
            } else {
                redirect("error");
            }
        } else {

        }
    }*/

     public function check_login(){
        /*================ Fungsi untuk CEK LOGIN ================*/

        if(empty($this->session->userdata('login')) AND 
            empty($this->session->userdata('login_admin'))){
            redirect(base_url(''));
            }

    /*================ Fungsi untuk CEK LOGIN ================*/
    }




}