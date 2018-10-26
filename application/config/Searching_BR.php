<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   $cek=$_POST['txt_noerpr'];
// ========================================================================== fsGetDataOrafin ===========================================================================
// ======================================================================================================================================================================
        $url = 'http://172.16.1.225:5222/ws/com.baf.ws.ws_DataERPR/com_baf_ws_ws_DataERPR_Port'; 

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
// ======================================================================================================================================================================

// ======================================================================= fsGetDataPRSharepoint ========================================================================
        $url = 'http://172.16.1.225:5222/ws/com.baf.ws.ws_DataERPR/com_baf_ws_ws_DataERPR_Port'; 
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
               
                
// ======================================================================================================================================================================

// ======================================================================= fsGetDataPRSharepointHQ ======================================================================
 /*       $url = 'http://172.16.1.225:5222/ws/com.baf.ws.ws_DataERPR/com_baf_ws_ws_DataERPR_Port'; 
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
   


$cek = $WSDL[0]['PR_NUMBER'];
$cek1 = $WSDL[0]['ER_NUMBER'];
$pr = $WSDL['PR_NUMBER'];
$er = $WSDL['ER_NUMBER'];
if(!empty($cek) AND !empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
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
                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );
} elseif(!empty($cek) AND !empty($cek1) AND empty($pr) AND empty($PR_NUMBER1)){
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
                  'txt_validator1'  => '',
                    'txt_validator2'  => '',
                    'txt_checker'     => '',
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'button'  => 'save'

                     

                );
}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
    $end = end($WSDL);
      $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
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
                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );

}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND !empty($PR_NUMBER1)){
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
                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );

}elseif(empty($cek) AND !empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
    $end = end($WSDL);
     $PRDATE0               = substr($end['pr_date'],0,10);
        $ER_DATE0              = substr($end['ER_DATE'],0,10);
        $PO_DATE0              = substr($end['PO_DATE'],0,10);
        $ACC_DATE0             = substr($end['ACCOUNTING_DATE'],0,10);
        $APP_DATE0             = substr($end['PR_APPROVED_DATE'],0,10);
         $PAY_DATE0            = substr($end['PAYMENT_DATE'],0,10);
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
                    'txt_validator1'  => '',
                    'txt_validator2'  => '',
                    'txt_checker'     => '',
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'button'  => 'save'
                     

                );
}elseif(!empty($cek) AND empty($cek1)  AND empty($pr) AND empty($PR_NUMBER1)){
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
                    'txt_validator1'  => '',
                    'txt_validator2'  => '',
                    'txt_checker'     => '',
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'button'  => 'save'
                     

                );
} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND !empty($PR_NUMBER1)){
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
                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );

} elseif(empty($cek) AND empty($cek1) AND !empty($pr) AND empty($PR_NUMBER1)){
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
                     'txt_validator1'  => '',
                    'txt_validator2'  => '',
                    'txt_checker'     => '',
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'button'  => 'save'
                     

                );

}else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND empty($ER_NUMBER1)) {
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
                     'txt_validator1'  => '',
                    'txt_validator2'  => '',
                    'txt_checker'     => '',
                    'txt_tipeer'      => '',
                    'txt_periode'     => '',
                    'txt_ti'          => '',
                    'txt_tpc'         => '',
                    'txt_status'      => '',
                    'txt_remarks'     => '',
                    'txt_tif'         => '',
                    'txt_tipeerpr'    => '',
                    'txt_dep'         => '',
                    'button'  => 'save'
                     

                );

}  else if(empty($pr) AND !empty($er) AND empty($PR_NUMBER1) AND !empty($ER_NUMBER1)) {
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
                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND !empty($PR_NUMBER1)){
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

                    'txt_validator1'  => $WSDL_GETBRANCH['VALIDATOR'],
                    'txt_validator2'  => $WSDL_GETBRANCH['VALIDATOR2'],
                    'txt_checker'     => $WSDL_GETBRANCH['CHECKER'],
                    'txt_tipeer'      => $WSDL_GETBRANCH['TIPE_ER'],
                    'txt_periode'     => $PERIODE,
                    'txt_ti'          => $TANGGAL_INCOMING,
                    'txt_tpc'         => $TANGGAL_PROSES_CHECKER,
                    'txt_status'      => $WSDL_GETBRANCH['STATUS'],
                    'txt_remarks'     => $WSDL_GETBRANCH['REMARKS'],
                    'txt_tif'         => $TANGGAL_INCOMING_FINANCE,
                    'txt_tipeerpr'    => $WSDL_GETBRANCH['TYPE_PR_ER_NUMBER'],
                    'txt_dep'         => $WSDL_GETBRANCH['CABANG'],
                    'button'  => 'hide'
                     

                );

}elseif(empty($cek) AND empty($cek1) AND empty($pr) AND empty($er) AND empty($PR_NUMBER1)){
  $callback = array('status' => 'failed',
    'button'  => 'hide'); 
}

echo json_encode($callback); 


                // echo "<pre>";
                // print_r($WSDL);
                // echo "</pre><br>";

                //  echo "<pre>";
                // $end = end($WSDL);
                // print_r(end($WSDL));
                // echo "PR NUMBER ARRAY terakhir ".$end['ER_NUMBER'];
                // echo "</pre>";

                // echo "<pre>";
                // print_r(count($WSDL));
                // echo "</pre>";
?>
