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
						<li class="breadcrumb-item"><a href="<?= base_url()?>dashboard">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url()?>personal/">Personal</a></li>
						<li class="breadcrumb-item">Faltantes</li>
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
						<h3 class="card-title">Personal faltante por cargar 1X10</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tablePersonalF" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>CEDULA</th>
									<th>NOMBRE Y APELLIDO</th>
									<th>CARGO</th>
									<th>TELEFONO</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footer($data)?>