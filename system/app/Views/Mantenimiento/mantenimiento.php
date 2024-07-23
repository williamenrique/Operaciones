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
						<li class="breadcrumb-item"><a href="<?= base_url()?>flota">Flota</a></li>
						<li class="breadcrumb-item">Ingresar</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content" id="edit">
		<div class="container-fluid">
			<div class="col-12">
				<!-- /.card -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"></h3>
					</div>
					<div class="card-body">
						<table class="table stripe hover table-sm" id="tableDataMant" style="width: 100%;">
							<thead>
								<tr>
									<th scope="col">UNIDAD</th>
									<th scope="col">ENTRADA</th>
									<th scope="col">SALIDA</th>
									<th scope="col">DIAGNOSTICO</th>
									<th scope="col">RECOMENDACION</th>
									<th scope="col">ENCARGADO</th>
									<th scope="col">BORRAR</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footer($data)?>
<!-- table table-striped table-bordered -->