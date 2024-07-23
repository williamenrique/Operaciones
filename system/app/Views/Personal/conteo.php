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
						<li class="breadcrumb-item">Conteo Personal</li>
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
					<div class="card-header d-flex align-items-center">
						<h3 class="card-title">CANT DEL PERSONAL QUE VOTO </h3>
						<h4 class="strong ml-2" id="numbConteo"></h4>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tablePersonalConteo" class="table table-bordered table-striped">
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