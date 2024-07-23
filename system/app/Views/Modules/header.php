<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $data['page_tag']?></title>
		<link rel="icon" type="image/png" href="<?= IMG ?>favicon.ico">
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="<?= PLUGINS?>css/all.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/sweetalert2.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/bootstrap-select.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/OverlayScrollbars.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="<?= CSS ?>style.admin.css">
		<link rel="stylesheet" href="<?= CSS ?>adminlte.min.css">
	</head>

	<body class="hold-transition sidebar-mini layout-fixed" onload="mueveReloj()">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a class="nav-link">
							<?= $data['page_tag']?>
						</a>
					</li>
				</ul>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<!-- Notifications Dropdown Menu -->
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="fas fa-cog"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-header">Configuraciones</span>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url()?>" class="dropdown-item">
								<i class="far fa-user mr-2"></i>PERFIL
								<!-- <span class="float-right text-muted text-sm">3 mins</span> -->
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url()?>logout" class="dropdown-item">
								<i class="fas fa-sign-out-alt mr-2"></i>SALIR
								<!-- <span class="float-right text-muted text-sm">3 mins</span> -->
							</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
				<!-- Brand Logo -->
				<a href="<?= base_url()?>" class="brand-link text-center ">
					<span class="brand-text font-weight-light ">Bus Yaracuy</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex" data-toggle="tooltip" data-placement="bottom"
						title="Inf <?= $_SESSION['userData']['user_nick'].' '.$_SESSION['userData']['user_nombres']?>">
						<div class="image">
							<img src="<?= base_url(). $_SESSION['userData']['user_img'] ?>" class="img-circle elevation-2"
								alt="User Image">
						</div>
						<div class="info">
							<a href="#" class="d-block"><?= $_SESSION['userData']['user_nombres']?></a>
							<a href="#" class="d-block" style="font-size: 10px"><?= $_SESSION['userData']['user_email']?></a>
						</div>
					</div>
					<!-- SidebarSearch Form -->
					<div class="form-inline">
						<div class="input-group" data-widget="sidebar-search">
							<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
								<button class="btn btn-sidebar">
									<i class="fas fa-search fa-fw"></i>
								</button>
							</div>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="<?= base_url() ?>" class="nav-link active-home">
									<i class="nav-icon fas fa-th"></i>
									<p>INCIO</p>
								</a>
							</li>

							<li class="nav-item flota">
								<a href="<?= base_url()?>flota" class="nav-link flota-link">
									<i class="nav-icon fas fa-bus"></i>
									<p>FLOTA</p>
								</a>
							</li>

							<li class="nav-item mantenimiento">
								<a href="<?= base_url()?>flota/ingresar_mant" class="nav-link mantenimiento-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>MANTENIMIENTO</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?= base_url()?>usuarios" class="nav-link active-user">
									<i class="nav-icon fas fa-users"></i>
									<p>USUARIOS</p>
								</a>
							</li>


							<li class="nav-item link-data data">
								<a href="<?= base_url()?>mantenimiento" class="nav-link ">
									<i class="nav-icon far fa-list-alt"></i>
									<p>DATA MANTENIMIENTO</p>
								</a>
							</li>

							<li class="nav-item link-statcion statcion">
								<a href="<?= base_url()?>estacion" class="nav-link active-estacion">
									<i class="nav-icon far fa-list-alt"></i>
									<p>ESTACION</p>
								</a>
							</li>


							<li class="nav-item personal-menu ">
								<a href="#" class="nav-link personal">
									<i class="nav-icon fas fa-list"></i>
									<p>DATA PERSONAL<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview ">
									<li class="nav-item link-personal personal">
										<a href="<?= base_url()?>personal/personal" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<p>PERSONAL</p>
										</a>
									</li>
									<li class="nav-item link-unoxdiez">
										<a href="<?= base_url()?>personal/unoxdiez" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<p>1X10</p>
										</a>
									</li>
									<li class="nav-item link-faltante">
										<a href="<?= base_url()?>personal/faltante" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<p>FALTANTES</p>
										</a>
									</li>
									<li class="nav-item link-conteo">
										<a href="<?= base_url()?>personal/conteo" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<span class="right badge badge-danger">New</span>
											<p>CONTEO</p>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item link-grafica grafica">
								<a href="<?= base_url()?>grafica" class="nav-link ">
									<i class="nav-icon fas fa-chart-bar"></i>
									<p>ESTADISTICA</p>
								</a>
							</li>

						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

		</div>