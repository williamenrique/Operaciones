<?php head($data)?>
<!-- page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Graficas votantes 2024</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url()?>dashboard">Home</a></li>
						<li class="breadcrumb-item">Grafica</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Default box -->
				<div class="col-md-6">
					<div class="card">
						<div>
							<canvas id="chartPersonal"></canvas>
						</div>
					</div>

				</div>
				<!-- /.card -->
				<div class="col-md-6">
					<div class="card">
						<canvas id="chart1x10"></canvas>
					</div>
				</div>
			</div>
	</section>
</div>
<!-- /.content-wrapper -->
<?php footer($data)?>