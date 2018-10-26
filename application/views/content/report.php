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
								<a href="<?=base_url('Home');?>">Home</a>
							</li>

						
							<li class="active">Report</li>
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
								Report
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Export To Excel
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="space-12"></div>
						

						<!-- ============================== FORM ============== -->
						 <form method="POST" id="report-form" action="<?=base_url($url);?>">
					<div class="col-xs-11">
						<div class="row">
                                           
	<!-- ============================== KIRI ============== -->
            <div class="col-xs-6">
<?php
if(isset($_GET['sukses'])){
      echo '<div class="alert alert-success text-center">Input Data Berhasil</div>';
} elseif(isset($_GET['gagal'])){
      echo '<div class="alert alert-danger text-center">Input Data Gagal</div>';
}


?>
  <div class="row">
            		<div class="form-group">
            		<div class="col-md-5">
            			<label>Tanggal Awal : </label>
            		</div>
            		<div class="col-md-7">
            		<input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_awal" id="tgl_awal" title="Tanggal Awal" data-placement="bottom" data-original-title="Tanggal Awal" autocomplete="off">
                  <span class="help-block" id="error"></span>
            		</div>
              </div>
            	
            		</div>
            		  <div class="space-12"></div>
            		<div class="row">
            		<div class="form-group">
            		<div class="col-md-5">
            			<label>Tanggal Akhir : </label>
            		</div>
            		<div class="col-md-7">
            		<input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_akhir" id="tgl_akhir" title="Tanggal Akhir" data-placement="bottom" data-original-title="Tanggal Akhir" autocomplete="off">
                  <span class="help-block" id="error"></span>
            		</div>
            	 </div>
            		</div>

            		<div class="space-12"></div>
            		<div class="row">
                        
                        <div class="col-md-5">
                             &nbsp;
                        </div>
                        <div class="col-xs-7 text-center">
                           <button type="submit" class="btn btn-primary" id="btn-search">Cari</button>
                        </div>
                  
                        </div>
            		</div>
            		
            		 <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>"/>
        </form>
          
        <div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue text-right">
											
										</h3>


										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header text-center">
											
                      <?php if($this->input->post('tgl_awal') !='' OR 
                              $this->input->get('tgl_awal') !='') {?>

                      Laporan Tanggal : 
                      <u><?=$tgl_awal;?></u> Sampai 
                      <u><?=$tgl_akhir;?></u>
                      <?php } else { ?> 
                        List Laporan
                      <?php } ?>         
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div class="dt-buttons btn-overlap btn-group btn-overlap">
										</div>
										<div class="table-responsive">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Barang</th>
														<th>Stok Sekarang</th>
														<th>In</th>
														<th>Out</th>
                                                        <th>Stok Sebelumnya</th>
														<th>Sign</th>

														<th>Keterangan</th>

														<th>Notes</th>
														<th>Tanggal Log</th>
														<th>Edited By</th>
														
													</tr>
												</thead>
                        <?php if($report['id_barang']!=''){ ?>
                        <tbody>
													<?php
													$i = 1;
													
													
                          if($report['in_stock'] =='' OR empty($report['in_stock'])){
                                $report['in_stock'] = '';
                            }
                    		if($report['out_stock'] =='' OR empty($report['out_stock'])){
                                $report['out_stock'] = '';
                            }	
                           ?>
                    													
                            <tr>
							<td  id="no" class="text-bold"><?php echo $i++;?></td>

					        <td  id="prnumber" class="text-bold"><?php echo $report['nama_barang'];?></td>
    						<td id="ernumber" class="text-bold"><?php echo $report['on_stock'];?></td>
    						<td id="invnumber" class="text-bold"><?php echo $report['in_stock'];?></td>
                            <td id="validator1" class="text-bold"><?php echo $report['out_stock'];?></td>
                            <td id="validator2" class="text-bold"><?php echo $report['stock_before'];?></td>
                            <td id="checker" class="text-bold"><?php echo $report['sign'];?></td>
                            <td id="kode_cabang" class="text-bold"><?php echo $report['keterangan'];?></td>
                            <td id="kode_cabang" class="text-bold"><?php echo $report['notes'];?></td>
    													
                            <td id="tipe_er" class="text-bold"><?php echo $report['created_time'];?></td>
                            <td id="tipe_er" class="text-bold"><?php echo $report['nama_anggota'];?></td>
      
												</tr>
												
                </tbody><?php } else { ?>
											
							<tbody>
													<?php
													$i = 1;
													
													foreach ($report as $key) {
        if($key['in_stock'] =='' OR empty($key['in_stock'])){
            $key['in_stock'] = '-';
        }
        if($key['out_stock'] =='' OR empty($key['out_stock'])){
            $key['out_stock'] = '-';
        }
		?>
		<tr>
			<td  id="no" class="text-bold"><?php echo $i++;?></td>

					        <td  id="prnumber" class="text-bold"><?php echo $key['nama_barang'];?></td>
    						<td id="ernumber" class="text-bold"><?php echo $key['on_stock'];?></td>
    						<td id="invnumber" class="text-bold"><?php echo $key['in_stock'];?></td>
                            <td id="validator1" class="text-bold"><?php echo $key['out_stock'];?></td>
                            <td id="validator2" class="text-bold"><?php echo $key['stock_before'];?></td>
                            <td id="checker" class="text-bold"><?php echo $key['sign'];?></td>
                            <td id="kode_cabang" class="text-bold"><?php echo $key['keterangan'];?></td>
                            <td id="kode_cabang" class="text-bold"><?php echo $key['notes'];?></td>
    													
                            <td id="tipe_er" class="text-bold"><?php echo $key['created_time'];?></td>
                            <td id="tipe_er" class="text-bold"><?php echo $key['nama_anggota'];?></td>
      
												</tr>
												<?php } ?>
</tbody><?php } ?>
											</table>
										</div>
									</div>
								</div>       
            
                
		
            <div class="col-md-11">
                  <div class="space-24"></div><div class="space-24"></div>


</div>
</div></div>
		
           
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->