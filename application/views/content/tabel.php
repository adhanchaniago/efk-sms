<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue text-right">
											
										</h3>


										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Results for Report
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div class="dt-buttons btn-overlap btn-group btn-overlap">
										</div>
										<div class="table-responsive">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															NO
														</th>
														<th>PR_NUMBER</th>
														<th>ER_NUMBER</th>
														<th class="hidden-480">VALIDATOR1</th>

														<th>
															
															VALIDATOR2
														</th>
														<th class="hidden-480">CHECKER</th>

														<th>KODE CABANG</th>

														<th>CABANG</th>
														<th>TIPE_ER</th>
														<th>PERIODE</th>
														<th>TGL_INCOM</th>
														<th>TGL_PROS_CHECK</th>
														<th>STATUS</th>

														<th>REMARKS</th>
														<th>TGL_INCOM_FIN</th>
														<th>ACTIVE</th>
														<th>INSERT DATE</th>
														<th>TIPE ER/PR NUMBER</th>
														<th>APPROVERD DATE</th>
														<th>NAME_OF_APPROVERD</th>
														<th>SLA_PR</th>
														<th>SLA_PO</th>
														<th>SLA_ER_DATE</th>
														<th>SLA_KIRIM</th>
														<th>SLA_CABANG</th>
														<th>ACCT</th>
														<th>SLA_FIN</th>
														<th>SLA_HQ</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$i = 1;
													
													foreach ($report['data'] as $key) {
 if($key['CABANG'] =='' OR empty($key['CABANG'])){
            $key['CABANG'] = '';
        }
		if($key['TIPE_ER'] =='' OR empty($key['TIPE_ER'])){
            $key['TIPE_ER'] = '';
        }	
        if($key['STATUS'] =='' OR empty($key['STATUS'])){
            $key['STATUS'] = '';
        }
         if($key['REMARKS'] =='' OR empty($key['REMARKS'])){
            $key['REMARKS'] = '';
        }	
        if($key['KODECABANG'] =='' OR empty($key['KODECABANG'])){
            $key['KODECABANG'] = '';
        }
        if($key['TYPE_PR_ER_NUMBER'] =='' OR empty($key['TYPE_PR_ER_NUMBER'])){
            $key['TYPE_PR_ER_NUMBER'] = '';
        }											$PERIODE                   = substr($key['PERIODE'],0,10);
        $TANGGAL_INCOMING          = substr($key['TANGGAL_INCOMING'],0,10);
        $TANGGAL_PROSES_CHECKER    = substr($key['TANGGAL_PROSES_CHECKER'],0,10);
        $TANGGAL_INCOMING_FINANCE  = substr($key['TANGGAL_INCOMING_FINANCE'],0,10);
         $INSERT_DATE  = substr($key['INSERT_DATE'],0,10);
         $APPROVER_DATE  = substr($key['APPROVER_DATE'],0,10); ?>
													<tr>
														<td  id="no" class="text-bold"><?php echo $i++;?></td>

														  <td  id="prnumber" class="text-bold"><?php echo $key['PR_NUMBER'];?></td>
    													<td id="ernumber" class="text-bold"><?php echo $key['ER_NUMBER'];?></td>
      <td id="validator1" class="text-bold"><?php echo $key['VALIDATOR'];?></td>
      <td id="validator2" class="text-bold"><?php echo $key['VALIDATOR2'];?></td>
      <td id="checker" class="text-bold"><?php echo $key['CHECKER'];?></td>
      <td id="kode_cabang" class="text-bold"><?php echo $key['KODECABANG'];?></td>
       <td id="cabang" class="text-bold"><?php echo str_replace('', 'Asu', $key['CABANG']);?></td>
    													
      <td id="tipe_er" class="text-bold"><?php echo $key['TIPE_ER'];?></td>
      <td id="periode" class="text-bold"><?php echo $PERIODE;?></td>
      <td id="tgl_incom" class="text-bold"><?php echo $TANGGAL_INCOMING;?></td>
      <td id="tgl_pros_check" class="text-bold"><?php echo $TANGGAL_PROSES_CHECKER;?></td>
      <td id="status" class="text-bold"><?php echo $key['STATUS'];?></td>

      <td id="remarks" class="text-bold"><?php echo $key['REMARKS'];?></td>
      <td id="tif" class="text-bold"><?php echo $TANGGAL_INCOMING_FINANCE;?></td>
      <td id="active" class="text-bold"><?php echo $key['ACTIVE'];?></td>
       <td id="insert_date" class="text-bold"><?php echo $INSERT_DATE;?></td>
       <td id="tipeerpr" class="text-bold"><?php echo $key['TYPE_PR_ER_NUMBER'];?></td>
       <td id="appdate" class="text-bold"><?php echo $APPROVER_DATE;?></td>
       <td id="nameapp" class="text-bold"><?php echo $key['NAME_OF_APPROVERD'];?></td>
       <td id="slapr" class="text-bold"><?php echo $key['SLA_PR'];?></td>
       <td id="slapo" class="text-bold"><?php echo $key['SLA_PO'];?></td>
		<td id="slaerdate" class="text-bold"><?php echo $key['SLA_ER_DATE'];?></td>
		<td id="slakirim" class="text-bold"><?php echo $key['SLA_KIRIM'];?></td>	
		<td id="slacabang" class="text-bold"><?php echo $key['SLA_CABANG'];?></td>	
		<td id="acct" class="text-bold"><?php echo $key['ACCT'];?></td>	
		<td id="slafin" class="text-bold"><?php echo $key['SLA_FIN'];?></td>
		<td id="slahq" class="text-bold"><?php echo $key['SLA_HQ'];?></td>
												</tr>
												<?php } ?>
</tbody>
											</table>
										</div>
									</div>
								</div>   