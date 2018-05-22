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
                  Data Hak Akses
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
            
     
            <!-- ============================== FORM ============== -->
                 <form role="form" id="akses-form" method="post" action="<?=base_url('Admin/update_akses');?>">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Edit Hak Akses
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
                                <label class="control-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" minlength="10" maxlength="15" autofocus="" placeholder="Contoh : 089687610639" value="<?=$get_akses['no_hp'];?>" readonly="" />
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                           
                             <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Status Aktif</label>
                                <select name="status" id="status" class="form-control">
                        <option value=''>- Status -</option>  
                         <option value='0' <?php if($get_akses['status'] == '0') { echo 'selected';} ?>>Tidak Aktif</option>  
                          <option value='1' <?php if($get_akses['status'] == '1') { echo 'selected';} ?>>Aktif</option>  
                      </select>
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