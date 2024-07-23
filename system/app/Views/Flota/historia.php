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
						<li class="breadcrumb-item"><a href="<?= base_url()?>inicio">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url()?>flota">Flota</a></li>
						<li class="breadcrumb-item">Historia</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Historia de cambios en las unidades</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table class="table stripe hover nowrap table-sm" id="tableHistoria" style="width: 100%;">
								<thead>
									<tr>
										<th>ID</th>
										<th>MODELO</th>
										<th>VIN</th>
										<th>CAMBIO</th>
										<th>OBS</th>
										<th>FECHA</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>MODELO</th>
										<th>VIN</th>
										<th>CAMBIO</th>
										<th>OBS</th>
										<th>FECHA</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.card-body -->
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