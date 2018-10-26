<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home_M extends CI_Model{

	public function __construct(){
		parent::__construct();
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
	
	public function getProfil($no_hp){
		/*================ Fungsi untuk GET DATA Departemen ================*/

		$this->db->select('no_hp');
		$this->db->from('anggota');
		$this->db->where('no_hp', $no_hp);
		$this->db->limit(1);
		
		$query = $this->db->get();


		return $query->num_rows();

		/*================ Fungsi untuk GET DATA Departemen ================*/

	}

	public function getProfilName($no_hp){
		/*================ Fungsi untuk GET DATA Departemen ================*/

		$this->db->select('nama_anggota');
		$this->db->from('anggota');
		$this->db->where('no_hp', $no_hp);
		$this->db->limit(1);
		
		$query = $this->db->get();

		foreach($query->result() as $data){
			$nama = $data->nama_anggota;
		}

		return $nama;

		/*================ Fungsi untuk GET DATA Departemen ================*/

	}

	public function listStock(){
        $this->db->select('mb.id_barang, mb.nama_barang, mk.nama_kategori, mk.id_kategori,
         mb.qty');
        $this->db->from('master_barang mb');
        $this->db->join('master_kategori mk' ,'mb.id_kategori=mk.id_kategori', 'inner');
        //$this->db->where('mb.id_barang', $id);
        $this->db->where('mb.deleted', '0');
        //$this->db->group_by('mk.nama_kategori');
        $this->db->order_by('mb.nama_barang', 'ASC');
        //$this->db->where('mk.nama_kategori', $kategori);
        //$this->db->limit(1);
         $query = $this->db->get();
       	$data = json_encode($query->result_array());
        return $data;
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
    	$data = $query->result();

    	return json_encode($data);
    }

    public function getEditStock($id){
        $this->db->select('mb.id_barang, mb.nama_barang, mk.nama_kategori, mk.id_kategori,
         mb.qty');
        $this->db->from('master_barang mb');
        $this->db->join('master_kategori mk' ,'mb.id_kategori=mk.id_kategori', 'inner');
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

    public function getStock($id){
    	$this->db->select('qty');
    	//$this->db->get('master_barang');
    	$this->db->limit(1);
    	$query = $this->db->get('master_barang');
    	$data = $query->result();

    	return json_encode($data);
    }

    public function editStock(){
        $this->db->select('mb.id_barang, mb.nama_barang, mk.nama_kategori, mk.id_kategori,
         mb.qty');
        $this->db->from('master_barang mb');
        $this->db->join('master_kategori mk' ,'mb.id_kategori=mk.id_kategori', 'inner');
        $this->db->where('mb.id_barang', $id);
        $this->db->where('mb.deleted', '0');
        //$this->db->where('mk.nama_kategori', $kategori);
        //$this->db->limit(1);
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

	public function getProfilData($no_hp){
		/*================ Fungsi untuk GET DATA Departemen ================*/

		 $this->db->select('l.no_hp, l.level, l.login_time, a.id_anggota, a.nama_anggota, a.no_hp, a.foto,a.register_time');
		$this->db->from('login l');
		$this->db->join('anggota a', 'a.no_hp = l.no_hp','inner');
		$this->db->where('l.no_hp', $no_hp);
		$this->db->limit(1);
		
		$query = $this->db->get();

		foreach ($query->result() as $data) {
			$data = array(	'no_hp' => $data->no_hp,
							
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

	public function Insert($table,$data){
        $insert = $this->db->insert($table, $data); // Kode ini digunakan untuk memasukan record baru kedalam sebuah tabel
        return $insert; // Kode ini digunakan untuk mengembalikan hasil $res
    }

   public function tambahStock($qty,$id,$sign,$note,$date,$keterangan,$no_hp){
       $array = array(	'id' => $id,
       					'qty_in' => $qty,
       					'sign' => $sign,
       					'note' => $note,
       					'tanggal' => $date,
       					'keterangan' => $keterangan,
       					'no_hp' => $no_hp

   						);
       $data = $this->db->query("CALL `SPTambahStock`(?,?,?,?,?,?,?)",$array);
       return $data;
       /*$this->db->trans_start();
       $a = $this->db->query("select qty from master_barang where id_barang=$id");
		
		foreach ($a->result() as $data) {
			$stock_before = $data->qty;
		}
		$this->db->query("update master_barang SET qty=(qty+$qty) where id_barang=$id and deleted='0'");
		
		$b = $this->db->query("select qty from master_barang where id_barang=$id");
		
		foreach ($b->result() as $data) {
			$on_stock = $data->qty;
		}

		$this->db->query("insert into transaksi_stock (id_barang, in_stock, on_stock, stock_before, sign, notes, keterangan, created_time, created_by) VALUES ($id, $qty, $on_stock, $stock_before, '$sign', '$note', '$keterangan','$date' ,'$no_hp')");
		//$this->db->query('AND YET ANOTHER QUERY...');
		return $this->db->trans_complete(); */
        
  }

  public function kurangStock($qty,$id,$sign,$note,$date,$keterangan,$no_hp){
        $array = array(	'id' => $id,
       					'qty_out' => $qty,
       					'sign' => $sign,
       					'note' => $note,
       					'tanggal' => $date,
       					'keterangan' => $keterangan,
       					'no_hp' => $no_hp

   						);
       $data = $this->db->query("CALL `SPKurangStock`(?,?,?,?,?,?,?)",$array);
       return $data;
        /*$this->db->trans_start();
       $a = $this->db->query("select qty from master_barang where id_barang=$id");
		
		foreach ($a->result() as $data) {
			$stock_before = $data->qty;
		}
		$this->db->query("update master_barang SET qty=(qty-$qty) where id_barang=$id and deleted='0'");
		
		$b = $this->db->query("select qty from master_barang where id_barang=$id");
		
		foreach ($b->result() as $data) {
			$on_stock = $data->qty;
		}

		$this->db->query("insert into transaksi_stock (id_barang, out_stock, on_stock, stock_before, sign, notes, keterangan, created_time, created_by) VALUES ($id, $qty, $on_stock, $stock_before, '$sign', '$note', '$keterangan','$date' ,'$no_hp')");
		//$this->db->query('AND YET ANOTHER QUERY...');
		return $this->db->trans_complete(); */
        
  }

    public function kode_otomatis($kode){
    	$query = $this->db->query("select max(id_anggota) as kode from anggota where id_anggota like'%$kode%'");
    	
    	   foreach ($query->result() as $data) {
    			$kode_otomatis = $data->kode;
    			 $nilaikode = substr($kode_otomatis, 8);
				   // menjadikan $nilaikode ( int )
				   $kode_auto = (int) $nilaikode;
				   // setiap $kode di tambah 1
				   $kode_auto = $kode_auto + 1;
				   $kode_otomatis = $kode.str_pad($kode_auto, 2, "0", STR_PAD_LEFT);
				  
    		}
    	

    	/*if($query->num_rows() < 1){
    		$kode_otomatis = $kode.'01';
    	} else {
    		foreach ($query->result() as $data) {
    			$kode_otomatis = $data->kode;
    			 $nilaikode = substr($kode_otomatis[0], 8);
				   // menjadikan $nilaikode ( int )
				   $kode_auto = (int) $nilaikode;
				   // setiap $kode di tambah 1
				   $kode_auto = $kode_auto + 1;
				   $kode_otomatis = $kode_otomatis.str_pad($kode, 2, "0", STR_PAD_LEFT);
    		}
    	}*/

    	return $kode_otomatis;
    }
    
    


}


