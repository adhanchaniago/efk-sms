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

            
              <li class="active">Log</li>
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
                Log
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Log Stock Barang
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="space-12"></div>
             <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="text-center alert alert-info">
                                  <h2>
                                    <font class="text-center text-primary">Log Stock Barang
                                    </font>
                                  </h2>
                                </div>
                    <div id="pesan">

                    </div>
                     <?=$this->session->flashdata('pesan');?>
                            </div>
                          
                        </div>
     
            <!-- ============================== FORM ============== -->
                        
        <div class="widget-box transparent">
                       
                        <div class="widget-body">
                          <div class="widget-main padding-8">
                            <div id="profile-feed-1" class="profile-feed">
                               <?php foreach (json_decode($list_data) as $data) { ?>
                              <div class="profile-activity clearfix">
                               
                                 
                                
                                <div>
                                  <img class="pull-left" alt="Alex Doe's avatar" src="<?=base_url('foto_anggota/'.$data->foto);?>" />
                                  <a class="user" href="#"> <?=$data->nama_anggota;?> </a>
                                  <?php if($data->in_stock!='') {
                                    echo '<font class="text-primary">'.$data->keterangan.' <strong>(IN)</strong></font> <strong>('.$data->nama_barang.' - '.
                                    $data->nama_kategori.')</strong>  Sebanyak <strong>('.$data->in_stock.' Buah)</strong> | Sign : <strong>'.$data->sign.'</strong> | Stock Sebelumnya : <strong>'.($data->stock_before).'</strong>  | Stock Sekarang : <strong>'.$data->on_stock.'</strong> | Note : <strong>'.$data->notes.'</strong>';
                                  } else {
                                   echo '<font class="text-danger">'.$data->keterangan.' <strong>(OUT)</strong></font> <strong>('.$data->nama_barang.' - '.
                                    $data->nama_kategori.')</strong>  Sebanyak <strong>('.$data->out_stock.' Buah)</strong> | Sign : <strong>'.$data->sign.'</strong> |  Stock Sebelumnya : <strong>'.$data->stock_before.'</strong>  | Stock Sekarang : <strong>'.$data->on_stock.'</strong> | Note : <strong>'.$data->notes.'</strong>';
                                  }
                                  ?>
                                 

                                  <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    <?=$data->created_time;?>
                                  </div>
                                </div>
                               
                                
                              </div>
                               <?php } ?>
                          </div>
                          </div>
                        </div>
                      </div>

            
</div></div>
    
           
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->