<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="navbar" class="navbar navbar-default          ace-save-state navbar-fixed-top">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?=base_url('Admin');?>" class="navbar-brand">
						<small>
							<i class="fa fa-search"></i>
							<?=project_name;?>
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								
								<span class="user-info">
									<small>Admin, </small> 
									<?=$nama;?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							

								<li>
									<a href="<?=base_url('Admin/profile');?>">
										<i class="ace-icon fa fa-user-circle-o"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?=base_url('login/logout');?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state sidebar-fixed" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<!-- <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div> -->

					<img src="<?=base_url('template/assets/images');?>/logo.png" style="height: 100px; width: 150px;"/>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<ul class="nav nav-list">
				<?php if($url=='Admin/index' OR $url=='Admin'){
					echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				}
					?>
						<a href="<?=base_url('Admin');?>">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Home </span>
						</a>

						<b class="arrow"></b>
					</li>

						<?php if($url=='Admin/profile' OR $url=='admin/profile'){
					echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				}
					?>
						<a href="<?php echo base_url('Admin/profile');?>">
							<i class="menu-icon fa fa-user-circle-o"></i>
							<span class="menu-text"> Profile </span>
						</a>

						<b class="arrow"></b>
					</li>

				<?php if($url=='Admin/input_barang' OR $url=='admin/input_barang' OR $url1=='edit_barang' OR $url=='Admin/akses' OR $url=='admin/akses' OR $url1=='edit_akses'
					OR $url=='Admin/kategori' OR $url=='admin/kategori' OR $url1=='edit_kategori'
					OR $url=='Admin/barang' OR $url=='admin/barang' OR $url1=='edit_barang'){
					echo '<li class="active open">';
					 } else { 
					echo '<li class="">';
				}
					?>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog fa-spin"></i>
							<span class="menu-text"> Admin </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($url=='Admin/akses' OR $url=='admin/akses' OR $url1=='edit_akses') { 
							echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				} ?>
								<a href="<?php echo base_url('Admin/akses');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Akses
								</a>

								<b class="arrow"></b>
							</li>
				<?php if($url=='Admin/kategori' OR $url=='admin/kategori' OR $url1=='edit_kategori') { 
							echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				} ?>
								<a href="<?php echo base_url('Admin/kategori');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kategori Barang
								</a>

								<b class="arrow"></b>
							</li>
							<?php if($url=='Admin/barang' OR $url=='admin/barang' OR $url1=='edit_barang') { 
							echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				} ?>
								<a href="<?php echo base_url('Admin/barang');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Input Barang
								</a>

								<b class="arrow"></b>
							</li>

						

							
						</ul>
					</li>
					

					
					
					<?php if($url=='Admin/log' OR $url=='admin/log'){
					echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				}
					?>
						<a href="<?php echo base_url('Admin/log');?>">
							<i class="menu-icon fa fa-file-text"></i>
							<span class="menu-text"> Log Stock </span>
						</a>
                    
                    	<?php if($url=='Admin/report' OR $url=='admin/report'){
					echo '<li class="active">';
					 } else { 
					echo '<li class="">';
				}
					?>
						<a href="<?php echo base_url('Admin/report');?>">
							<i class="menu-icon fa fa-file-excel-o"></i>
							<span class="menu-text"> Report </span>
						</a>

						<b class="arrow"></b>
					</li>
						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->
				<center>
				<span class="bigger-80">
						Waktu Load : <font class="text-primary">{elapsed_time}	Detik</font>	
							<div class="space-2"></div>
							Memori Terpakai : <font class="text-primary">{memory_usage}</font>

						</span>
					</center>
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
