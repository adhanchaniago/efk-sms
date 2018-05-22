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
            
     
            <!-- ============================== FORM ============== -->
                 <form role="form" id="stock-form" method="post" action="<?=base_url('Home/update_stock');?>">
                   <input type="hidden" id="stock" value="<?=$stock['qty'];?>"/>
                   <input type="hidden" name="id_kategori" id="id_kategori" value="<?=$stock['id_kategori'];?>"/>
                    <input type="hidden" name="id_barang" id="id_barang" value="<?=$stock['id_barang'];?>"/>
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Edit Stock Barang
                                    </font>
                                  </h2>
                                </div>
                    <div id="pesan">

                    </div>
                     <?=$this->session->flashdata('pesan');?>
                            </div>
                          
                        </div>
                <div class="row">

                  <div class="col-md-3 col-md-offset-3">

                                <div class="form-group">
                                <label class="control-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" maxlength="50" value="<?=$stock['nama_barang'];?>" readonly/>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Stock</label>
                                <input type="text" class="form-control" value="<?=$stock['qty'];?>" readonly/>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                            

                               <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>"/>
                        </div>

                         <div class="row">

                  <div class="col-md-3 col-md-offset-3">

                                <div class="form-group">
                                <label class="control-label">Kategori</label>
                                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" maxlength="50" value="<?=$stock['nama_kategori'];?>" readonly/>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>

                             
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Note (opsional)</label>
                                <input type="text" name="note" class="form-control" id="note" maxlength="50" placeholder="Contoh : Untuk Keperluan Mengajar" />
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                            
                             

                               <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>"/>
                        </div>

                         <div class="row">

                  <div class="col-md-3 col-md-offset-3">
                                <div class="form-group">
                                <label class="control-label">In</label>
                               
                          
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
                                            <div class="spinbox-buttons input-group-btn">         <button type="button" class="btn spinbox-down btn-sm btn-danger" id="min_in">          
                                             <i class="icon-only  ace-icon fa fa-minus"></i>         </button>       
                                           </div>
                                           <input type="number" name="qty_in" class="form-control" id="qty_in" placeholder="100" maxlength="5" min="0" max="99999"/>

                                           <div class="spinbox-buttons input-group-btn">        
                                             <button type="button" class="btn spinbox-up btn-sm btn-success" id="plus_in">            
                                              <i class="icon-only  ace-icon fa fa-plus"></i>          </button>       </div>

                                            </div></div></div></span>
                                             <span class="help-block" id="error"></span><div class="editable-buttons"></div></div><div class="editable-error-block help-block" style="display: none;"></div></div></div>
                         
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                           
                             
                             
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Out</label>
                               
                          
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
                                            <div class="spinbox-buttons input-group-btn">         <button type="button" class="btn spinbox-down btn-sm btn-danger" id="min_out">          
                                             <i class="icon-only  ace-icon fa fa-minus"></i>         </button>       
                                           </div>
                                           <input type="number" name="qty_out" class="form-control" id="qty_out" placeholder="100" maxlength="5" min="0" max="99999"/>

                                           <div class="spinbox-buttons input-group-btn">        
                                             <button type="button" class="btn spinbox-up btn-sm btn-success" id="plus_out">            
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
                        

            
</div></div>
    
           
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->