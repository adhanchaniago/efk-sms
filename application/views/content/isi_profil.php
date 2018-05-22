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

            
              <li class="active">Profile</li>
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
                Profile
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Isi Profile
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
            
     
            <!-- ============================== FORM ============== -->
                 <form role="form" id="profil-form" method="post" action="<?=base_url('Home/insert_profil');?>" enctype="multipart/form-data">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Isi Profile Kamu
                                    </font>
                                  </h2>
                                </div>
                             
                    <div id="pesan">

                    </div>
                                <?=$this->session->flashdata('pesan');?>
                    <br>
                  
                   
                            </div>
                          
                        </div>
                       
                <div class="row">

                  
                     
                            <div class="col-md-3 col-md-offset-3">

                                <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" minlength="5" maxlength="50" autofocus="" />
                                 <span class="help-block" id="error"></span>
                            </div>
                            </div>
                           
                          
                            
                        </div>
                        
                        


                         

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                           
                           
                           
                           <input type="hidden" name="<?=$csrf_name;?>" value="<?=$csrf_hash;?>"/>
                          
                           
                            <div class="submit text-center">
                                <button type="submit" id="btn-pendaftaran" name="btn-pendaftaran" class="btn btn-primary btn-raised btn-square btn-md">Submit</button>
                            </div>
                            </div>
                        </div>
                         
                    
                        
                      </strong></h4></div>
                    </div>
                  </div>
                 
                        </form>

           
               
            
                  
    </form>
     
    
            
</div></div>
    
           
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->