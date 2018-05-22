<?php
$login = $this->session->userdata('login');
$login_admin = $this->session->userdata('login_admin');

?>
<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<?php if($this->session->userdata('login_admin') !='') { ?>
								<a href="<?=base_url('Admin');?>">Home</a>
								<?php } else { ?>
								<a href="<?=base_url('Home');?>">Home</a>
								<?php } ?>
							</li>

						
							<li class="active">User Profile</li>
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
								User Profile
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?=$data_profil['nama_anggota'];?>
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="space-12"></div>
					  <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                               

                                <?php if($this->session->flashdata('sukses')) { ?>
                    <br>
                    <div class="alert alert-success text-center"><?=$this->session->flashdata('sukses');?></div>
                    <?php } elseif($this->session->flashdata('gagal')) { ?>
                    <br>
                     <div class="alert alert-danger text-center">Upload Foto Gagal, <?=$this->session->flashdata('gagal');?></div>
                     <?php } ?>
                            </div>
                          
                        </div>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
						

								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="<?=$data_profil['nama_anggota'];?>" 
													src="<?=base_url('foto_anggota/'.$data_profil['foto'].'');?>" width="200" height="200"/>
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white">
														<?=$data_profil['nama_anggota'];?>
															</span>
														</a>

														
													</div>
												</div>
											</div>
					

										</div>

					<div class="col-md-6 col-md-6">
											

											
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> ID </div>

													<div class="profile-info-value">
														<span class="editable" id="username">
															<?=$data_profil['id_anggota'];?></span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Nama </div>

													<div class="profile-info-value">
															<span class="editable" id="username">
																<?=$data_profil['nama_anggota'];?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> No HP </div>

													<div class="profile-info-value">
															<span class="editable" id="username">
														<?=$data_profil['no_hp'];?></span>
													</div>
												</div>
											
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Level </div>

													<div class="profile-info-value">
														<span class="editable" id="signup">
															<?=$data_profil['level'];?>
														</span>
													</div>
												</div>
					
												<div class="profile-info-row">
													<div class="profile-info-name"> Last Login </div>

													<div class="profile-info-value">
														<span class="editable" id="login">
													<?=$data_profil['login_time'];?>
            										</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Register Time </div>

													<div class="profile-info-value">
														<span class="editable" id="login">
													<?=$data_profil['register_time'];?>
            										</span>
													</div>
												</div>

											
											</div>

					

											
											

											
										</div>
									</div>
								</div>

								

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->