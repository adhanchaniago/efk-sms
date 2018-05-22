<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once APPPATH.'../config/smsGateway.php'

// ============== berikut beberapa perbandingan SMS Gateway (jika sistem reminder membutuhkan SMS, karena saat ini yang digunakan dengan menggunakan Email) =========
//fungsi smsgateway ada 2 sumber :
// 1. dari smsgateway.me, cara kerjanya adalah hp kamu jadi gateway nya, cara kirim sms haru menggunakan
// applikasi "sms gateway API", diunduh di google
// 2. dari raja-sms.com, cara kerjanya adalah kita memanggil URL API yang diberikan raja-sms, raja-sms sebagai gateway nya
// kelebihan : 1. smsgateway.me lebih murah karena kita bisa membeli paket sms dengan menggunakan nomor
// hp sendiri.
// 2. raja-sms sangat mudah digunakan karena kita tidak perlu membuka aplikasi di hp kita
// kekurangan : 1. smsgateway.me sedikit rumit karena kita harus mendownload applikasi di playsrote,
// dan harus membuka aplikasi tersebut utk mengirim sms yang telah di list oleh API nya.
// 2. raja-sms sedikit mahal

//fungsi API smsgateway : send(), send_many_selasa(), send_many_sabtu()
//fungsi API raja-sms : send1()

class SmsGateway_C extends CI_Controller {
 static $baseUrl = "https://smsgateway.me";
  public function __construct(){
    parent::__construct();
    $this->load->model('SmsGateway_M');
    //$this->load->model('Sendmails_M');
  }


        public function hari(){
          return date('l');
        }


      public function tanggal_indo($tanggal, $cetak_hari = false) {
            $hari = array ( 1 =>    'Senin',
                  'Selasa',
                  'Rabu',
                  'Kamis',
                  'Jumat',
                  'Sabtu',
                  'Minggu'
                );
      
            $bulan = array (1 =>   'Januari',
                  'Februari',
                  'Maret',
                  'April',
                  'Mei',
                  'Juni',
                  'Juli',
                  'Agustus',
                  'September',
                  'Oktober',
                  'November',
                  'Desember'
                );
            $split    = explode('-', $tanggal);
            $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
            
            if ($cetak_hari) {
              $num = date('N', strtotime($tanggal));
              return $hari[$num] . ', ' . $tgl_indo;
            }
            return $tgl_indo;
          }

          public function send(){
   // date_default_timezone_set('Asia/Jakarta');
          $tanggal1 = date("Y-m-d H:i:s");
          $tanggal2 = date('Y-m-d', strtotime($tanggal1));
          $date = $this->tanggal_indo($tanggal2, true);
          $deviceID = 83493;
          $number = '+6289687610639';
          $message = '[Test SMS Gateway] Halo Bernand , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';

          /*$options = [
          'send_at' => strtotime('+12 hours +1 minutes'), // Send the message in 10 minutes
          'expires_at' => strtotime('+8 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];*/

            $options = [
            'send_at' => '', // Send the message in 10 minutes
            'expires_at' => strtotime('+2 days') // Cancel the message in 1 hour if the message is not yet sent
            ];

          //Please note options is no required and can be left out
          $result = $this->sendMessageToNumber($number, $message, $deviceID, $options);

          //echo $result;
            }

