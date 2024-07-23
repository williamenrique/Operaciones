<?php head($data)?>

<!-- page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url()?>dashboard">inicio</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url()?>flota">flota</a></li>
						<li class="breadcrumb-item">Unidad</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<input type="hidden" id="idGetUnidad" value="<?php echo $_GET['unidad']?>">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="unidadH">

					</div>


					<!-- END timeline item -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footer($data)?>