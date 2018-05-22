<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class SmsGateway_M extends CI_Model{

  
  public function __construct(){
    parent::__construct();
  }

  
  public function getProfilData($email){
        /*================ Fungsi untuk GET DATA Departemen ================*/

        $this->db->select('l.email, l.level, l.login_time, a.id_anggota, a.nama_anggota, a.jenis_kelamin, a.tanggal_lahir, a.no_hp, a.foto, a.alamat, a.line, a.whatsapp, a.tempat_lahir');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.email = l.email','inner');
        $this->db->where('l.email', $email);
        $this->db->limit(1);
        
        $query = $this->db->get();

        foreach ($query->result() as $data) {
            $data = array(  'email' => $data->email,
                            'level' => $data->level,
                            'login_time' => $data->login_time,
                            'id_anggota' => $data->id_anggota,
                            'nama_anggota' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => $data->tanggal_lahir,
                            'no_hp' => $data->no_hp,
                            'foto' => $data->foto,
                            'alamat' => $data->alamat,
                            'line' => $data->line,
                            'whatsapp' => $data->whatsapp,
                         );
        }


        return $data;

        /*================ Fungsi untuk GET DATA Departemen ================*/

    }
   
}