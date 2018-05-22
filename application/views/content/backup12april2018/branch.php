<?php
$csrf_name = $this->security->get_csrf_token_name(); 
$csrf_hash = $this->security->get_csrf_hash();
?>

<div class="main-content">
                        <div class="main-content-inner">
                              <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                                    <ul class="breadcrumb">
                                          <li>
                                                <i class="ace-icon fa fa-home home-icon"></i>
                                                <a href="#">Home</a>
                                          </li>

                                    
                                          <li class="active">Branch</li>
                                    </ul><!-- /.breadcrumb -->

                                    <div class="nav-search" id="nav-search">
                                          <form class="form-search">
                                                <span class="input-icon">
                                                      
                                                </span>
                                          </form>
                                    </div><!-- /.nav-search -->
                              </div>

                              <div class="page-content">
                                    

                                    <div class="page-header">
                                          <h1>
                                                Branch
                                                <small>
                                                      <i class="ace-icon fa fa-angle-double-right"></i>
                                                      ER - TRACKING
                                                </small>
                                          </h1>
                                    </div><!-- /.page-header -->
                                    <div class="space-24"></div>
                                    

                                    <!-- ============================== FORM ============== -->
                                      <form method="POST" id="dialog_edit_profile" name="dialog_edit_profile">
                              <div class="col-md-11">
                                    <div class="row">
                                              <input type="hidden" name="txt_tipe" id="txt_tipe" class="form-control" style="width:220px;" value="<?=$this->session->userdata('ac');?>" readonly>
                                           <input type="hidden" name="txt_nameapp" id="txt_nameapp" value="<?=$this->session->userdata('ac');?>">
                                           <input type="hidden" name="htxt_nameapp" id="htxt_nameapp">
      <!-- ============================== KIRI ============== -->
            <div class="col-md-6">

                        <div class="row">
                        <div class="form-group">
                        <div class="col-md-5">
                              <label> Your NIK :  </label>&nbsp;<label id="tips1" style="color:#0069d9;"> <?=$this->session->userdata('ac');?></label>
                        </div>
                       
                       
                        </div>
                        </div>
                              <div class="space-2"></div>
                         <div class="row">
                        <div class="form-group">
                        <div class="col-md-7">
                             <label> Status :  </label>&nbsp;<label id="data" style="color:#4CAF50;"> </label><label id="nodata" style="color:#F44336;"> </label>
                        </div>
                       
                       
                        </div>
                        </div>
