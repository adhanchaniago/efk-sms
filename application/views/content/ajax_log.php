<div class="widget-box transparent" id="media">
                       
                        <div class="widget-body">
                          <div class="widget-main padding-8">
                            <div id="profile-feed-1" class="profile-feed">
                               <?php foreach (json_decode($list_data) as $data) { ?>
                              <div class="profile-activity clearfix">
                               
                                 
                                
                                <div>
                                  <img class="pull-left" alt="<?=$data->nama_anggota;?>" src="<?=base_url('foto_anggota/'.$data->foto);?>" />
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