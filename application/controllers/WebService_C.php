<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

Class WebService_C extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('WebService_M');
                
    }

    public function getWSREPORT(){
        /*================ Fungsi untuk memanggil WebService REPORT ================*/

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
       $url = URL_WS_ERTRACKING; 

        $post_string = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsGetDataHQ>
         <requestinsertgerdetail>
            <INSERT_DATE>'.$tgl_awal.'</INSERT_DATE>
            <INSERT_DATE2>'.$tgl_akhir.'</INSERT_DATE2>
         </requestinsertgerdetail>
      </com:fsGetDataHQ>
   </soapenv:Body>
</soapenv:Envelope>';

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $result    = curl_exec($soap_do);
        $err       = curl_error($soap_do);

        $replace   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xml = str_ireplace($replace, '', $result);

        $xml       = simplexml_load_string($clean_xml);

        $data_wdsl = json_encode($xml->Body->fsGetDataHQResponse);     
     
        $Proses1   = json_decode($data_wdsl, TRUE);
        $Proses2   = json_encode($Proses1["requestGETdetail"]); 
        $jsonString = str_replace('ArrayData',"data",$Proses2);
        $WSDL      = json_decode($jsonString,TRUE);


         $PR_NUMBER = $WSDL['PR_NUMBER']; 
        $ER_NUMBER = $WSDL['ER_NUMBER']; 
        $PERIODE                   = substr($WSDL['PERIODE'],0,10);
        $TANGGAL_INCOMING          = substr($WSDL['TANGGAL_INCOMING'],0,10);
        $TANGGAL_PROSES_CHECKER    = substr($WSDL['TANGGAL_PROSES_CHECKER'],0,10);
        $TANGGAL_INCOMING_FINANCE  = substr($WSDL['TANGGAL_INCOMING_FINANCE'],0,10);
         $INSERT_DATE  = substr($WSDL['INSERT_DATE'],0,10);
         $APPROVER_DATE  = substr($WSDL['APPROVER_DATE'],0,10);
         $callback = array(
                   'status'     => 'success', 
                    'txt_prnumber'      => $WSDL['PR_NUMBER'], 
                     
                    'txt_ernumber'        => $WSDL['ER_NUMBER'],
                    'txt_validator1'      => $WSDL['VALIDATOR'],
                    'txt_validator2'      => $WSDL['VALIDATOR2'],
                    'txt_checker'      => $WSDL['CHECKER'],
                    'txt_kodecabang'      => $WSDL['KODECABANG'],
                    'txt_cabang'      => $WSDL['DEPARTEMENT'], 
                     
                    'txt_tipeer'        => $WSDL['TIPE_ER'],
                    'txt_periode'      => $PERIODE,
                    'txt_ti'      => $TANGGAL_INCOMING,
                    'txt_tps'      => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL['STATUS'],

                    'txt_remarks'        => $WSDL['TIPE_ER'],
                    'txt_tif'      => $TANGGAL_INCOMING_FINANCE,
                    'txt_active'      => $WSDL['ACTIVE'],
                    'txt_insertdate'      => $INSERT_DATE,
                    'txt_tipeerpr'      => $WSDL['TYPE_PR_ER_NUMBER'],

                    'txt_appdate'        => $APPROVER_DATE,
                    'txt_nameapp'      => $WSDL['NAME_OF_APPROVERD'],
                    'txt_slapr'      => $WSDL['SLA_PR'],
                    'txt_slapo'      => $WSDL['SLA_PO'],
                    'txt_slaerdate'      => $WSDL['SLA_ER_DATE'],

                     'txt_slakirim'        => $WSDL['SLA_KIRIM'],
                    'txt_slacabang'      => $WSDL['SLA_CABANG'],
                    'txt_acct'      => $WSDL['ACCT'],
                    'txt_slafin'      => $WSDL['SLA_FIN'],
                    'txt_slahq'      => $WSDL['SLA_HQ']
                    
                     

                );
 
echo json_encode($WSDL);  
        // $PRDATE=$WSDL['pr_date'];
/*================ Fungsi untuk memanggil WebService REPORT ================*/
       
    }

    public function updateSharePointHQ(){
        /*================ Fungsi untuk memanggil WebService UpdateDataSharePointHQ ================*/

        $type               = $this->input->post('type');
$types              = $this->input->post('types');

$cek = $this->input->post('txt_tipeermb');
    $cek1 = $this->input->post('txt_tipeerpr');

   
    if($cek == 'MultiBranch' OR $cek1 == 'MultiBranch'){
        $mb = 'mb';
    } else {
        $mb = '';
    }
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

$PR_NUMBER                  = $this->input->post('txt_nopr'.$mb);
$ER_NUMBER                  = $this->input->post('txt_noer'.$mb);

$SLAPR                  = $this->input->post('txt_slapr'.$mb);
$SLAPO                  = $this->input->post('txt_slapo'.$mb);
$SLAERDATE              = $this->input->post('txt_slaerdate'.$mb);
$SLAKIRIM               = $this->input->post('txt_slakirim'.$mb);
$SLACABANG              = $this->input->post('txt_slacabang'.$mb);
$ACCT                   = $this->input->post('txt_acct'.$mb);
$SLAFIN                 = $this->input->post('txt_slafin'.$mb);
$SLAHQ                  = $this->input->post('txt_slahq'.$mb);
$INVOICENO          = $this->input->post('txt_inv'.$mb);

if($type=='aktif'){
    $VALIDATOR1                 = ucwords($this->input->post('txt_validator1'.$mb));
$VALIDATOR2                 = ucwords($this->input->post('txt_validator2'.$mb));
$CHECKER                    = ucwords($this->input->post('txt_checker'.$mb));
$KODECABANG                 = $this->input->post('htxt_branchid'.$mb);
$CABANG                     = $this->input->post('txt_dep'.$mb);
$TIPE_ER                  = $this->input->post('txt_tipeer'.$mb);
$PERIODE                    = $this->input->post('txt_periode'.$mb);
$TANGGAL_INCOMING           = $this->input->post('txt_ti'.$mb);
$TANGGAL_PROSES_CHECKER     = $this->input->post('txt_tpc').$mb;
$STATUS                     = $this->input->post('txt_status'.$mb);
$REMARKS                    = ucwords($this->input->post('txt_remarks'.$mb));
$TANGGAL_INCOMING_FINANCE   = $this->input->post('txt_tif'.$mb);
$TYPE_PR_ER_NUMBER          = $this->input->post('txt_tipeerpr'.$mb);
$APPROVER_DATE              = $this->input->post('txt_appdate'.$mb);
//$APPROVER_DATE                = date();
$NAME_OF_APPROVERD          = $this->input->post('txt_nameapp'.$mb);

} elseif($type=='nonaktif'){
        $VALIDATOR1                 = ucwords($this->input->post('htxt_validator1'.$mb));
$VALIDATOR2                 = ucwords($this->input->post('htxt_validator2'.$mb));
$CHECKER                    = ucwords($this->input->post('htxt_checker'.$mb));
$KODECABANG                 = $this->input->post('htxt_branchid'.$mb);
$CABANG                     = $this->input->post('htxt_dep'.$mb);
$TIPE_ER                    = $this->input->post('htxt_tipeer'.$mb);
$PERIODE                    = $this->input->post('htxt_periode'.$mb);
$TANGGAL_INCOMING           = $this->input->post('htxt_ti'.$mb);
$TANGGAL_PROSES_CHECKER     = $this->input->post('htxt_tpc'.$mb);
$STATUS                     = $this->input->post('htxt_status'.$mb);
$REMARKS                    = ucwords($this->input->post('htxt_remarks'.$mb));
$TANGGAL_INCOMING_FINANCE   = $this->input->post('htxt_tif'.$mb);
$TYPE_PR_ER_NUMBER          = $this->input->post('htxt_tipeerpr'.$mb);
$APPROVER_DATE              = $this->input->post('htxt_appdate'.$mb);
//$APPROVER_DATE                = date();
$NAME_OF_APPROVERD          = $this->input->post('txt_nameapp'.$mb);

} else {
        $VALIDATOR1         = ucwords($this->input->post('txt_validator1'.$mb));
$VALIDATOR2                 = ucwords($this->input->post('txt_validator2'.$mb));
$CHECKER                    = ucwords($this->input->post('txt_checker'.$mb));
$KODECABANG                 = $this->input->post('htxt_branchid'.$mb);
$CABANG                     = $this->input->post('txt_dep'.$mb);
$TIPE_ER                  = $this->input->post('txt_tipeer'.$mb);
$PERIODE                    = $this->input->post('txt_periode'.$mb);
$TANGGAL_INCOMING           = $this->input->post('txt_ti'.$mb);
$TANGGAL_PROSES_CHECKER     = $this->input->post('txt_tpc'.$mb);
$STATUS                     = $this->input->post('txt_status'.$mb);
$REMARKS                    = ucwords($this->input->post('txt_remarks'.$mb));
$TANGGAL_INCOMING_FINANCE   = $this->input->post('txt_tif'.$mb);
$TYPE_PR_ER_NUMBER          = $this->input->post('txt_tipeerpr'.$mb);
$APPROVER_DATE              = $this->input->post('htxt_appdate'.$mb);
//$APPROVER_DATE                = date();
$NAME_OF_APPROVERD          = $this->input->post('txt_nameapp'.$mb);
}


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



if(empty($PERIODE)){
    $PERIODE = "";
} else{
    $PERIODE                  = str_replace("/", "-", $PERIODE);
}
if(empty($TANGGAL_INCOMING)){
    $TANGGAL_INCOMING = "";
} else {
    $TANGGAL_INCOMING         = str_replace("/", "-", $TANGGAL_INCOMING);
}
if(empty($TANGGAL_PROSES_CHECKER)){
    $TANGGAL_PROSES_CHECKER = "";
} else{
    $TANGGAL_PROSES_CHECKER   = str_replace("/", "-", $TANGGAL_PROSES_CHECKER);
}
if(empty($TANGGAL_INCOMING_FINANCE)){
    $TANGGAL_INCOMING_FINANCE = "";
} else {
    $TANGGAL_INCOMING_FINANCE = str_replace("/", "-", $TANGGAL_INCOMING_FINANCE);
}
if(empty($APPROVER_DATE)){
    $APPROVER_DATE = "";
} else {
    $APPROVER_DATE            = str_replace("/", "-", $APPROVER_DATE);
}

    if ( $PR_NUMBER == NULL || $PR_NUMBER =='' AND $ER_NUMBER == NULL || $ER_NUMBER =='')
            {

                        echo "PR dan ER Number Tidak Boleh Kosong";
                        
            }
                else
                    {
                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_UPDATE_HQ = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsUpdateDataPRSharepointHQ>
         <UpdateSharepointDataRequest>
            <ERPR_NUMBER>'.$PR_NUMBER.'</ERPR_NUMBER>
            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
            <CHECKER>'.$CHECKER.'</CHECKER>
            <KODECABANG>'.$KODECABANG.'</KODECABANG>
            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
            <PERIODE>'.$PERIODE.'</PERIODE>
            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
            <STATUS>'.$STATUS.'</STATUS>
            <REMARKS>'.$REMARKS.'</REMARKS>
            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
            <TYPE_PR_ER_NUMBER>'.$TYPE_PR_ER_NUMBER.'</TYPE_PR_ER_NUMBER>
            <APPROVER_DATE>'.$APPROVER_DATE.'</APPROVER_DATE>
            <NAME_OF_APPROVERD>'.$NAME_OF_APPROVERD.'</NAME_OF_APPROVERD>
             <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
         </UpdateSharepointDataRequest>
      </com:fsUpdateDataPRSharepointHQ>
   </soapenv:Body>
</soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_update_hq = curl_init();
                            curl_setopt($soap_update_hq, CURLOPT_URL, $url);
                            curl_setopt($soap_update_hq, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_update_hq, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_update_hq, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_update_hq, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_update_hq, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_update_hq, CURLOPT_POST, true);
                            curl_setopt($soap_update_hq, CURLOPT_POSTFIELDS, $POST_SOAP_UPDATE_HQ);
                            curl_setopt($soap_update_hq, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $update_hq          = curl_exec($soap_update_hq);
                            $err              = curl_error($soap_update_hq);
                            $replace_updatehq   = array("soapenv:","ser-root:");
                            $clean_xml_updatehq = str_ireplace($replace_updatehq, '', $update_hq);
                            $xml_savehq       = simplexml_load_string($clean_xml_updatehq);
                            $data_update_hq     = json_encode($xml_savehq->Body->fsUpdateDataPRSharepointHQResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_updatehq   = json_decode($data_update_hq, TRUE);

                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_SAVE_SP = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsUpdateDataPRSharepoint>
         <Untitled>

            <ERPR_NUMBER>'.$PR_NUMBER.'</ERPR_NUMBER>
            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
            <CHECKER>'.$CHECKER.'</CHECKER>
            <KODECABANG>'.$KODECABANG.'</KODECABANG>
            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
            <PERIODE>'.$PERIODE.'</PERIODE>
            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
            <STATUS>'.$STATUS.'</STATUS>
            <REMARKS>'.$REMARKS.'</REMARKS>
            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
             <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
         </Untitled>
      </com:fsUpdateDataPRSharepoint>
   </soapenv:Body>
</soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_save_sp = curl_init();
                            curl_setopt($soap_save_sp, CURLOPT_URL, $url);
                            curl_setopt($soap_save_sp, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_save_sp, CURLOPT_POST, true);
                            curl_setopt($soap_save_sp, CURLOPT_POSTFIELDS, $POST_SOAP_SAVE_SP);
                            curl_setopt($soap_save_sp, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $save_sp          = curl_exec($soap_save_sp);
                            $err              = curl_error($soap_save_sp);
                            $replace_savesp   = array("soapenv:","ser-root:");
                            $clean_xml_savesp = str_ireplace($replace_savesp, '', $save_sp);
                            $xml_savesp       = simplexml_load_string($clean_xml_savesp);
                            $data_save_sp     = json_encode($xml_savesp->Body->fsSaveDataPRSharepointSPResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_Savesp1   = json_decode($data_save_sp, TRUE);

                            echo "OK";
                    }

                    /*================ Fungsi untuk memanggil WebService UpdateDataSharePointHQ ================*/

    }

    public function sla($date1, $date2){
        /*================ Fungsi untuk menghitung Selisih Hari ================*/
        $tgl1=date_create($date1);
        $tgl2=date_create($date2);
        $diff=date_diff($tgl1,$tgl2);
        $tanggal = $diff->format('%a');
        return $tanggal;

        /*================ Fungsi untuk menghitung Selisih Hari ================*/
    }

    public function saveSharePointHQ(){
        /*================ Fungsi untuk memanggil WebService SaveDataSharePointHQ ================*/

        $type               = $this->input->post('type');
    $types              = $this->input->post('types');

    $cek = $this->input->post('txt_tipeermb');
    $cek1 = $this->input->post('txt_tipeerpr');

    if($cek == 'MultiBranch' OR $cek1 == 'MultiBranch'){
        $mb = 'mb';
    } else {
        $mb = '';
    }

    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    $PR_NUMBER                  = $this->input->post('txt_nopr'.$mb);
    $ER_NUMBER                  = $this->input->post('txt_noer'.$mb);
    $VALIDATOR1                 = ucwords($this->input->post('txt_validator1'.$mb));
    $VALIDATOR2                 = ucwords($this->input->post('txt_validator2'.$mb));
    $CHECKER                    = ucwords($this->input->post('txt_checker'.$mb));
    $KODECABANG                 = $this->input->post('htxt_branchid'.$mb);
    $CABANG                     = $this->input->post('txt_dep'.$mb);
    $TIPE_ER                    = $this->input->post('txt_tipeer'.$mb);
    $PERIODE                    = $this->input->post('txt_periode'.$mb);
    $TANGGAL_INCOMING           = $this->input->post('txt_ti'.$mb);
    $TANGGAL_PROSES_CHECKER     = $this->input->post('txt_tpc'.$mb);
    $STATUS                     = $this->input->post('txt_status'.$mb);
    $REMARKS                    = ucwords($this->input->post('txt_remarks'.$mb));
    $TANGGAL_INCOMING_FINANCE   = $this->input->post('txt_tif'.$mb);
    $TYPE_PR_ER_NUMBER          = $this->input->post('txt_tipeerpr'.$mb);
    $APPROVER_DATE              = $this->input->post('htxt_appdate'.$mb);
    $ERDATE                     = $this->input->post('htxt_erdate'.$mb);
    $PRDATE                     = $this->input->post('htxt_prdate'.$mb);
    $ACCDATE                     = $this->input->post('htxt_accdate'.$mb);
    $CAIRDATE                     = $this->input->post('htxt_tglcair'.$mb);
    //$APPROVER_DATE                = date();
    $NAME_OF_APPROVERD          = $this->input->post('txt_nameapp'.$mb);
    $INVOICENO          = $this->input->post('txt_inv'.$mb);
    $SLAPR                  = $this->input->post('txt_slapr'.$mb);
    $SLAPO                  = $this->input->post('txt_slapo'.$mb);
    $SLAERDATE              = $this->input->post('txt_slaerdate'.$mb);
    $SLAKIRIM               = $this->sla($TANGGAL_INCOMING,$ERDATE);
    $SLACABANG              = $this->sla($TANGGAL_INCOMING,$PRDATE);
    $ACCT                   = $this->sla($ACCDATE,$TANGGAL_PROSES_CHECKER);
    $SLAFIN                 = $this->input->post('txt_slafin'.$mb);
    $SLAHQ                  = $this->sla($CAIRDATE,$TANGGAL_INCOMING);
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    if(empty($PERIODE)){
        $PERIODE = "";
    } else{
        $PERIODE                  = str_replace("/", "-", $PERIODE);
    }
    if(empty($TANGGAL_INCOMING)){
        $TANGGAL_INCOMING = "";
    } else {
        $TANGGAL_INCOMING         = str_replace("/", "-", $TANGGAL_INCOMING);
    }
    if(empty($TANGGAL_PROSES_CHECKER)){
        $TANGGAL_PROSES_CHECKER = "";
    } else{
        $TANGGAL_PROSES_CHECKER   = str_replace("/", "-", $TANGGAL_PROSES_CHECKER);
    }
    if(empty($TANGGAL_INCOMING_FINANCE)){
        $TANGGAL_INCOMING_FINANCE = "";
    } else {
        $TANGGAL_INCOMING_FINANCE = str_replace("/", "-", $TANGGAL_INCOMING_FINANCE);
    }
    if(empty($APPROVER_DATE)){
        $APPROVER_DATE = "";
    } else {
        $APPROVER_DATE            = str_replace("/", "-", $APPROVER_DATE);
    }


        if ( $PR_NUMBER == NULL || $PR_NUMBER =='' AND $ER_NUMBER == NULL || $ER_NUMBER =='')
            {

                        echo "PR dan ER Number Tidak Boleh Kosong";
                        
            }
        
        else
            {
                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_SAVE_HQ = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                                   <soapenv:Header/>
                                   <soapenv:Body>
                                      <com:fsSaveDataPRSharepointHQ>
                                         <requestData>
                                            <PR_NUMBER>'.$PR_NUMBER.'</PR_NUMBER>
                                            <ER_NUMBER>'.$ER_NUMBER.'</ER_NUMBER>
                                            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
                                            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
                                            <CHECKER>'.$CHECKER.'</CHECKER>
                                            <KODECABANG>'.$KODECABANG.'</KODECABANG>
                                            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
                                            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
                                            <PERIODE>'.$PERIODE.'</PERIODE>
                                            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
                                            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
                                            <STATUS>'.$STATUS.'</STATUS>
                                            <REMARKS>'.$REMARKS.'</REMARKS>
                                            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
                                            <TYPE_PR_ER_NUMBER>'.$TYPE_PR_ER_NUMBER.'</TYPE_PR_ER_NUMBER>
                                            <APPROVER_DATE>'.$APPROVER_DATE.'</APPROVER_DATE>
                                            <NAME_OF_APPROVERD>'.$NAME_OF_APPROVERD.'</NAME_OF_APPROVERD>
                                             <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
                                            <INVOICENO>'.$INVOICENO.'</INVOICENO>
                                         </requestData>
                                      </com:fsSaveDataPRSharepointHQ>
                                   </soapenv:Body>
                            </soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_save_hq = curl_init();
                            curl_setopt($soap_save_hq, CURLOPT_URL, $url);
                            curl_setopt($soap_save_hq, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_save_hq, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_save_hq, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_save_hq, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_save_hq, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_save_hq, CURLOPT_POST, true);
                            curl_setopt($soap_save_hq, CURLOPT_POSTFIELDS, $POST_SOAP_SAVE_HQ);
                            curl_setopt($soap_save_hq, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $save_hq          = curl_exec($soap_save_hq);
                            $err              = curl_error($soap_save_hq);
                            $replace_savehq   = array("soapenv:","ser-root:");
                            $clean_xml_savehq = str_ireplace($replace_savehq, '', $save_hq);
                            $xml_savehq       = simplexml_load_string($clean_xml_savehq);
                            $data_save_hq     = json_encode($xml_savehq->Body->fsSaveDataPRSharepointHQResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_Savehq1   = json_decode($data_save_hq, TRUE);

                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_SAVE_SP = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsSaveDataPRSharepoint>
         <Untitled>
            <PR_NUMBER>'.$PR_NUMBER.'</PR_NUMBER>
            <ER_NUMBER>'.$ER_NUMBER.'</ER_NUMBER>
            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
            <CHECKER>'.$CHECKER.'</CHECKER>
            <KODECABANG>'.$KODECABANG.'</KODECABANG>
            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
            <PERIODE>'.$PERIODE.'</PERIODE>
            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
            <STATUS>'.$STATUS.'</STATUS>
            <REMARKS>'.$REMARKS.'</REMARKS>
            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
             <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
                                            <INVOICENO>'.$INVOICENO.'</INVOICENO>
         </Untitled>
      </com:fsSaveDataPRSharepoint>
   </soapenv:Body>
</soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_save_sp = curl_init();
                            curl_setopt($soap_save_sp, CURLOPT_URL, $url);
                            curl_setopt($soap_save_sp, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_save_sp, CURLOPT_POST, true);
                            curl_setopt($soap_save_sp, CURLOPT_POSTFIELDS, $POST_SOAP_SAVE_SP);
                            curl_setopt($soap_save_sp, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $save_sp          = curl_exec($soap_save_sp);
                            $err              = curl_error($soap_save_sp);
                            $replace_savesp   = array("soapenv:","ser-root:");
                            $clean_xml_savesp = str_ireplace($replace_savesp, '', $save_sp);
                            $xml_savesp       = simplexml_load_string($clean_xml_savesp);
                            $data_save_sp     = json_encode($xml_savesp->Body->fsSaveDataPRSharepointSPResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_Savesp1   = json_decode($data_save_sp, TRUE);

                            echo "OK";
                        }

                        /*================ Fungsi untuk memanggil WebService SaveDataSharePointHQ ================*/
                         
        
    }

    public function getWSHQ(){
        /*================ Fungsi untuk memanggil WebService GetDataOrafin ================*/

        $cek = $this->input->post('txt_noerpr');
         $url = URL_WS_ERTRACKING; 

        $post_string = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                <soapenv:Header/>
                   <soapenv:Body>
                      <com:fsGetDataOrafin>
                         <RequestERPR>
                            <ERPR_NUMBER>'.$cek.'</ERPR_NUMBER>
                         </RequestERPR>
                      </com:fsGetDataOrafin>
                   </soapenv:Body>
            </soapenv:Envelope>';

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $result    = curl_exec($soap_do);
        $err       = curl_error($soap_do);

        $replace   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xml = str_ireplace($replace, '', $result);
        $xml       = simplexml_load_string($clean_xml);
        $data_wdsl = json_encode($xml->Body->fsGetDataOrafinResponse);     
     
        $Proses1   = json_decode($data_wdsl, TRUE);
        $Proses2   = json_encode($Proses1["ResponeERPR"]); 
        $Proses3   = json_decode($Proses2,TRUE);
        $Print     = json_encode($Proses3['respone']);
        $WSDL      = json_decode($Print,TRUE);
        
      
        $PR_NUMBER = $WSDL['PR_NUMBER']; 
        $ER_NUMBER = $WSDL['ER_NUMBER']; 
        // $PRDATE=$WSDL['pr_date'];
        $PRDATE               = substr($WSDL['pr_date'],0,10);
        $ER_DATE              = substr($WSDL['ER_DATE'],0,10);
        $PO_DATE              = substr($WSDL['PO_DATE'],0,10);
        $ACC_DATE             = substr($WSDL['ACCOUNTING_DATE'],0,10);
        $APP_DATE             = substr($WSDL['PR_APPROVED_DATE'],0,10);
        $PAY_DATE            = substr($WSDL['PAYMENT_DATE'],0,10);
        // $PRDATE0               = substr($WSDL[0]['pr_date'],0,10);
        $ER_DATE0              = substr($WSDL[0]['ER_DATE'],0,10);
        $PO_DATE0              = substr($WSDL[0]['PO_DATE'],0,10);
        $ACC_DATE0             = substr($WSDL[0]['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($WSDL[0]['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($WSDL[0]['PAYMENT_DATE'],0,10);
         /*================ Fungsi untuk memanggil WebService GetDataOrafin ================*/
// ======================================================================================================================================================================

        /*================ Fungsi untuk memanggil WebService GetDataSharePointHQ ================*/

                $GET_HQ='
                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                                <soapenv:Header/>
                                <soapenv:Body>
                                    <com:fsGetDataPRSharepointHQ>
                                         <GET>
                                            <ERPR_NUMBER>'.$cek.'</ERPR_NUMBER>
                                         </GET>
                                    </com:fsGetDataPRSharepointHQ>
                                </soapenv:Body>
                            </soapenv:Envelope>';
                $SOAP_GET_HQ = curl_init();
                curl_setopt($SOAP_GET_HQ, CURLOPT_URL, $url);
                curl_setopt($SOAP_GET_HQ, CURLOPT_CONNECTTIMEOUT, 1000);
                curl_setopt($SOAP_GET_HQ, CURLOPT_TIMEOUT, 1000);
                curl_setopt($SOAP_GET_HQ, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($SOAP_GET_HQ, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($SOAP_GET_HQ, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($SOAP_GET_HQ, CURLOPT_POST, true);
                curl_setopt($SOAP_GET_HQ, CURLOPT_POSTFIELDS, $GET_HQ);
                curl_setopt($SOAP_GET_HQ, CURLOPT_HTTPHEADER,
                array('Content-Type: text/xml; charset=utf-8'));
                $result_GETHQ    = curl_exec($SOAP_GET_HQ);
                $err             = curl_error($SOAP_GET_HQ);
                $replace_GETHQ   = array("soapenv:","ser-root:");
                $clean_xml_GETHQ = str_ireplace($replace_GETHQ, '', $result_GETHQ);
                $xml_GETHQ       = simplexml_load_string($clean_xml_GETHQ);
                $data_GETHQ      = json_encode($xml_GETHQ->Body->fsGetDataPRSharepointHQResponse);     
                $Proses1_GETHQ   = json_decode($data_GETHQ, TRUE);
                $Proses2_GETHQ   = json_encode($Proses1_GETHQ["DRL_x0020_respone_x0020_GetHQ"]); 
                $WSDL_GETHQ      = json_decode($Proses2_GETHQ,TRUE);
                $PR_NUMBER1 = $WSDL_GETHQ['PR_NUMBER'];
                 $ER_NUMBER1 = $WSDL_GETHQ['ER_NUMBER'];
                $PERIODE                   = substr($WSDL_GETHQ['PERIODE'],0,10);
                $TANGGAL_INCOMING          = substr($WSDL_GETHQ['TANGGAL_INCOMING'],0,10);
                $TANGGAL_PROSES_CHECKER    = substr($WSDL_GETHQ['TANGGAL_PROSES_CHECKER'],0,10);
                $TANGGAL_INCOMING_FINANCE  = substr($WSDL_GETHQ['TANGGAL_INCOMING_FINANCE'],0,10);
                $APP_DATE1  = substr($WSDL_GETHQ['APPROVER_DATE'],0,10);
                
                /*================ Fungsi untuk memanggil WebService GetDataSharePointHQ ================*/
// ======================================================================================================================================================================
         
         // $WSDL_GETHQ['PR_NUMBER'];

   
/*================ Fungsi untuk menangkap Response dari WebService GetDataOrafin, GetDataSharePointHQ ================*/

        // ============ fungsi ambil value dari webservice multibranch

$cek = $WSDL[0]['PR_NUMBER'];
$cek1 = $WSDL[0]['ER_NUMBER'];
$pr = $WSDL['PR_NUMBER'];
$er = $WSDL['ER_NUMBER'];

if(!empty($cek1)){
    $value = $cek1;
} else {
    $value = $er;
}

$urlmb = URL_WS_ERTRACKING; 

        $post_stringmb = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsGetDataERMultibranch>
         <requestERMultibranch>
            <batch_name>'.$value.'</batch_name>
         </requestERMultibranch>
      </com:fsGetDataERMultibranch>
   </soapenv:Body>
</soapenv:Envelope>';

        $soap_domb = curl_init();
        curl_setopt($soap_domb, CURLOPT_URL, $urlmb);
        curl_setopt($soap_domb, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_domb, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_domb, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_domb, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_domb, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_domb, CURLOPT_POST, true);
        curl_setopt($soap_domb, CURLOPT_POSTFIELDS, $post_stringmb);
        curl_setopt($soap_domb, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $resultmb    = curl_exec($soap_domb);
        $errmb       = curl_error($soap_domb);

        $replacemb   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xmlmb = str_ireplace($replacemb, '', $resultmb);
        $xmlmb       = simplexml_load_string($clean_xmlmb);
        $data_wdslmb = json_encode($xmlmb->Body->fsGetDataERMultibranchResponse);     
     
        $Proses1mb   = json_decode($data_wdslmb, TRUE);
        $Proses2mb   = json_encode($Proses1mb["ResponseERMultibranch"]); 
        $Proses3mb   = json_decode($Proses2mb,TRUE);
        $Printmb     = json_encode($Proses3mb['ArrayData']);
        $WSDLmb      = json_decode($Printmb,TRUE);

        if($WSDLmb['ER_NUMBER'] !=''){
            $type = 'multibranch';
        } else {
            $type = 'biasa';
        }

if(!empty($cek) AND !empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
    $PRDATE0               = substr($WSDL[0]['pr_date'],0,10);
        $ER_DATE0              = substr($WSDL[0]['ER_DATE'],0,10);
        $PO_DATE0              = substr($WSDL[0]['PO_DATE'],0,10);
        $ACC_DATE0             = substr($WSDL[0]['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($WSDL[0]['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($WSDL[0]['PAYMENT_DATE'],0,10);
    $data = $this->WebService_M->getDataBranch($kode);
    if($data['CHECKER']==$WSDL_GETHQ['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }

    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'],  
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0,
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                     'txt_kegiatan'    => $WSDL[0]['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
} elseif(!empty($cek) AND !empty($cek1) AND empty($pr) AND empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $PRDATE0               = substr($WSDL[0]['pr_date'],0,10);
        $ER_DATE0              = substr($WSDL[0]['ER_DATE'],0,10);
        $PO_DATE0              = substr($WSDL[0]['PO_DATE'],0,10);
        $ACC_DATE0             = substr($WSDL[0]['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($WSDL[0]['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($WSDL[0]['PAYMENT_DATE'],0,10);
  
        $data = $this->WebService_M->getDataBranch($kode);
            if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'],  
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0,
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'txt_kegiatan'    => $WSDL[0]['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                  'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type

                     

                );
}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
    $end = end($WSDL);
      $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
         $kode = $end['BRANCHID'];
         $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
         if($data['CHECKER']==$WSDL_GETHQ['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $end['PR_NUMBER'], 
                    'txt_nopr'        => $end['PR_NUMBER'], 
                    'txt_noer'        => $end['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $end['BENEFICIARY'], 
                    'txt_accnumber'   => $end['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $end['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $end['PAY_GROUP'], 
                    'txt_branchid'    => $end['BRANCHID'],
                    'txt_kegiatan'    => $end['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => $end['INVOICE_NUM'],

                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
    $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'], 
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'txt_kegiatan'    => $WSDL[0]['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
    
    $end = end($WSDL);
     $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
         $kode = $end['BRANCHID'];
         $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $end['PR_NUMBER'], 
                    'txt_nopr'        => $end['PR_NUMBER'], 
                    'txt_noer'        => $end['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $end['BENEFICIARY'], 
                    'txt_accnumber'   => $end['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $end['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $end['PAY_GROUP'], 
                    'txt_branchid'    => $end['BRANCHID'],
                    'txt_kegiatan'    => $end['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $end['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
    $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'], 
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'txt_kegiatan'    => $WSDL[0]['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
       
          $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETHQ['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'txt_kegiatan'    => $WSDL['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND empty($PR_NUMBER1)){
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
    $data = $this->WebService_M->getDataBranch($kode);
    if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    //sudah
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'txt_kegiatan'    => $WSDL['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER,
                     'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
} else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND empty($ER_NUMBER1)) {
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
    $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
 $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'txt_kegiatan'    => $WSDL['DESCRIPTION_ER'],
                    'data1'              => $PR_NUMBER,
                     'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

} else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND !empty($ER_NUMBER1)) {
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
   $data = $this->WebService_M->getDataBranch($kode);
    if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
  $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'data1'              => $PR_NUMBER,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_kegiatan'    => $WSDL_GETHQ['DESCRIPTION_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL_GETHQ['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETHQ['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETHQ['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETHQ['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETHQ['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETHQ['VALIDATOR2'];
    }
    $callback = array(
                 'status'     => 'success', 
                      'txt_noerpr'      => $WSDL_GETHQ['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL_GETHQ['PR_NUMBER'], 
                    'txt_noer'        => $WSDL_GETHQ['ER_NUMBER'],
                    'txt_prdate'      => '', 
                    'txt_appdate'     => $APP_DATE1, 
                    'txt_podate'      => '', 
                    'txt_erdate'      => '', 
                    'txt_beneficiary' => '',
                    'txt_accnumber'   => '',
                    'txt_amount'      => '', 
                    'txt_accdate'     => '',
                    'txt_tglcair'     => '',
                    'txt_paygroup'    => '',
                    'txt_branchid'    => $WSDL_GETHQ['KODECABANG'],

                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETHQ['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETHQ['STATUS'],
                    'txt_remarks'     => $WSDL_GETHQ['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETHQ['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETHQ['DEPARTEMENT'],
                    'txt_inv'         => '',
                    'button'  => 'update',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND empty($er) AND empty($PR_NUMBER1)){
  $callback = array('status' => 'failed',
                    'button'  => 'hide',
                     'tipe'   => $type   ); 
}


echo json_encode($callback); 

/*================ Fungsi untuk menangkap Response dari WebService GetDataOrafin, GetDataSharePointHQ ================*/

    }

    public function getWSBR(){
        /*================ Fungsi untuk memanggil WebService GetDataOrafin ================*/

        $cek=$this->input->post('txt_noerpr');
// ========================================================================== fsGetDataOrafin ===========================================================================
// ======================================================================================================================================================================
        $url = URL_WS_ERTRACKING; 

        $post_string = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                <soapenv:Header/>
                   <soapenv:Body>
                      <com:fsGetDataOrafin>
                         <RequestERPR>
                            <ERPR_NUMBER>'.$cek.'</ERPR_NUMBER>
                         </RequestERPR>
                      </com:fsGetDataOrafin>
                   </soapenv:Body>
            </soapenv:Envelope>';

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $result    = curl_exec($soap_do);
        $err       = curl_error($soap_do);

        $replace   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xml = str_ireplace($replace, '', $result);
        $xml       = simplexml_load_string($clean_xml);
        $data_wdsl = json_encode($xml->Body->fsGetDataOrafinResponse);     
     
        $Proses1   = json_decode($data_wdsl, TRUE);
        $Proses2   = json_encode($Proses1["ResponeERPR"]); 
        $Proses3   = json_decode($Proses2,TRUE);
        $Print     = json_encode($Proses3['respone']);
        $WSDL      = json_decode($Print,TRUE);
        $PR_NUMBER = $WSDL['PR_NUMBER']; 
        // $PRDATE=$WSDL['pr_date'];
       $PRDATE               = substr($WSDL['pr_date'],0,10);
        $ER_DATE              = substr($WSDL['ER_DATE'],0,10);
        $PO_DATE              = substr($WSDL['PO_DATE'],0,10);
        $ACC_DATE             = substr($WSDL['ACCOUNTING_DATE'],0,10);
        $APP_DATE             = substr($WSDL['PR_APPROVED_DATE'],0,10);
        $PAY_DATE            = substr($WSDL['PAYMENT_DATE'],0,10);
        $PRDATE0               = substr($WSDL[0]['pr_date'],0,10);
        $ER_DATE0              = substr($WSDL[0]['ER_DATE'],0,10);
        $PO_DATE0              = substr($WSDL[0]['PO_DATE'],0,10);
        $ACC_DATE0             = substr($WSDL[0]['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($WSDL[0]['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($WSDL[0]['PAYMENT_DATE'],0,10);

          /*================ Fungsi untuk memanggil WebService GetDataOrafin ================*/
// ======================================================================================================================================================================

// ======================================================================= fsGetDataPRSharepoint ========================================================================
           /*================ Fungsi untuk memanggil WebService GetDataSharePoint (Branch) ================*/

        $url = URL_WS_ERTRACKING; 
        $GET_BRANCH='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                                    <soapenv:Header/>
                                    <soapenv:Body>
                                      <com:fsGetDataPRSharepoint>
                                         <GET>
                                            <ERPR_NUMBER>'.$cek.'</ERPR_NUMBER>
                                         </GET>
                                      </com:fsGetDataPRSharepoint>
                                    </soapenv:Body>
                            </soapenv:Envelope>';
                //=======================================================================================================================================================           
                $SOAP_GET_BRANCH = curl_init();
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_URL, $url);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_CONNECTTIMEOUT, 1000);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_TIMEOUT, 1000);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_POST, true);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_POSTFIELDS, $GET_BRANCH);
                curl_setopt($SOAP_GET_BRANCH, CURLOPT_HTTPHEADER,
                array('Content-Type: text/xml; charset=utf-8'));
                $result_GETBRANCH    = curl_exec($SOAP_GET_BRANCH);
                $err                 = curl_error($SOAP_GET_BRANCH);
                $replace_GETBRANCH   = array("soapenv:","ser-root:");
                $clean_xml_GETBRANCH = str_ireplace($replace_GETBRANCH, '', $result_GETBRANCH);
                $xml_GETBRANCH       = simplexml_load_string($clean_xml_GETBRANCH);
                $data_GETBRANCH      = json_encode($xml_GETBRANCH->Body->fsGetDataPRSharepointResponse);     
                $Proses1_GETBRANCH   = json_decode($data_GETBRANCH, TRUE);
                $Proses2_GETBRANCH   = json_encode($Proses1_GETBRANCH["DRL_x0020_respone_x0020_Get"]); 
                $WSDL_GETBRANCH      = json_decode($Proses2_GETBRANCH,TRUE); 
                 $PR_NUMBER1 = $WSDL_GETBRANCH['PR_NUMBER'];
                 $ER_NUMBER1 = $WSDL_GETBRANCH['ER_NUMBER'];
                $PERIODE                   = substr($WSDL_GETBRANCH['PERIODE'],0,10);
                $TANGGAL_INCOMING          = substr($WSDL_GETBRANCH['TANGGAL_INCOMING'],0,10);
                $TANGGAL_PROSES_CHECKER    = substr($WSDL_GETBRANCH['TANGGAL_PROSES_CHECKER'],0,10);
                $TANGGAL_INCOMING_FINANCE  = substr($WSDL_GETBRANCH['TANGGAL_INCOMING_FINANCE'],0,10);
               
                /*================ Fungsi untuk memanggil WebService GetDataSharePoint (Branch) ================*/
                
// ======================================================================================================================================================================

// ======================================================================= fsGetDataPRSharepointHQ ======================================================================
 /*       $url = URL_WS_ERTRACKING; 
                $GET_HQ='
                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                                <soapenv:Header/>
                                <soapenv:Body>
                                    <com:fsGetDataPRSharepointHQ>
                                         <GET>
                                            <ERPR_NUMBER>'.$cek.'</ERPR_NUMBER>
                                         </GET>
                                    </com:fsGetDataPRSharepointHQ>
                                </soapenv:Body>
                            </soapenv:Envelope>';
                $SOAP_GET_HQ = curl_init();
                curl_setopt($SOAP_GET_HQ, CURLOPT_URL, $url);
                curl_setopt($SOAP_GET_HQ, CURLOPT_CONNECTTIMEOUT, 1000);
                curl_setopt($SOAP_GET_HQ, CURLOPT_TIMEOUT, 1000);
                curl_setopt($SOAP_GET_HQ, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($SOAP_GET_HQ, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($SOAP_GET_HQ, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($SOAP_GET_HQ, CURLOPT_POST, true);
                curl_setopt($SOAP_GET_HQ, CURLOPT_POSTFIELDS, $GET_HQ);
                curl_setopt($SOAP_GET_HQ, CURLOPT_HTTPHEADER,
                array('Content-Type: text/xml; charset=utf-8'));
                $result_GETHQ    = curl_exec($SOAP_GET_HQ);
                $err             = curl_error($SOAP_GET_HQ);
                $replace_GETHQ   = array("soapenv:","ser-root:");
                $clean_xml_GETHQ = str_ireplace($replace_GETHQ, '', $result_GETHQ);
                $xml_GETHQ       = simplexml_load_string($clean_xml_GETHQ);
                $data_GETHQ      = json_encode($xml_GETHQ->Body->fsGetDataPRSharepointHQResponse);     
                $Proses1_GETHQ   = json_decode($data_GETHQ, TRUE);
                $Proses2_GETHQ   = json_encode($Proses1_GETHQ["DRL_x0020_respone_x0020_GetHQ"]); 
                $WSDL_GETBRANCH      = json_decode($Proses2_GETHQ,TRUE);
                $PR_NUMBER1 = $WSDL_GETBRANCH['PR_NUMBER'];
                $PERIODE                   = substr($WSDL_GETBRANCH['PERIODE'],0,10);
                $TANGGAL_INCOMING          = substr($WSDL_GETBRANCH['TANGGAL_INCOMING'],0,10);
                $TANGGAL_PROSES_CHECKER    = substr($WSDL_GETBRANCH['TANGGAL_PROSES_CHECKER'],0,10);
                $TANGGAL_INCOMING_FINANCE  = substr($WSDL_GETBRANCH['TANGGAL_INCOMING_FINANCE'],0,10);
                $APP_DATE1  = substr($WSDL_GETBRANCH['APPROVER_DATE'],0,10);
     */         
// ======================================================================================================================================================================
         
         // $WSDL_GETBRANCH['PR_NUMBER'];
   
/*================ Fungsi untuk menangkap Response dari WebService GetDataOrafin, GetDataSharePoint (Branch) ================*/

$cek = $WSDL[0]['PR_NUMBER'];
$cek1 = $WSDL[0]['ER_NUMBER'];
$pr = $WSDL['PR_NUMBER'];
$er = $WSDL['ER_NUMBER'];

if(!empty($cek1)){
    $value = $cek1;
} else {
    $value = $er;
}

$urlmb = URL_WS_ERTRACKING; 

        $post_stringmb = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsGetDataERMultibranch>
         <requestERMultibranch>
            <batch_name>'.$value.'</batch_name>
         </requestERMultibranch>
      </com:fsGetDataERMultibranch>
   </soapenv:Body>
</soapenv:Envelope>';

        $soap_domb = curl_init();
        curl_setopt($soap_domb, CURLOPT_URL, $urlmb);
        curl_setopt($soap_domb, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_domb, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_domb, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_domb, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_domb, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_domb, CURLOPT_POST, true);
        curl_setopt($soap_domb, CURLOPT_POSTFIELDS, $post_stringmb);
        curl_setopt($soap_domb, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $resultmb    = curl_exec($soap_domb);
        $errmb       = curl_error($soap_domb);

        $replacemb   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xmlmb = str_ireplace($replacemb, '', $resultmb);
        $xmlmb       = simplexml_load_string($clean_xmlmb);
        $data_wdslmb = json_encode($xmlmb->Body->fsGetDataERMultibranchResponse);     
     
        $Proses1mb   = json_decode($data_wdslmb, TRUE);
        $Proses2mb   = json_encode($Proses1mb["ResponseERMultibranch"]); 
        $Proses3mb   = json_decode($Proses2mb,TRUE);
        $Printmb     = json_encode($Proses3mb['ArrayData']);
        $WSDLmb      = json_decode($Printmb,TRUE);

        if($WSDLmb['ER_NUMBER'] !=''){
            $type = 'multibranch';
        } else {
            $type = 'biasa';
        }


if(!empty($cek) AND !empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
       if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'],  
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0,
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
} elseif(!empty($cek) AND !empty($cek1) AND empty($pr) AND empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'],  
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0,
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                  'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type

                     

                );
}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
    $end = end($WSDL);
      $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
          $kode = $end['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
       if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $end['PR_NUMBER'], 
                    'txt_nopr'        => $end['PR_NUMBER'], 
                    'txt_noer'        => $end['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $end['BENEFICIARY'], 
                    'txt_accnumber'   => $end['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $end['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $end['PAY_GROUP'], 
                    'txt_branchid'    => $end['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => $end['INVOICE_NUM'],
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
    $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETHQ['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'], 
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
    $end = end($WSDL);
     $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
          $kode = $end['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $end['PR_NUMBER'], 
                    'txt_nopr'        => $end['PR_NUMBER'], 
                    'txt_noer'        => $end['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $end['BENEFICIARY'], 
                    'txt_accnumber'   => $end['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $end['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $end['PAY_GROUP'], 
                    'txt_branchid'    => $end['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $end['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
     $kode = $WSDL[0]['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL[0]['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL[0]['PR_NUMBER'], 
                    'txt_noer'        => $WSDL[0]['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE0, 
                    'txt_appdate'     => $APP_DATE0, 
                    'txt_podate'      => $PO_DATE0, 
                    'txt_erdate'      => $ER_DATE0, 
                    'txt_beneficiary' => $WSDL[0]['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL[0]['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL[0]['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE0, 
                    'txt_tglcair'     => $PAY_DATE0, 
                    'txt_paygroup'    => $WSDL[0]['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL[0]['BRANCHID'],
                    'data1'              => $PR_NUMBER0,
                   'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL[0]['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );
} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND !empty($PR_NUMBER1)){
     $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
        if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR']){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'data1'              => $PR_NUMBER,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND empty($PR_NUMBER1)){
     $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'data1'              => $PR_NUMBER,
                     'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND empty($ER_NUMBER1)) {
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
       if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
 $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'data1'              => $PR_NUMBER,
                     'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'save',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}  else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND !empty($ER_NUMBER1)) {
    $kode = $WSDL['BRANCHID'];
    $kode = substr($kode, 0, 3);
     $data = $this->WebService_M->getDataBranch($kode);
     if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
  $callback = array(
                   'status'     => 'success', 
                    'txt_noerpr'      => $WSDL['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL['PR_NUMBER'], 
                    'txt_noer'        => $WSDL['ER_NUMBER'],
                    'txt_prdate'      => $PRDATE, 
                    'txt_appdate'     => $APP_DATE, 
                    'txt_podate'      => $PO_DATE, 
                    'txt_erdate'      => $ER_DATE, 
                    'txt_beneficiary' => $WSDL['BENEFICIARY'], 
                    'txt_accnumber'   => $WSDL['ACCOUNT_NUMBER'], 
                    'txt_amount'      => $WSDL['PAID_AMOUNT'], 
                    'txt_accdate'     => $ACC_DATE, 
                    'txt_tglcair'     => $PAY_DATE, 
                    'txt_paygroup'    => $WSDL['PAY_GROUP'], 
                    'txt_branchid'    => $WSDL['BRANCHID'],
                    'data1'              => $PR_NUMBER,
                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => $WSDL['INVOICE_NUM'],
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
     $kode = $WSDL_GETBRANCH['BRANCHID'];
    $kode = substr($kode, 0, 3);
      $data = $this->WebService_M->getDataBranch($kode);
      if($data['CHECKER']==$WSDL_GETBRANCH['CHECKER']  OR $data['CHECKER']!=''){
        $checker = $data['CHECKER'];
    } else {
        $checker = $WSDL_GETBRANCH['CHECKER'];
    }

      if($data['VALIDATOR1']==$WSDL_GETBRANCH['VALIDATOR'] OR $data['VALIDATOR1']!=''){
        $validator1 = $data['VALIDATOR1'];
    } else {
        $validator1 = $WSDL_GETBRANCH['VALIDATOR'];
    }

    if($data['VALIDATOR2']==$WSDL_GETBRANCH['VALIDATOR2']  OR $data['VALIDATOR2']!=''){
        $validator2 = $data['VALIDATOR2'];
    } else {
        $validator2 = $WSDL_GETBRANCH['VALIDATOR2'];
    }
    $callback = array(
                 'status'     => 'success', 
                      'txt_noerpr'      => $WSDL_GETBRANCH['PR_NUMBER'], 
                    'txt_nopr'        => $WSDL_GETBRANCH['PR_NUMBER'], 
                    'txt_noer'        => $WSDL_GETBRANCH['ER_NUMBER'],
                    'txt_prdate'      => '', 
                    'txt_appdate'     => '', 
                    'txt_podate'      => '', 
                    'txt_erdate'      => '', 
                    'txt_beneficiary' => '',
                    'txt_accnumber'   => '',
                    'txt_amount'      => '', 
                    'txt_accdate'     => '',
                    'txt_tglcair'     => '',
                    'txt_paygroup'    => '',
                    'txt_branchid'    => $WSDL_GETBRANCH['KODECABANG'],

                    'txt_validator1'  => $validator1,
                    'txt_validator2'  => $validator2,
                    'txt_checker'     => $checker,
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['DEPARTEMENT'],
                    'txt_inv'         => '',
                    'button'  => 'hide',
                    'txt_ernumber'                  => $WSDLmb['ER_NUMBER'], 
                    'txt_beneficiarymb'           => $WSDLmb['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDLmb['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDLmb['BANK_NAME'], 
                    'txt_taxcode'               => $WSDLmb['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDLmb['AMOUNT_PAID'],
                    'tipe'  => $type
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND empty($er) AND empty($PR_NUMBER1)){
  $callback = array('status' => 'failed',
    'button'  => 'hide',
'tipe'  => $type); 
}

echo json_encode($callback); 

/*================ Fungsi untuk menangkap Response dari WebService GetDataOrafin, GetDataSharePoint (Branch) ================*/

    }

    public function saveSharePointBR(){
        /*================ Fungsi untuk memanggil WebService SaveDataSharePoint (Branch) ================*/

        $type               = $this->input->post('type');
$types              = $this->input->post('types');

 $cek = $this->input->post('txt_tipeermb');
    $cek1 = $this->input->post('txt_tipeerpr');

    if($cek == 'MultiBranch' OR $cek1 == 'MultiBranch'){
        $mb = 'mb';
    } else {
        $mb = '';
    }
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

$PR_NUMBER                  = $this->input->post('txt_nopr'.$mb);
$ER_NUMBER                  = $this->input->post('txt_noer'.$mb);
$VALIDATOR1                 = ucwords($this->input->post('txt_validator1'.$mb));
$VALIDATOR2                 = ucwords($this->input->post('txt_validator2'.$mb));
$CHECKER                    = ucwords($this->input->post('txt_checker'.$mb));
$KODECABANG                 = $this->input->post('htxt_branchid'.$mb);
$CABANG                     = $this->input->post('txt_dep'.$mb);
$TIPE_ER                    = $this->input->post('txt_tipeer'.$mb);
$PERIODE                    = $this->input->post('txt_periode'.$mb);
$TANGGAL_INCOMING           = $this->input->post('txt_ti'.$mb);
$TANGGAL_PROSES_CHECKER     = $this->input->post('txt_tpc'.$mb);
$STATUS                     = $this->input->post('txt_status'.$mb);
$REMARKS                    = $this->input->post('txt_remarks'.$mb);
$TANGGAL_INCOMING_FINANCE   = $this->input->post('txt_tif'.$mb);
$TYPE_PR_ER_NUMBER          = $this->input->post('txt_tipeerpr'.$mb);
$APPROVER_DATE              = $this->input->post('htxt_appdate'.$mb);
    //$APPROVER_DATE              = $this->input->post('htxt_appdate'.$mb);
    $ERDATE                     = $this->input->post('htxt_erdate'.$mb);
    $PRDATE                     = $this->input->post('htxt_prdate'.$mb);
    $ACCDATE                     = $this->input->post('htxt_accdate'.$mb);
    $CAIRDATE                     = $this->input->post('htxt_tglcair'.$mb);
//$APPROVER_DATE                = date();
$NAME_OF_APPROVERD          = $this->input->post('txt_nameapp'.$mb);
$INVOICENO          = $this->input->post('txt_inv'.$mb);
/*$SLAPR                  = $this->input->post('txt_slapr'.$mb);
$SLAPO                  = $this->input->post('txt_slapo'.$mb);
$SLAERDATE              = $this->input->post('txt_slaerdate'.$mb);
$SLAKIRIM               = $this->input->post('txt_slakirim'.$mb);
$SLACABANG              = $this->input->post('txt_slacabang'.$mb);
$ACCT                   = $this->input->post('txt_acct'.$mb);
$SLAFIN                 = $this->input->post('txt_slafin'.$mb);
$SLAHQ                  = $this->input->post('txt_slahq'.$mb);*/
 $SLAPR                  = $this->input->post('txt_slapr'.$mb);
    $SLAPO                  = $this->input->post('txt_slapo'.$mb);
    $SLAERDATE              = $this->input->post('txt_slaerdate'.$mb);
    $SLAKIRIM               = $this->sla($TANGGAL_INCOMING,$ERDATE);
    $SLACABANG              = $this->sla($TANGGAL_INCOMING,$PRDATE);
    $ACCT                   = $this->sla($ACCDATE,$TANGGAL_PROSES_CHECKER);
    $SLAFIN                 = $this->input->post('txt_slafin'.$mb);
    $SLAHQ                  = $this->sla($CAIRDATE,$TANGGAL_INCOMING);

if(empty($PERIODE)){
    $PERIODE = "";
} else{
    $PERIODE                  = str_replace("/", "-", $PERIODE);
}
if(empty($TANGGAL_INCOMING)){
    $TANGGAL_INCOMING = "";
} else {
    $TANGGAL_INCOMING         = str_replace("/", "-", $TANGGAL_INCOMING);
}
if(empty($TANGGAL_PROSES_CHECKER)){
    $TANGGAL_PROSES_CHECKER = "";
} else{
    $TANGGAL_PROSES_CHECKER   = str_replace("/", "-", $TANGGAL_PROSES_CHECKER);
}
if(empty($TANGGAL_INCOMING_FINANCE)){
    $TANGGAL_INCOMING_FINANCE = "";
} else {
    $TANGGAL_INCOMING_FINANCE = str_replace("/", "-", $TANGGAL_INCOMING_FINANCE);
}
if(empty($APPROVER_DATE)){
    $APPROVER_DATE = "";
} else {
    $APPROVER_DATE            = str_replace("/", "-", $APPROVER_DATE);
}
if ( $PR_NUMBER == NULL || $PR_NUMBER =='' AND $ER_NUMBER == NULL || $ER_NUMBER =='')
            {

                        return "PR dan ER Number Tidak Boleh Kosong";
                        
            }
        else
            {
                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_SAVE_HQ = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
                                   <soapenv:Header/>
                                   <soapenv:Body>
                                      <com:fsSaveDataPRSharepointHQ>
                                         <requestData>
                                            <PR_NUMBER>'.$PR_NUMBER.'</PR_NUMBER>
                                            <ER_NUMBER>'.$ER_NUMBER.'</ER_NUMBER>
                                            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
                                            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
                                            <CHECKER>'.$CHECKER.'</CHECKER>
                                            <KODECABANG>'.$KODECABANG.'</KODECABANG>
                                            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
                                            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
                                            <PERIODE>'.$PERIODE.'</PERIODE>
                                            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
                                            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
                                            <STATUS>'.$STATUS.'</STATUS>
                                            <REMARKS>'.$REMARKS.'</REMARKS>
                                            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
                                            <TYPE_PR_ER_NUMBER>'.$TYPE_PR_ER_NUMBER.'</TYPE_PR_ER_NUMBER>
                                            <APPROVER_DATE>'.$APPROVER_DATE.'</APPROVER_DATE>
                                            <NAME_OF_APPROVERD>'.$NAME_OF_APPROVERD.'</NAME_OF_APPROVERD>
                                            <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
                                            <INVOICENO>'.$INVOICENO.'</INVOICENO>
                                         </requestData>
                                      </com:fsSaveDataPRSharepointHQ>
                                   </soapenv:Body>
                            </soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_save_hq = curl_init();
                            curl_setopt($soap_save_hq, CURLOPT_URL, $url);
                            curl_setopt($soap_save_hq, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_save_hq, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_save_hq, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_save_hq, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_save_hq, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_save_hq, CURLOPT_POST, true);
                            curl_setopt($soap_save_hq, CURLOPT_POSTFIELDS, $POST_SOAP_SAVE_HQ);
                            curl_setopt($soap_save_hq, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $save_hq          = curl_exec($soap_save_hq);
                            $err              = curl_error($soap_save_hq);
                            $replace_savehq   = array("soapenv:","ser-root:");
                            $clean_xml_savehq = str_ireplace($replace_savehq, '', $save_hq);
                            $xml_savehq       = simplexml_load_string($clean_xml_savehq);
                            $data_save_hq     = json_encode($xml_savehq->Body->fsSaveDataPRSharepointHQResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_Savehq1   = json_decode($data_save_hq, TRUE);

                            $url = URL_WS_ERTRACKING; 
                        //===========================================================================================================================================================       
                            $POST_SOAP_SAVE_SP = 
                            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsSaveDataPRSharepoint>
         <Untitled>
            <PR_NUMBER>'.$PR_NUMBER.'</PR_NUMBER>
            <ER_NUMBER>'.$ER_NUMBER.'</ER_NUMBER>
            <VALIDATOR>'.$VALIDATOR1.'</VALIDATOR>
            <VALIDATOR2>'.$VALIDATOR2.'</VALIDATOR2>
            <CHECKER>'.$CHECKER.'</CHECKER>
            <KODECABANG>'.$KODECABANG.'</KODECABANG>
            <DEPARTEMENT>'.$CABANG.'</DEPARTEMENT>
            <TIPE_ER>'.$TIPE_ER.'</TIPE_ER>
            <PERIODE>'.$PERIODE.'</PERIODE>
            <TANGGAL_INCOMING>'.$TANGGAL_INCOMING.'</TANGGAL_INCOMING>
            <TANGGAL_PROSES_CHECKER>'.$TANGGAL_PROSES_CHECKER.'</TANGGAL_PROSES_CHECKER>
            <STATUS>'.$STATUS.'</STATUS>
            <REMARKS>'.$REMARKS.'</REMARKS>
            <TANGGAL_INCOMING_FINANCE>'.$TANGGAL_INCOMING_FINANCE.'</TANGGAL_INCOMING_FINANCE>
            <SLA_PR>'.$SLAPR.'</SLA_PR>
                                            <SLA_PO>'.$SLAPO.'</SLA_PO>
                                            <SLA_ER_DATE>'.$SLAERDATE.'</SLA_ER_DATE>
                                            <SLA_KIRIM>'.$SLAKIRIM.'</SLA_KIRIM>
                                            <SLA_CABANG>'.$SLACABANG.'</SLA_CABANG>
                                            <ACCT>'.$ACCT.'</ACCT>
                                            <SLA_FIN>'.$SLAFIN.'</SLA_FIN>
                                            <SLA_HQ>'.$SLAHQ.'</SLA_HQ>
         </Untitled>
      </com:fsSaveDataPRSharepoint>
   </soapenv:Body>
</soapenv:Envelope>';
                        //===========================================================================================================================================================
           
                            $soap_save_sp = curl_init();
                            curl_setopt($soap_save_sp, CURLOPT_URL, $url);
                            curl_setopt($soap_save_sp, CURLOPT_CONNECTTIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_TIMEOUT, 1000);
                            curl_setopt($soap_save_sp, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($soap_save_sp, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($soap_save_sp, CURLOPT_POST, true);
                            curl_setopt($soap_save_sp, CURLOPT_POSTFIELDS, $POST_SOAP_SAVE_SP);
                            curl_setopt($soap_save_sp, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
               
                            $save_sp          = curl_exec($soap_save_sp);
                            $err              = curl_error($soap_save_sp);
                            $replace_savesp   = array("soapenv:","ser-root:");
                            $clean_xml_savesp = str_ireplace($replace_savesp, '', $save_sp);
                            $xml_savesp       = simplexml_load_string($clean_xml_savesp);
                            $data_save_sp     = json_encode($xml_savesp->Body->fsSaveDataPRSharepointSPResponse);  
            
                        // ==========================================================================================================================================================
                            $Prs_Savesp1   = json_decode($data_save_sp, TRUE);

                            echo "OK";

                            /*================ Fungsi untuk memanggil WebService SaveDataSharePoint (Branch) ================*/

                            
            }
    }


    public function getWSMultiBranch() {

    $cek = $this->input->post('txt_noerpr');
         $url = URL_WS_ERTRACKING; 

        $post_string = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://localhost/com.baf.ws:ws_DataERPR">
   <soapenv:Header/>
   <soapenv:Body>
      <com:fsGetDataERMultibranch>
         <requestERMultibranch>
            <batch_name>'.$cek.'</batch_name>
         </requestERMultibranch>
      </com:fsGetDataERMultibranch>
   </soapenv:Body>
</soapenv:Envelope>';

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 1000);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: text/xml; charset=utf-8'
            ));
        $result    = curl_exec($soap_do);
        $err       = curl_error($soap_do);

        $replace   = array(
            "soapenv:",
            "ser-root:"
        );
        $clean_xml = str_ireplace($replace, '', $result);
        $xml       = simplexml_load_string($clean_xml);
        $data_wdsl = json_encode($xml->Body->fsGetDataERMultibranchResponse);     
     
        $Proses1   = json_decode($data_wdsl, TRUE);
        $Proses2   = json_encode($Proses1["ResponseERMultibranch"]); 
        $Proses3   = json_decode($Proses2,TRUE);
        $Print     = json_encode($Proses3['ArrayData']);
        $WSDL      = json_decode($Print,TRUE);

        $cek = $WSDL['ER_NUMBER'];

        if(isset($cek) OR $cek!=''){
            $callback = array(
                    'status'                    => 'success', 
                      
                    'txt_ernumber'                  => $WSDL['ER_NUMBER'], 
                    'txt_beneficiary'           => $WSDL['BENEFICIARY'],
                    'txt_accountnumber'         => $WSDL['ACCOUNT_NUMBER'],
                    'txt_bankname'              => $WSDL['BANK_NAME'], 
                    'txt_taxcode'               => $WSDL['WHT_TAX_CODE'],
                    'txt_amountpaid'            => $WSDL['AMOUNT_PAID'],
                    
                    'button'                     => 'show'
                     

                );
        } else {
             $callback = array(
                    'status'                    => 'failed', 
                     
                    
                    'button'                     => 'hide'
                     

                );
        }

        
        echo json_encode($callback);
    }

}