   public function send_many_selasa(){
          $cekhari = $this->hari();
          $ceklatihan = $this->Sendmails_M->cekModul('1');
          if($cekhari !='Tuesday'){
            echo 'fungsi ini hanya bisa dijalankan di hari selasa';
          } else {

          //date_default_timezone_set('Asia/Jakarta');
          $tanggal1 = date("Y-m-d H:i:s");
          $tanggal2 = date('Y-m-d', strtotime($tanggal1));
          $date = $this->tanggal_indo($tanggal2, true);
          //$kontak = $this->list_nohp();
          $deviceID = 83493;
          $contact = $this->SmsGateway_M->list_contact();

          foreach($contact->result() as $data){
              
              /*$end = end($data->no_hp);
              if($end){
                  echo $end;
              } */

          $number = $data->no_hp;
          $nama = $data->nama_anggota;

          if($ceklatihan !='Yes'){
            $text = '[Reminder] Halo '.$nama.' , Hari ini : '.$date.' latihan DI LIBURKAN';
          } else {
            $text = '[Reminder] Halo '.$nama.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';
          }

          $message = $text;

          /*$options = [
          'send_at' => strtotime('+12 hours +1 minutes'), // Send the message in 10 minutes
          'expires_at' => strtotime('+8 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];*/

          $options = [
          'send_at' => '', // Send the message in 10 minutes
          'expires_at' => strtotime('+2 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];


          //Please note options is no required and can be left out
          $result = $this->sendMessageToNumber($number, $message, $deviceID, $options);
          }

          //luar
          $contact1 = $this->SmsGateway_M->list_contact_luar();

          foreach($contact1->result() as $data1){
              
              /*$end = end($data->no_hp);
              if($end){
                  echo $end;
              } */

          $number1 = $data1->no_hp;
          $nama1 = $data1->nama_anggota;

          if($ceklatihan !='Yes'){
            $text1 = '[Reminder] Halo '.$nama1.' , Hari ini : '.$date.' latihan DI LIBURKAN';
          } else {
            $text1 = '[Reminder] Halo '.$nama1.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';
          }

          $message1 = $text1;

          /*$options = [
          'send_at' => strtotime('+12 hours +1 minutes'), // Send the message in 10 minutes
          'expires_at' => strtotime('+8 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];*/

          $options1 = [
          'send_at' => '', // Send the message in 10 minutes
          'expires_at' => strtotime('+2 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];


          //Please note options is no required and can be left out
          $result1 = $this->sendMessageToNumber($number1, $message1, $deviceID, $options1);
          }
          //endluar
          }


        //echo $result;
          }

        public function send_many_sabtu(){
            $cekhari = $this->hari();
          $ceklatihan = $this->Sendmails_M->cekModul('1');
          if($cekhari !='Saturday'){
            echo 'fungsi ini hanya bisa dijalankan di hari sabtu';
          } else {

          //date_default_timezone_set('Asia/Jakarta');
          $tanggal1 = date("Y-m-d H:i:s");
          $tanggal2 = date('Y-m-d', strtotime($tanggal1));
          $date = $this->tanggal_indo($tanggal2, true);
          //$kontak = $this->list_nohp();
          $deviceID = 83493;
          $contact = $this->SmsGateway_M->list_contact();

          foreach($contact->result() as $data){
              
              /*$end = end($data->no_hp);
              if($end){
                  echo $end;
              } */

          $number = $data->no_hp;
          $nama = $data->nama_anggota;

           if($ceklatihan !='Yes'){
            $text = '[Reminder] Halo '.$nama.' , Hari ini : '.$date.' latihan DI LIBURKAN';
          } else {
            $text = '[Reminder] Halo '.$nama.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';
          }

          $message = $text;

          /*$options = [
          'send_at' => strtotime('+12 hours +1 minutes'), // Send the message in 10 minutes
          'expires_at' => strtotime('+8 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];*/

          $options = [
          'send_at' => '', // Send the message in 10 minutes
          'expires_at' => strtotime('+2 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];


          //Please note options is no required and can be left out
          $result = $this->sendMessageToNumber($number, $message, $deviceID, $options);
          }

          //luar
          $contact1 = $this->SmsGateway_M->list_contact_luar();

          foreach($contact1->result() as $data1){
              
              /*$end = end($data->no_hp);
              if($end){
                  echo $end;
              } */

          $number1 = $data1->no_hp;
          $nama1 = $data1->nama_anggota;

          if($ceklatihan !='Yes'){
            $text1 = '[Reminder] Halo '.$nama1.' , Hari ini : '.$date.' latihan DI LIBURKAN';
          } else {
            $text1 = '[Reminder] Halo '.$nama1.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';
          }

          $message1 = $text1;

          /*$options = [
          'send_at' => strtotime('+12 hours +1 minutes'), // Send the message in 10 minutes
          'expires_at' => strtotime('+8 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];*/

          $options1 = [
          'send_at' => '', // Send the message in 10 minutes
          'expires_at' => strtotime('+2 hours') // Cancel the message in 1 hour if the message is not yet sent
          ];


          //Please note options is no required and can be left out
          $result1 = $this->sendMessageToNumber($number1, $message1, $deviceID, $options1);
          }
          //endluar
          }


          //echo $result;
            }

  public function add_contact(){
    //

    $contact = $this->SmsGateway_M->list_contact();

    foreach($contact->result() as $data){
        $result = $this->createContact($data->nama_anggota, $data->no_hp);
    }
  }

   public function list_nohp(){
    //

    $contact = $this->SmsGateway_M->list_contact();

    foreach($contact->result() as $data){
        return $data->no_hp.", ";
        /*$end = end($data->no_hp);
        if($end){
            echo $end;
        } */
    }
  }

    function createContact ($name,$number) {
            return $this->makeRequest('/api/v3/contacts/create','POST',['name' => $name, 'number' => $number]);
        }

  public function sendMessageToNumber($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST',$query);
        }

       public function sendMessageToManyNumbers ($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        public function makeRequest ($url, $method, $fields=[]) {

            $fields['email'] = 'bernandotorrez4@gmail.com';
            $fields['password'] = 'B3rnando';

            $url = "https://smsgateway.me".$url;

            $fieldsString = http_build_query($fields);


            $ch = curl_init();

            if($method == 'POST')
            {
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
            }
            else
            {
                $url .= '?'.$fieldsString;
            }

            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HEADER , false);  // we want headers
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $result = curl_exec ($ch);

            $return['response'] = json_decode($result,true);

            if($return['response'] == false)
                $return['response'] = $result;

            $return['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close ($ch);

            echo "<pre>";
            print_r($return);
            echo "</pre>";
        }

    public function send1(){
       $cekhari = $this->hari();
       if($cekhari !='Saturday'){
          echo 'fungsi ini hanya bisa dijalankan di hari sabtu';
        } else {
      $apikey      = 'dd4cd8e78a5c5ac8683262e6242428d8'; // api key 
      $ipserver    = 'http://45.32.118.255'; // url server sms 
      $callbackurl = 'https://jujitsu-upn.online/SmsGateway/send1'; // url callback get status sms 

      // create header json  
      $senddata = array(
        'apikey' => $apikey,  
        'callbackurl' => $callbackurl, 
        'datapacket'=>array()
      );

    // create detail data json 
    // data 1
      $contact = $this->SmsGateway_M->list_contact();
      $tanggal1 = date("Y-m-d H:i:s");
      $tanggal2 = date('Y-m-d', strtotime($tanggal1));
      $date = $this->tanggal_indo($tanggal2, true);
      foreach($contact->result() as $data){
      //$number = $data->no_hp;
      //$nama = $data->nama_anggota;
      //$message = '[Test SMS Gateway] Halo '.$nama.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';
      $number1=$data->no_hp;
      $message1='[Test SMS Gateway 2] Halo '.$data->nama_anggota.' , Hari ini : '.$date.' akan diadakan latihan, jangan lupa latihan yah!';;
      $sendingdatetime1 =""; 
      array_push($senddata['datapacket'],array(
        'number' => trim($number1),
        'message' => urlencode(stripslashes(utf8_encode($message1))),
        'sendingdatetime' => $sendingdatetime1));
  
        // data 2
        /*$number2='081xxx';
        $message2='Message 2';
        $sendingdatetime2 ="2017-01-01 23:59:59";
        array_push($senddata['datapacket'],array(
          'number' => trim($number2),
          'message' => urlencode(stripslashes(utf8_encode($message2))),
          'sendingdatetime' => $sendingdatetime2));*/
          
        // class sms 
        //$sms = new sms_class_reguler_json();
        //$sms->setIp($ipserver);
        //$sms->setData($senddata);
        $responjson = $this->set_send($senddata, $ipserver);
        header('Content-Type: application/json');
        //echo $responjson;
        //echo "<pre>";
            print_r($responjson);
            //echo "</pre>";
        }
      }
    }

    public function set_send($data, $smsserverip){
        $dt=json_encode($data);
        $curlHandle = curl_init($smsserverip."/sms/api_sms_reguler_send_json.php");
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $dt);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($dt))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $hasil = curl_exec($curlHandle);
        $curl_errno = curl_errno($curlHandle);
        $curl_error = curl_error($curlHandle);  
        $http_code  = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);
        if ($curl_errno > 0) {
          $senddata = array(
          'sending_respon'=>array(
            'globalstatus' => 90, 
            'globalstatustext' => $curl_errno."|".$http_code)
          );
          $hasil=json_encode($senddata);
        } else {
          if ($http_code<>"200") {
          $senddata = array(
          'sending_respon'=>array(
            'globalstatus' => 90, 
            'globalstatustext' => $curl_errno."|".$http_code)
          );
          $hasil= json_encode($senddata); 
          } 
        }
        return $hasil;  
        }


   
}