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
    
    function check() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    echo $ipaddress;
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
    
    public function report(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

       
        $data['url'] = $this->uri->uri_string();
        
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $data['tgl_awal'] =  $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
       

        if(empty($tgl_awal) AND empty($tgl_akhir)){
           $data['title'] = 'Report - '.project_name;
           } else {
                 
            $data['report'] = $this->Home_M->getReport($tgl_awal, $tgl_akhir);
            $data['title'] = 'Laporan Tanggal : '.$tgl_awal.' Sampai '.$tgl_akhir;
            
           /* foreach(json_decode($data['report']) as $key){
                echo $key->nama_barang;
            }
            
            echo '<pre>';print_r($data['report']);die;*/
          
           }
        $this->CekProfil();
        $this->template->display('content/report',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }


    public function log(){
        /*================ Fungsi untuk memanggil halaman Index ================*/

        $data['title'] = 'Aktifitas Stock - '.project_name;
        $data['url'] = $this->uri->uri_string();
        //$kategori = 'ATK';
        //$data['list_data'] = $this->Home_M->listLog();

        $this->CekProfil();
        $this->template->display('content/log',$data);
        
        /*================ Fungsi untuk memanggil halaman Index ================*/
    }

    public function ajax_log(){
        $data['list_data'] = $this->Home_M->listLog();
        $this->load->view('content/ajax_log',$data);
    }
    
    
    public function ajax_edit_stock($id){
        //$id = $this->input->post('id_barang');
        //$id = $this->input->get('id');
         $id = base64_decode($id);
        $data['stock'] = $this->Home_M->getEditStock($id);
        $tes = array('qty' => 50);
       // echo json_encode($data['stock']);
       $this->load->view('content/ajax_edit_stock', $data);
        
    }

     public function edit_stock($id){
        /*================ Fungsi untuk memanggil halaman Index ================*/
        if($id==''){
            redirect(base_url('Home/stock'));
        } else {
        $data['title'] = 'Stock Barang - '.project_name;
        $data['url'] = $this->uri->uri_string();
        $data['url1'] = $this->uri->segment(2);
        //$kategori = 'ATK';
        $id = base64_decode($id);
        $data['stock'] = $this->Home_M->getEditStock($id);
        $this->CekProfil();
        $this->template->display('content/edit_stock',$data);
        }
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
    
    public function ExcelReport($id=NULL){
        
        //$this->load->view('feedback/admin/export_excel',$data);
        //$periode = $this->session->userdata('login_periode');
        $tgl_awal = $this->uri->segment(3);
        $tgl_akhir = $this->uri->segment(4);
         $data_report = $this->Home_M->getReport($tgl_awal, $tgl_akhir);
        $filename = 'Report Tanggal '.$tgl_awal.'-'.$tgl_akhir.'.xlsx';
       $this->load->library("Excel/PHPExcel");
 
            //membuat objek PHPExcel
            $objPHPExcel = new PHPExcel();
 
            //set Sheet yang akan diolah 
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                                        ->setCellValue('A1', 'NO')
                                        ->setCellValue('B1', 'NAMA BARANG')
                                        ->setCellValue('C1', 'STOK BARANG')
                                        ->setCellValue('D1', 'IN')
                                        ->setCellValue('E1', 'OUT')
                                        ->setCellValue('F1', 'STOK SEBELUMNYA')
                                        ->setCellValue('G1', 'SIGN')
                                        ->setCellValue('H1', 'KETERANGAN')
                                        ->setCellValue('I1', 'NOTES')
                                        ->setCellValue('J1', 'TANGGAL LOG')
                                        ->setCellValue('K1', 'EDITED BY');

            if($data_report['ER_NUMBER']!=''){
                $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya ->setCellValue('A1', 'ID')
                                      
                    ->setCellValueExplicit('A2', $no++, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('B2', $data_report['nama_barang'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('C2', $data_report['on_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('D2', $data_report['in_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('E2', $data_report['out_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F2', $data_report['stock_before'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G2', $data_report['sign'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H2', $data_report['keterangan'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I2', $data_report['notes'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J2', $data_report['created_time'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K2', $data_report['nama_anggota'], PHPExcel_Cell_DataType::TYPE_STRING);

                    $styleArray = array(
       
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );

            $from = "A1"; // or any value
            $to = "K1"; // or any value
            $objPHPExcel->getActiveSheet()->getStyle("$from:$to")->applyFromArray($styleArray);

             $objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
             $from = "A2"; // or any value
            $to = "K2"; // or any value
             $objPHPExcel->getActiveSheet()->getStyle("$from:$to")->applyFromArray($styleArray);
            //$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
            //set title pada sheet (me rename nama sheet)
            foreach(range('A','K') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
        }

        
            } else {

                 $i = 2;   
                 $no = 1;                    
            foreach ($data_report as $key => $value) {
                

                $j = $i++;
               $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya ->setCellValue('A1', 'ID')
                                      
                   >setCellValueExplicit('A2', $no++, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('B2', $value['nama_barang'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('C2', $value['on_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('D2', $value['in_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('E2', $value['out_stock'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F2', $value['stock_before'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G2', $value['sign'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H2', $value['keterangan'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I2', $value['notes'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J2', $value['created_time'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K2', $value['nama_anggota'], PHPExcel_Cell_DataType::TYPE_STRING);
            }

            $styleArray = array(
       
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );

            $from = "A1"; // or any value
            $to = "K1"; // or any value
            $objPHPExcel->getActiveSheet()->getStyle("$from:$to")->applyFromArray($styleArray);

             $objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
            
            foreach(range('A','K') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
        }

        

            }
            
            $objPHPExcel->getActiveSheet()->setTitle('Laporan Log Stock');
 
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh
            header('Content-Disposition: attachment;filename='.$filename);
            //unduh file
            $path = 'E://';
            $objWriter->save("php://output");
    }




}