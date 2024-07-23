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
						<li class="breadcrumb-item">1X10</li>
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
				<!-- Default box -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Agrege 1x10 del personal</h3>
					</div>
					<div class="card-body">
						<form id="formUnoXDiez">
							<input type="hidden" name="idUnidad" id="idUnidad" value="">
							<div class="form-row align-items-center">
								<div class="col-sm-4 my-1">
									<select id="listPersonal" data-live-search="true" name="listPersonal" class="form-control"
										data-style="btn-outline-primary" data-size="5">
										<option value="0">Seleccione personal</option>
									</select>
								</div>
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Cedula</label>
									<input type="text" class="form-control" placeholder="Cedula" id="txtCedula" name="txtCedula"
										onkeypress="return soloNumeros(event);">
								</div>
								<div class="col-sm-4 my-1">
									<label class="sr-only" for="inlineFormInputName">Nombre y apellido</label>
									<input type="text" class="form-control" placeholder="Nombre y apellido" id="txtNombre"
										name="txtNombre" onkeypress="return soloLetras(event);">
								</div>
								<!-- <div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Telefono</label>
									<input type="text" class="form-control" placeholder="Telefono" id="txtTelefono" name="txtTelefono"
										onkeypress="return soloNumeros(event);">
								</div> -->
								<div class="col-auto my-1">
									<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm ml-3"> <i
											class="fas fa-plus"></i><span id="btnText">Agregar</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<!-- /.card -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Data completa del personal</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tablePersonalVota" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>CEDULA</th>
										<th>NOMBRE Y APELLIDO</th>
										<th>CARGO</th>
										<th>TELEFONO</th>
										<th>VOTO</th>
										<th>1X10</th>
									</tr>
								</thead>
								<tbody></tbody>

							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-4">
					<!-- /.card -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Lista 1X10</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div id="list1x10"></div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footer($data)?>