<div class="space-24"></div>
                  <div class="row">
                        <div class="form-group">
                        <div class="col-md-5">
                              <label>NO PR / ER / INV : </label>
                        </div>
                        <div class="col-md-4">
                        
                              <input type="text" name="txt_noerpr" id="txt_noerpr" class="form-control" autofocus onkeyup="CheckKey(event)" data-placement="bottom" data-original-title="Input NO ER / PR"  title="Input No ER / PR">
                              
                        </div>
                        <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>">
                        <div class="col-md-3">
                        
                              
                              <button type="button" class="btn btn-primary btn-sm" id="btn-search">Search</button> 
                
                        </div>
                        </div>
                        </div>
                    
                              <div class="space-24"></div>
                  <div class="row">
                        <div class="form-group">
                        <div class="col-md-5">
                              <label>NO PR : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" type="text" name="txt_nopr" id="htxt_nopr" title="NO PR" data-placement="bottom" data-original-title="NO PR">
                        </div>
                        </div>
                        </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>NO ER : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" type="text" name="txt_noer" id="htxt_noer" title="NO ER" data-placement="bottom" data-original-title="NO ER">
                        </div>
                  
                        </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>NO INVOICE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" type="text" name="txt_inv" id="txt_inv" title="INVOICE" data-placement="bottom" data-original-title="INVOICE">
                        </div>
                  
                        </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>ER DATE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_erdate" id="txt_erdate" title="ER DATE"  data-placement="bottom" data-original-title="ER DATE">
                        </div>
                  
                        </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>PR_APPROVED_DATE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" title="PR APPROVED DATE" data-placement="bottom" data-original-title="PR APPROVED DATE" name="txt_appdate" id="txt_appdate">
                        </div>
                  
                        </div>
                        <div class="space-2"></div>
                        <div class="row" id='hidden2'>
                        
                        <div class="col-md-5">
                              <label>PAY GROUP : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" type="text" name="txt_paygroup" id="txt_paygroup" title="PAY GROUP" data-placement="bottom" data-original-title="PAY GROUP">
                        </div>
                  
                        </div>
                       <!--  <?php if($user =='Ya') { ?>
                        <div class="space-2"></div>
                        <div class="row" >
                        
                        <div class="col-md-5">
                              <label>AMOUNT : </label>
                        </div>
                        <div class="col-md-7">
                        <div class="input-group">

  <span class="input-group-addon" id="basic-addon1">IDR</span>
  <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="txt_amount" id="txt_amount"  title="AMOUNT" data-placement="bottom" data-original-title="AMOUNT">
</div>
                        </div>
                  
                        </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>NAMA KEGIATAN / BARANG : </label>
                        </div>
                        <div class="col-md-7">
                        <textarea  class="form-control" type="text" title="NAMA KEGIATAN" data-placement="bottom" data-original-title="NAMA KEGIATAN" rows="4" name="txt_kegiatan" id="txt_kegiatan"></textarea>
                        </div>
                  
                        </div>
                        <?php } ?> -->
                        <div class="space-24"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>AKTIFKAN : </label>
                        </div>
                        <div class="col-md-7">
                        <select name="aktif" id="aktif" class="">
                               <option value="nonaktif">Non Aktif</option>
                                     <option value="aktifkan">Aktifkan</option>
                              </select>
                        </div>
                  
                        </div>
                        <div class="space-24"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>CHECKER : </label>
                        </div>
                        <div class="col-md-7">
                              <select class="chosen-select" data-placeholder="Checker" name="txt_checker" id="txt_checker">
                                    <option value="">-- Checker --</option>

                                    <?php
                                    $query = $this->db->query('SELECT DISTINCT CHECKER FROM checker ORDER BY CHECKER ASC');
                                    
                                    foreach($query->result() as $data){
                                    ?>
                                    <option value="<?=$data->CHECKER;?>"><?=$data->CHECKER;?></option>
                                    <?php } ?>
                              </select>
                        
                        </div>
                  
                        </div>
                              <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>VALIDATOR 1 : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" type="text" name="txt_validator1" id="txt_validator1" title="VALIDATOR 1" data-placement="bottom" data-original-title="VALIDATOR 1" readonly="">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>PERIODE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_periode" id="txt_periode" title="PERIODE" data-placement="bottom" data-original-title="PERIODE">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>TGL PROSES CHECKER : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_tpc" id="txt_tpc" title="TANGGAL PROSES CHECKER" data-placement="bottom" data-original-title="TANGGAL PROSES CHECKER">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>STATUS : </label>
                        </div>
                        <div class="col-md-7">
                        <select name="txt_status" id="txt_status" class="">
                        <option value=''>Status</option>  
                        <option value='Validate'> Validate</option>  
                        <option value='Pending'> Pending</option>  
                        <option value='Cancel'> Cancel</option>
                        
                        
                      </select>
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>DEPARTMENT : </label>
                        </div>
                        <div class="col-md-7">
                        <select name="txt_dep" id="txt_dep" class="chosen-select">
                        <option value=''>- DEPARTMENT -</option>  
                        <?php
                        foreach($departement as $data){

                        ?>
                         <option value='<?=$data->Title;?>'><?=$data->Title;?></option>  
                         <?php } ?>
                        
                      </select>
                        </div>
                  
                        </div>

                        </div>
                        <!-- ============================== KANAN ============== -->
                    <div class="col-md-6">
                           <div class="row">
                        
                        </div>
                        <div class="space-24"></div>
                         <div class="space-24"></div>
                          <div class="space-24"></div>
                           <div class="space-8"></div>
                        <div class="row">
                        <div class="form-group">
                        <div class="col-md-5">
                              <label>TIPE : </label>
                        </div>
                        <div class="col-md-4">
                        
                              <select name="txt_tipeer" id="txt_tipeer" class="form-control">
                        <option value=''>Silahkan Pilih Tipe ER</option>  
                        <option value='MultiPaid'> MultiPaid</option>  
                        <option value='MultiBranch'> MultiBranch</option>  
                        <option value='Business_Trip'> Business Trip</option>
                        <option value='Expense_Request'> Expense Request</option>  
                        
                      </select>
                              
                        </div>
                       
                        </div>
                        </div>
                        <div class="space-24"></div>
                  <div class="row">
                        
                        <div class="col-md-5">
                              <label>PR DATE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_prdate" id="txt_prdate" title="PR DATE" data-placement="bottom" data-original-title="PR DATE">
                        </div>
                        
                        </div>
                        <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>PO_DATE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_podate" id="txt_podate" title="PO DATE" data-placement="bottom" data-original-title="PO DATE">
                        </div>
                  
                        </div>

                              <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>ACCOUNTING DATE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_accdate" id="txt_accdate" title="ACCOUNTING DATE" data-placement="bottom" data-original-title="ACCOUNTING DATE">
                        </div>
                  
                        </div>
                              
                                    <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>TANGGAL CAIR : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_tglcair" id="txt_tglcair" title="TANGGAL CAIR" data-placement="bottom" data-original-title="TANGGAL CAIR">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>BRANCH ID : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" data-date-format="yyyy-mm-dd" type="text" name="txt_branchid" id="txt_branchid" title="BRANCH ID" data-placement="bottom" data-original-title="BRANCH ID">
                        </div>
                  
                        </div>
 <!-- <?php if($user =='Ya') { ?>
                        <div class="space-2"></div>
                        <div class="row" id='hidden1'>
                        
                        <div class="col-md-5">
                              <label>BENEFICIARY : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" data-date-format="yyyy-mm-dd" type="text" name="txt_beneficiary" id="txt_beneficiary" title="BENEFICIARY" data-placement="bottom" data-original-title="BENEFICIARY">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        <div class="row" id='hidden3'>
                        
                        <div class="col-md-5">
                              <label>ACCOUNT NUMBER : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" data-date-format="yyyy-mm-dd" type="text" name="txt_accnumber" id="txt_accnumber" title="ACCOUNT NUMBER" data-placement="bottom" data-original-title="ACCOUNT NUMBER">
                        </div>
                  
                        </div>
                        <?php } ?> -->
                        <?php 
                       
                        
                              $j = 8;
                        
                        for($i=1;$i<$j;$i++){ ?>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                             
                        </div>
                        <div class="col-md-7">
                        &nbsp;
                        </div>
                  
                        </div>
                        <?php } ?>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>TIPE ER : </label>
                        </div>
                        <div class="col-md-7">
                        <select name="txt_tipeerpr" id="txt_tipeerpr" class="chosen-select">
                        <option value=''>- TIPE ER -</option>  
                        <?php
                        foreach($tipeer as $data){

                        ?>
                         <option value='<?=$data->TIPE_ER;?>'><?=$data->TIPE_ER;?></option>  
                         <?php } ?>
                        
                      </select>
                        </div>
                                    </div>
                        <div class="space-2"></div>
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>VALIDATOR 2 : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" data-date-format="yyyy-mm-dd" type="text" name="txt_validator2" id="txt_validator2" title="VALIDATOR 2" data-placement="bottom" data-original-title="VALIDATOR 2" readonly="">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>TANGGAL INCOMING : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_ti" id="txt_ti" title="TANGGAL INCOMING" data-placement="bottom" data-original-title="TANGGAL INCOMING">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>TANGGAL INCOMING FINANCE : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txt_tif" id="txt_tif" title="TANGGAL INCOMING FINANCE" data-placement="bottom" data-original-title="TANGGAL INCOMING FINANCE">
                        </div>
                  
                        </div>

                        <div class="space-2"></div>
                        
                        <div class="row">
                        
                        <div class="col-md-5">
                              <label>REMARKS : </label>
                        </div>
                        <div class="col-md-7">
                        <input  class="form-control" data-date-format="yyyy-mm-dd" type="text" name="txt_remarks" id="txt_remarks" title="REMARKS" data-placement="bottom" data-original-title="REMARKS">
                        </div>
                  
                        </div>
                    

                        </div>

                  </div>
                  <div class="space-10"></div>
                  <div class="col-md-12 text-center">
                    <input class="form-control btn btn-primary" type=
               <?php if(empty($this->session->userdata('superUser')) OR $this->session->userdata('superUser') !='Ya' OR $this->session->userdata('cek') == 'Cabang'){
                  echo 'hidden';
               
         } else {
              echo 'button';
        } ?>  name="btn_save" id="btn_save" value="SAVE" style="width:200px;display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
               <input class="form-control btn btn-danger" type=
               <?php if(empty($this->session->userdata('superUser')) OR $this->session->userdata('superUser') !='Ya' OR $this->session->userdata('cek') == 'Cabang'){
                  echo 'hidden';
               
         } else {
              echo 'button';
        } ?>  name="btn_update" id="btn_update" value="UPDATE" style="width:200px;display:none;">

                  </div>
                  </div>

                   <input type="hidden" name="txt_slapr" id="txt_slapr"/>
