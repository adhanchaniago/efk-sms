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
                <a href="<?=base_url('Admin');?>">Home</a>
              </li>

            
              <li class="active">Admin</li>
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
                Admin
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Data Barang
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
            
     
            <!-- ============================== FORM ============== -->
                 <form role="form" id="barang-form" method="post" action="<?=base_url('Admin/insert_barang');?>">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Barang
                                    </font>
                                  </h2>
                                </div>
                    <div id="pesan">

                    </div>
                     <?=$this->session->flashdata('pesan');?>
                            </div>
                          
                        </div>
                <div class="row">

                  <div class="col-md-3 col-md-offset-1">

                                <div class="form-group">
                                <label class="control-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" minlength="5" maxlength="50" autofocus="" placeholder="Contoh : Pulpen" />
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Kategori</label>
                                 <select name="nama_kategori" id="nama_kategori" class="form-control">
                        <option value=''>- Kategori -</option>  
                        <?php
                        foreach(json_decode($list_kategori) as $data){

                        ?>
                         <option value='<?=$data->id_kategori;?>'><?=$data->nama_kategori;?></option>  
                         <?php } ?>
                        
                      </select>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                             
                             
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Jumlah</label>
                               
                          
                            <span class="editable-container editable-inline">
                              <div>
                                <div class="editableform-loading" style="display: none;">
                                  <i class="ace-icon fa fa-spinner fa-spin fa-2x light-blue">
                                    
                                  </i></div>
                                  <div class="control-group form-group">
                                    <div>
                                      <div class="editable-input">
                                        <div class="ace-spinner middle touch-spinner" style="width: 140px;">
                                          <div class="input-group">
                                            <div class="spinbox-buttons input-group-btn">         <button type="button" class="btn spinbox-down btn-sm btn-danger" id="min">          
                                             <i class="icon-only  ace-icon fa fa-minus"></i>         </button>       
                                           </div>
                                           <input type="number" name="qty" class="form-control" id="qty" placeholder="100" maxlength="5" min="1" max="99999" value="1"/>

                                           <div class="spinbox-buttons input-group-btn">        
                                             <button type="button" class="btn spinbox-up btn-sm btn-success" id="plus">            
                                              <i class="icon-only  ace-icon fa fa-plus"></i>          </button>       </div>

                                            </div></div></div></span>
                                             <span class="help-block" id="error"></span><div class="editable-buttons"></div></div><div class="editable-error-block help-block" style="display: none;"></div></div></div>
                         
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>

                               <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>"/>
                        </div>
                        
                      <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                           
                          
                           
                            <div class="submit text-center">
                                <button type="submit" id="btn-pendaftaran" name="btn-pendaftaran" class="btn btn-primary btn-raised btn-square btn-md">Submit</button>
                            </div>
                            </div>
                </div>
                

           
               
            
                  
    </form>
                        
<div class="row">
                  <div class="col-xs-12">
                    <h3 class="header smaller lighter blue text-right">
                      
                    </h3>


                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header text-center">
                      List Akses
                    </div>

                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="dt-buttons btn-overlap btn-group btn-overlap">
                    </div>
                    <div class="table-responsive">
                      <table id="barang-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                             <th>No</th>
                           
                
                <th>Nama Barang</th>
                
                <th>Kategori</th>
                <th>Quantity</th> 
                 
                 <th>Action</th> 
                          </tr>
                        </thead>

                        <tbody>
                         
                           <?php 
                           $i=1;
                           foreach(json_decode($list_barang) as $row) { ?>
          <tr>
            <td><?php echo $i++;?></td>
            
           
            <td><?php echo $row->nama_barang;?></td>
            <td><?php echo $row->nama_kategori;?></td>
            <td><?php echo $row->qty;?></td>
           
            <td><a href="<?=base_url('Admin/edit_barang/');?><?=base64_encode($row->id_barang);?>" onclick="return confirm('Edit data ini?');"><i class="fa fa-pencil text-success"></i></a>&nbsp; | &nbsp;<a href="<?=base_url('Admin/delete_barang/');?><?=base64_encode($row->id_barang);?>" onclick="return confirm('Hapus data ini?');"><i class="fa fa-trash text-danger"></i></a></td>
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