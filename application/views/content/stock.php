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

            
              <li class="active">Stock</li>
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
                Stock
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Stock Barang
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
             <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Stock Barang
                                    </font>
                                  </h2>
                                </div>
                    <div id="pesan">

                    </div>
                     <?=$this->session->flashdata('pesan');?>
                            </div>
                          
                        </div>
     
            <!-- ============================== FORM ============== -->
                        
<div class="row">
                  <div class="col-xs-12">
                    <h3 class="header smaller lighter blue text-right">
                      
                    </h3>


                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header text-center">
                      List Barang
                    </div>

                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="dt-buttons btn-overlap btn-group btn-overlap">
                    </div>
                    <div class="table-responsive">
                      <table id="stock-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                             <th>No</th>
                           
                
                <th>Nama Barang</th>
                
                <th>Kategori</th>
                <th>Quantity</th> 
                 
                 <th>Ubah Stock</th> 
                          </tr>
                        </thead>

                        <tbody>
                         
                           <?php 
                           $i=1;
                           foreach(json_decode($list_data) as $row) { ?>
          <tr>
            <td><?php echo $i++;?></td>
            
           
            <td><?php echo $row->nama_barang;?></td>
            <td><?php echo $row->nama_kategori;?></td>
            <td><?php echo $row->qty;?></td>
           
            <td><a href="<?=base_url('Home/edit_stock/');?><?=base64_encode($row->id_barang);?>" onclick="return confirm('Edit data ini?');"><i class="fa fa-pencil text-success"></i></a></a></td>
          </tr>
        <?php } ?>
                      
</tbody>
                      </table>
                    </div>
                  </div>
                </div> 
            
</div></div>
    
           
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->