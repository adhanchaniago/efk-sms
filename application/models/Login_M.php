<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Login_M extends CI_Model{

	
	public function __construct(){
		parent::__construct();
	}

	public function cek_login($table,$where){		
		return $this->db->get_where($table,$where,1);
	}

	public function update($no_hp,$table,$data){   
		$this->db->where('no_hp', $no_hp);
		//$this->db->where('deleted', '0');
		$query = $this->db->update($table, $data);
		return $query;
  }

  	public function getNama($no_hp){
  		$this->db->select('nama_anggota');
  		$this->db->from('anggota');
  		$this->db->where('no_hp',$no_hp);
  		//$this->db->where('deleted', '0');
  		$this->db->limit(1);
  		$query = $this->db->get();

  		foreach ($query->result() as $data) {
  			$nama = $data->nama_anggota;
  		}

  		return $nama;
  	}
}