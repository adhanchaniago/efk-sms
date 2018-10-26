<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin_M extends CI_Model{

    
    public function __construct(){
        parent::__construct();
    }

    public function tes_sp($value){
    $array = array('get_ref' => $value);
    $data = $this->db->query("CALL `SPGetDataAnggotaByRefCodeToApproval`(?)",$array);
    $result = $data->result();
    
    print_r($result);
    }
    
    public function getReport($tgl_awal, $tgl_akhir){
        
        $this->db->select('mb.nama_barang, a.nama_anggota, ts.*');
        $this->db->from('transaksi_stock ts');
        $this->db->join('master_barang mb' ,'mb.id_barang = ts.id_barang', 'inner');
        $this->db->join('anggota a' ,'a.no_hp = ts.created_by', 'inner');
        $this->db->where('ts.created_time >=', $tgl_awal);
        $this->db->where('ts.created_time <=', $tgl_akhir);
        $query = $this->db->get();
       	$data = $query->result_array();
        return $data;
    }

    public function listDataAkses(){
        $this->db->where('level', 'Anggota');
        $query = $this->db->get('login');
        $data = $query->result();
        return json_encode($data);
    }

    public function listLog(){

        $this->db->select('ts.*, a.nama_anggota, a.foto, mb.nama_barang, mb.qty, mk.nama_kategori');
        $this->db->from('transaksi_stock ts');
        $this->db->join('anggota a', 'a.no_hp=ts.created_by', 'inner');
        $this->db->join('master_barang mb', 'mb.id_barang=ts.id_barang', 'inner');
        $this->db->join('master_kategori mk', 'mk.id_kategori=mb.id_kategori', 'inner');
        $this->db->order_by('ts.created_time', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get();
        
        //$query = $this->db->query("CALL `SPGetListLog`()");
        $data = $query->result();

        return json_encode($data);
    }

    public function getEditDataAkses($no_hp){
        $this->db->where('no_hp',$no_hp);
        $this->db->limit(1);
        $query = $this->db->get('login');
        foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'verifikasi' => $data->verifikasi,
                            'status' => $data->status
                         );
        }

        return $data;
    }

    public function getEditDataKategori($id){
        $this->db->where('id_kategori',$id);
        $this->db->limit(1);
        $query = $this->db->get('master_kategori');
        foreach ($query->result() as $data) {
            $data = array(   'id_kategori' => $data->id_kategori,
                            'nama_kategori' => $data->nama_kategori
                         );
        }

        return $data;
    }

    public function getEditDataBarang($id){
        $this->db->select('mb.id_barang, mb.nama_barang, mk.nama_kategori, mk.id_kategori,
         mb.qty');
        $this->db->from('master_barang mb');
        $this->db->join('master_kategori mk' ,'mk ON mb.id_kategori=mk.id_kategori', 'inner');
        $this->db->where('mb.id_barang', $id);
        $this->db->where('mb.deleted', '0');
        $this->db->limit(1);
         $query = $this->db->get();
        foreach ($query->result() as $data) {
            $data = array(   'id_barang' => $data->id_barang,
                            'nama_barang' => $data->nama_barang,
                            'qty' => $data->qty,
                            'id_kategori' => $data->id_kategori,
                            'nama_kategori' => $data->nama_kategori
                         );
        }

        return $data;
    }



    public function listDataBarang(){
        $this->db->select('mb.id_barang, mb.nama_barang, mk.nama_kategori, mb.qty');
        $this->db->from('master_barang mb');
        $this->db->join('master_kategori mk' ,'mk ON mb.id_kategori=mk.id_kategori', 'inner');
        $this->db->where('mb.deleted', '0');
        $this->db->order_by('mb.nama_barang', 'ASC');
        $query = $this->db->get();
        $data = $query->result();
        return json_encode($data);
    }


    public function listDataKategori(){
        $this->db->where('deleted', '0');
        $this->db->order_by('nama_kategori', 'ASC');
        $query = $this->db->get('master_kategori');
        $data = $query->result();
        return json_encode($data);
    }

    public function getProfilData($no_hp){
        /*================ Fungsi untuk GET DATA Departemen ================*/

        $this->db->select('l.no_hp, l.level, l.login_time, a.id_anggota, a.nama_anggota, a.no_hp, a.foto,a.register_time');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp = l.no_hp','inner');
        $this->db->where('l.no_hp', $no_hp);
        $this->db->limit(1);
        
        $query = $this->db->get();

        foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            
                            'login_time' => $data->login_time,
                            'id_anggota' => $data->id_anggota,
                            'nama_anggota' => $data->nama_anggota,
                            'level' => $data->level,
                            'no_hp' => $data->no_hp,
                            'foto' => $data->foto,
                            'register_time' => $data->register_time
                         );
        }


        return $data;

        /*================ Fungsi untuk GET DATA Departemen ================*/

    }

    public function cekData($select,$table,$where){   
     $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $jumlah = $query->num_rows();
        return $jumlah;

  }

    public function update($table,$where,$data){
        //$this->db->set()   
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        return $query;
  }

  public function delete($table,$where){
        //$this->db->set()   
        $this->db->where($where);
        $query = $this->db->delete($table);
        return $query;
  }

  public function Insert($table,$data){
        $insert = $this->db->insert($table, $data); // Kode ini digunakan untuk memasukan record baru kedalam sebuah tabel
        return $insert; // Kode ini digunakan untuk mengembalikan hasil $res
    }

}