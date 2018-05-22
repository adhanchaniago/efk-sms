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
        $query = $this->db->get();
        $data = $query->result();
        return json_encode($data);
    }


    public function listDataKategori(){
        $this->db->where('deleted', '0');
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

  public function cekID(){
    $this->db->select("id_kegiatan");
    //$this->db->where('status_pendaftaran','1');
    $this->db->order_by("id_kegiatan",'ASC');
    $query=$this->db->get("kegiatan");
    //$jumlah = $query->num_rows();

    foreach ($query->result() as $key) {
        $fetch = $key->id_kegiatan;
    }

    if($query->num_rows() == 0) {
        $id = 1;
    } else {
        $id = $fetch+1;
    }
        return $id;
  }

  public function cekDataFormulir($search){   
     $this->db->select('nim');
        $this->db->from('anggota');
        $this->db->where('nim =',$search);
        $this->db->or_where('no_hp =',$search);
        $query = $this->db->get();
        $jumlah = $query->num_rows();
        return $jumlah;

  }
    
    public function getDataRefCode($value){
       /*$this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,j.nama_jurusan,f.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where($where);
        $this->db->limit(1);*/
        $data1 = array('get_ref' => $value);
        $query = $this->db->query("CALL `SPGetDataAnggotaByRefCodeToApproval`(?)",$data1);
        //$result = $data->result();
        //$query = $this->db->get();
        $cek = $query->num_rows();
        if($cek > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'save');
        }
    } else {
        $data = array(  
                            'status' => 'failed'
                            );
    }

        
        echo json_encode($data);
  }

  //luar
  public function getDataRefCodeLuar($value){
       /*$this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,a.nama_jurusan,a.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
        //$this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where($where);
        $this->db->limit(1);*/
         $data1 = array('get_ref' => $value);
        $query = $this->db->query("CALL `SPGetDataAnggotaByRefCodeToApprovalLuar`(?)",$data1);
        //$query = $this->db->get();
        $cek = $query->num_rows();
        if($cek > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'save');
        }
    } else {
        $data = array(  
                            'status' => 'failed'
                            );
    }

        
        echo json_encode($data);
  }
  //end luar

  public function getDataCetakFormulir($search){
       /*$this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,j.nama_jurusan,f.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where('a.nim =', $search);
        $this->db->or_where('l.no_hp =', $search);
        //$this->db->or_where('l.no_hp =',$search);
        //$this->db->or_where($where2);
        $this->db->limit(1);
        $query = $this->db->get();*/

        $data1 = array(  'get_nim' => $search,
                        'get_no_hp' => $search
                    );
        $query = $this->db->query("CALL `SPGetDataAnggotaForCetakFormulir`(?,?)",$data1);

        if($query->num_rows() > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'print');
        }
    } else {
        $data = array(  
                            'status' => 'failed',
                            'button' => 'failed'
                            );
    }

        
        echo json_encode($data);
  }

  //luar
  public function getDataCetakFormulirLuar($search){
      /* $this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,a.nama_jurusan,a.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
        //$this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where('a.nim =', $search);
        $this->db->or_where('l.no_hp =', $search);
        //$this->db->or_where('l.no_hp =',$search);
        //$this->db->or_where($where2);
        $this->db->limit(1);
        $query = $this->db->get();*/

        $data1 = array(  'get_nim' => $search,
                        'get_no_hp' => $search
                    );
        $query = $this->db->query("CALL `SPGetDataAnggotaForCetakFormulirLuar`(?,?)",$data1);

        if($query->num_rows() > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'print');
        }
    } else {
        $data = array(  
                            'status' => 'failed',
                            'button' => 'failed'
                            );
    }

        
        echo json_encode($data);
  }
  //end luar

  //luar
  public function getDataCetakFormulir1Luar($search){
       /*$this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,a.nama_jurusan,a.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
        //$this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where('a.nim =', $search);
        $this->db->or_where('l.no_hp =', $search);
        //$this->db->or_where('l.no_hp =',$search);
        //$this->db->or_where($where2);
        $this->db->limit(1);
        $query = $this->db->get();*/

        $data1 = array(  'get_nim' => $search,
                        'get_no_hp' => $search
                    );
        $query = $this->db->query("CALL `SPGetDataAnggotaForCetakFormulirLuar`(?,?)",$data1);

        if($query->num_rows() > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'print');
        }
    } else {
        $data = array(  
                            'status' => 'failed',
                            'button' => 'failed'
                            );
    }

        
        return $data;
  }
  //end luar


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

  public function change_approval($no_hp){   
    $data = array(
        'status_pendaftaran' => '1'
);
        $this->db->where('no_hp', $no_hp);
        $query = $this->db->update('anggota', $data);

        if($query){
            echo "OK";
        } else {
            echo "NO";
        }
  }

  //luar
  public function change_approval_luar($no_hp){   
    $data = array(
        'status_pendaftaran' => '1'
);
        $this->db->where('no_hp', $no_hp);
        $query = $this->db->update('anggota_luar', $data);

        if($query){
            echo "OK";
        } else {
            echo "NO";
        }
  }
  //end luar

  public function getAllDataAnggota(){
       $this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,j.nama_jurusan,f.nama_fakultas,a.status_pendaftaran, a.diksar, a.poj');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where($where);
        //$this->db->limit(1);
        $query = $this->db->get();

        //$query = $this->db->query("CALL `SPGetAllDataAnggota`()");

    
        
        return json_encode($query->result());
  }

  public function getAllDataAnggotaLuar(){
       $this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,a.nama_jurusan,a.nama_fakultas,a.status_pendaftaran, a.diksar, a.poj');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
        //$this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where($where);
        //$this->db->limit(1);
        $query = $this->db->get();

        //$query = $this->db->query("CALL `SPGetAllDataAnggotaLuar`()");
    
        
        return json_encode($query->result());
  }

  public function getAllDataReminderno_hp(){
        $this->db->select('l.no_hp,a.nim,a.nama_anggota,j.nama_jurusan,f.nama_fakultas,a.notif_no_hp');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where('reminder');
        //$this->db->limit(1);
        $query = $this->db->get();
        return json_encode($query->result());
  }

   public function getAllDataReminderno_hpLuar(){
        $this->db->select('l.no_hp,a.nim,a.nama_anggota,a.nama_jurusan,a.nama_fakultas,a.notif_no_hp');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
        //$this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where('reminder');
        //$this->db->limit(1);
        $query = $this->db->get();
        return json_encode($query->result());
  }

  public function getAllDataReminderSms(){
        $this->db->select('l.no_hp,a.nim,a.nama_anggota,j.nama_jurusan,f.nama_fakultas,a.notif_sms,a.no_hp');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where('reminder');
        //$this->db->limit(1);
        $query = $this->db->get();
        return json_encode($query->result());
  }

  //luar
   public function getAllDataReminderSmsLuar(){
        $this->db->select('l.no_hp,a.nim,a.nama_anggota,a.nama_jurusan,a.nama_fakultas,a.notif_sms,a.no_hp');
        $this->db->from('login l');
        $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
       // $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        //$this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        //$this->db->where('reminder');
        //$this->db->limit(1);
        $query = $this->db->get();
        return json_encode($query->result());
  }
  //endluar

  public function getDoneApprovalNumber(){
    $this->db->select('l.no_hp');
    $this->db->from('login l');
    $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('a.status_pendaftaran','1');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function getNotApprovalNumber(){
    $this->db->select('l.no_hp');
    $this->db->from('login l');
    $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('a.status_pendaftaran','0');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function getNotApprovalNumberLuar(){
    $this->db->select('l.no_hp');
    $this->db->from('login l');
    $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('a.status_pendaftaran','0');
    $query = $this->db->get();
    return $query->num_rows();
  }


  public function getNotApprovalData(){
    $this->db->select('l.no_hp, a.nama_anggota, a.referral_code, a.foto');
    $this->db->from('login l');
    $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('a.status_pendaftaran','0');
    $query = $this->db->get();

    return json_encode($query->result());
  }

  public function getNotApprovalDataLuar(){
    $this->db->select('l.no_hp, a.nama_anggota, a.referral_code, a.foto');
    $this->db->from('login l');
    $this->db->join('anggota_luar a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('a.status_pendaftaran','0');
    $query = $this->db->get();

    return json_encode($query->result());
  }

  public function getNotifDatano_hp($no_hp){
    $this->db->select('notif_no_hp');
    $this->db->from('anggota');
    //$this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('no_hp',$no_hp);
    $this->db->limit(1);
    $query = $this->db->get();
    foreach ($query->result() as $data) {
        $notif_no_hp = $data->notif_no_hp;
    }
    return $notif_no_hp;
  }

  //luar
  public function getNotifDatano_hpLuar($no_hp){
    $this->db->select('notif_no_hp');
    $this->db->from('anggota_luar');
    //$this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('no_hp',$no_hp);
    $this->db->limit(1);
    $query = $this->db->get();
    foreach ($query->result() as $data) {
        $notif_no_hp = $data->notif_no_hp;
    }
    return $notif_no_hp;
  }
  //end luar

  public function getNotifDataSms($no_hp){
    $this->db->select('notif_sms');
    $this->db->from('anggota');
    //$this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('no_hp',$no_hp);
    $this->db->limit(1);
    $query = $this->db->get();
    foreach ($query->result() as $data) {
        $notif_sms = $data->notif_sms;
    }
    return $notif_sms;
  }

  //luar
  public function getNotifDataSmsLuar($no_hp){
    $this->db->select('notif_sms');
    $this->db->from('anggota_luar');
    //$this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('no_hp',$no_hp);
    $this->db->limit(1);
    $query = $this->db->get();
    foreach ($query->result() as $data) {
        $notif_sms = $data->notif_sms;
    }
    return $notif_sms;
  }
  //end luar

   public function getDataPesan($id){
    $this->db->select('*');
    $this->db->from('pesan');
    //$this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
    $this->db->where('id_pesan',$id);
    $this->db->limit(1);
    $query = $this->db->get();
    
    return json_encode($query->result());
  }

  public function UpdateNotifData($no_hp, $where){
      $this->db->where('no_hp',$where); // Kode ini digunakan untuk mengupdate record dari sebuah tabel
      $this->db->update('anggota', $no_hp);

      return true;
    }

    //luar
    public function UpdateNotifDataLuar($no_hp, $where){
      $this->db->where('no_hp',$where); // Kode ini digunakan untuk mengupdate record dari sebuah tabel
      $this->db->update('anggota_luar', $no_hp);

      return true;
    }
    //endluar

    public function UpdateBalasPesan($id, $where){
      $this->db->where('id_pesan',$where); // Kode ini digunakan untuk mengupdate record dari sebuah tabel
      $this->db->update('pesan', $id);

      return true;
    }

    public function getAllDataPesan(){
        $query = $this->db->get('pesan');

        return json_encode($query->result());

    }

     public function getAllDataSaran(){
        $query = $this->db->get('saran');

        return json_encode($query->result());

    }

    public function getDataCetakFormulir1($search){
       /*$this->db->select('l.no_hp,l.level,l.login_time,l.logout_time,a.nim,a.nama_anggota,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.no_hp,a.angkatan_kuliah,a.angkatan_jujitsu,a.foto,a.line,a.whatsapp,a.alamat,a.referral_code,j.nama_jurusan,f.nama_fakultas,a.status_pendaftaran');
        $this->db->from('login l');
        $this->db->join('anggota a', 'a.no_hp=l.no_hp', 'inner');
        $this->db->join('jurusan j', 'a.id_jurusan=j.id_jurusan', 'inner');
        $this->db->join('fakultas f', 'f.id_fakultas=j.id_fakultas', 'inner');
        $this->db->where('a.nim =', $search);
        $this->db->or_where('l.no_hp =', $search);
        //$this->db->or_where('l.no_hp =',$search);
        //$this->db->or_where($where2);
        $this->db->limit(1);
        $query = $this->db->get();*/

        $data1 = array(  'get_nim' => $search,
                        'get_no_hp' => $search
                    );
        $query = $this->db->query("CALL `SPGetDataAnggotaForCetakFormulir`(?,?)",$data1);


        if($query->num_rows() > 0){
            foreach ($query->result() as $data) {
            $data = array(  'no_hp' => $data->no_hp,
                            'nim' => $data->nim,
                            'nama' => $data->nama_anggota,
                            'jenis_kelamin' => $data->jenis_kelamin,
                            'no_hp' => $data->no_hp,
                            'whatsapp' => $data->whatsapp,
                            'line' => $data->line,
                            'ref_code' => $data->referral_code,
                            'tempat_lahir' => $data->tempat_lahir,
                            'tanggal_lahir' => tanggal($data->tanggal_lahir),
                            'fakultas' => $data->nama_fakultas,
                            'jurusan' => $data->nama_jurusan,
                            'angkatan_kuliah' => $data->angkatan_kuliah,
                            'angkatan_jujitsu' => $data->angkatan_jujitsu,
                            'alamat' => $data->alamat,
                            'foto' => $data->foto,
                            'status_pendaftaran' => $data->status_pendaftaran,
                            'status' => 'success',
                            'button' => 'print');
        }
    } else {
        $data = array(  
                            'status' => 'failed',
                            'button' => 'failed'
                            );
    }

        
        return $data;
  }

  public function Insert($table,$data){
        $insert = $this->db->insert($table, $data); // Kode ini digunakan untuk memasukan record baru kedalam sebuah tabel
        return $insert; // Kode ini digunakan untuk mengembalikan hasil $res
    }

}