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
                 <form role="form" id="barang-form" method="post" action="<?=base_url('Admin/update_barang');?>">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Edit Barang
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
                    <input type="hidden" value="<?=$get_barang['id_barang'];?>" name="id_barang" 
                    id="id_barang"/>
                                <div class="form-group">
                                <label class="control-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" minlength="5" maxlength="50" autofocus="" placeholder="Contoh : Pulpen" value="<?=$get_barang['nama_barang'];?>"/>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Kategori</label>
                                 <select name="id_kategori" id="id_kategori" class="form-control">
                        <option value=''>- Kategori -</option>  
                        <?php
                        foreach(json_decode($list_kategori) as $data){

                        ?>
                         <option value='<?=$data->id_kategori;?>' <?php if($data->id_kategori == $get_barang['id_kategori']) { echo 'selected'; }?>>
                          <?=$data->nama_kategori;?>
                            
                          </option>  
                         <?php } ?>
                        
                      </select>
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Jumlah</label>
                                <input type="number" name="qty" class="form-control" id="qty" placeholder="100" maxlength="5" min="0" max="99999" value="<?=$get_barang['qty'];?>"/>
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