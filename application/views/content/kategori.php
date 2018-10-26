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
                  Data Kategori Barang
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
            
     
            <!-- ============================== FORM ============== -->
                 <form role="form" id="kategori-form" method="post" action="<?=base_url('Admin/insert_kategori');?>">
                    <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Tambah, Edit, Delete <b>Kategori Barang</b>
                                    </font>
                                  </h2>
                                </div>
                    <div id="pesan">

                    </div>
                     <?=$this->session->flashdata('pesan');?>
                            </div>
                          
                        </div>
                <div class="row">

                  <div class="col-md-4 col-md-offset-4">

                                <div class="form-group">
                                <label class="control-label">Nama Kategori Barang</label>
                                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" minlength="5" maxlength="50" autofocus="" placeholder="Contoh : Kokoru Foam"/>
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
                      List Data Kategori
                    </div>

                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="dt-buttons btn-overlap btn-group btn-overlap">
                    </div>
                    <div class="table-responsive">
                      <table id="kategori-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                             <th>No</th>
                           
               
                <th>Nama Kategori</th>
                
                <th>Created Time</th>
                <th>Created By</th> 
                
                 <th>Action</th> 
                          </tr>
                        </thead>

                        <tbody>
                         
                           <?php 
                           $i=1;
                           foreach(json_decode($list_kategori) as $row) { ?>
          <tr>
            <td><?php echo $i++;?></td>
            
            
            <td><?php echo $row->nama_kategori;?></td>
            <td><?php echo $row->created_time;?></td>
            <td><?php echo $row->created_by;?></td>
            
            <td><a href="<?=base_url('Admin/edit_kategori/');?><?=base64_encode($row->id_kategori);?>" onclick="return confirm('Edit data ini?');"><i class="fa fa-pencil text-success"></i></a>&nbsp; | &nbsp;<a href="<?=base_url('Admin/delete_kategori/');?><?=base64_encode($row->id_kategori);?>" onclick="return confirm('Hapus data ini?');"><i class="fa fa-trash text-danger"></i></a></td>
          </tr>
        <?php } ?>
                      
</tbody>
                      </table>
                    </div>
                  </div>
                </div> 

           
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->