<input type="hidden" name="txt_slapo" id="txt_slapo"/>
<input type="hidden" name="txt_slaerdate" id="txt_slaerdate"/>
<input type="hidden" name="txt_slakirim" id="txt_slakirim"/>
<input type="hidden" name="txt_slacabang" id="txt_slacabang"/>
<input type="hidden" name="txt_acct" id="txt_acct"/>
<input type="hidden" name="txt_slafin" id="txt_slafin"/>
<input type="hidden" name="txt_slahq" id="txt_slahq"/>
<input type="hidden" name="kode_cabang" id="kode_cabang"/>
            </form>
            
            <div class="col-md-11">
                  <div class="space-24"></div><div class="space-24"></div>
    <table cellspacing="1" cellpadding="1" class="table table-responsive text-center table-bordered1">
  <tbody>
  <thead>
  <tr>
  <td colspan="8">SLA (days)</td>
  </tr>
   <tr>
      <td>SLA PR</td>
      <td>SLA PO</td>
      <td>SLA ER DATE</td>
      <td>SLA KIRIM</td>
      <td>SLA CABANG</td>
      <td>ACCT</td>
      <td>SLA FIN</td>
      <td>SLA HQ</td>
    </tr>
     <tr>
      <td id="slapr" class="text-bold">&nbsp;</td>
      <td id="slapo" class="text-bold">&nbsp;</td>
      <td id="slaerdate" class="text-bold">&nbsp;</td>
      <td id="slakirim" class="text-bold">&nbsp;</td>
      <td id="slacabang" class="text-bold">&nbsp;</td>
      <td id="acct" class="text-bold">&nbsp;</td>
      <td id="slafin" class="text-bold">&nbsp;</td>
      <td id="slahq" class="text-bold">&nbsp;</td>
    </tr>
  </thead>
   
  </tbody>
</table>
</div>
            
           
                              </div><!-- /.page-content -->
                        </div>
                  </div><!-- /.main-content -->

                <script type="text/javascript">
                       $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#txt_checker" ).autocomplete({
      source: availableTags
    });
  } );

                </script>