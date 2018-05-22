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
                 <form role="form" id="akses-form" method="post" action="<?=base_url('Admin/insert_akses');?>">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Hak Akses
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
                                <label class="control-label">NO HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" minlength="5" maxlength="15" autofocus="" placeholder="Contoh : 089687610639" />
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
                      <table id="akses-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                             <th>No</th>
                           
                <th>No HP</th>
               
                
                <th>Status</th>
                <th>Level</th> 
                 <th>Login Time</th> 
                 <th>Logout Time</th> 
                 <th>Action</th> 
                          </tr>
                        </thead>

                        <tbody>
                         
                           <?php 
                           $i=1;
                           foreach(json_decode($list_akses) as $row) { ?>
          <tr>
            <td><?php echo $i++;?></td>
            
            <td><?php echo $row->no_hp;?></td>
            
             <td><?php if($row->status=='0') { 
                  echo '<font class="text-danger">Tidak Aktif</font>';
                  } else {
                  echo '<font class="text-success">Aktif</font>';
                  }?> 
            </td>
            <td><?php echo $row->level;?></td>
            <td><?php echo $row->login_time;?></td>
            <td><?php echo $row->logout_time;?></td>
            <td><a href="<?=base_url('Admin/edit_akses/');?><?=base64_encode($row->no_hp);?>" onclick="return confirm('Edit data ini?');"><i class="fa fa-pencil text-success"></i></a>&nbsp; | &nbsp;<a href="<?=base_url('Admin/delete_akses/');?><?=base64_encode($row->no_hp);?>" onclick="return confirm('Hapus data ini?');"><i class="fa fa-trash text-danger"></i></a></td>
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