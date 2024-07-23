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
						<li class="breadcrumb-item">Flota</li>
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
						<h3 class="card-title">Agrege una nueva unidad</h3>
					</div>
					<div class="card-body">
						<form id="formUnidad">
							<input type="hidden" name="idUnidad" id="idUnidad" value="">
							<div class="form-row align-items-center">
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Id Unidad</label>
									<input type="text" class="form-control" placeholder="Id de unidad" id="txtIdUnidad"
										name="txtIdUnidad">
								</div>
								<div class="col-sm-3 my-1">
									<select class="custom-select" name="listMarcaUnidad" id="listMarcaUnidad">
										<option selected>Marca Unidad</option>
										<option value="YUTONG">YUTONG</option>
										<option value="INTERNATIONAL">INTERNATIONAL</option>
										<option value="FREITHLINE">FREITHLINE</option>
										<option value="ENCAVA">ENCAVA</option>
									</select>
								</div>
								<div class="col-sm-3 my-1">
									<select id="listModelo" data-live-search="true" name="listModelo" class="form-control"
										data-style="btn-outline-primary" data-size="5">
										<option value="0">Seleccione modelo</option>
									</select>
								</div>
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Vim Unidad</label>
									<input type="text" class="form-control" placeholder="Vim Unidad" id="txtVimUnidad"
										name="txtVimUnidad">
								</div>
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Fecha Unidad</label>
									<input type="text" class="form-control" placeholder="Fecha Unidad" id="txtFechaUnidad"
										name="txtFechaUnidad">
								</div>
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Capacidad</label>
									<input type="text" class="form-control" placeholder="Capacidad" id="txtCapacidad" name="txtCapacidad"
										onkeypress="return soloNumeros(event);">
								</div>
								<div class="col-sm-3 my-1">
									<label class="sr-only" for="inlineFormInputName">Tipo Combustible</label>
									<input type="text" class="form-control" placeholder="Tipo Combustible" id="txtTipoCombustible"
										name="txtTipoCombustible" onkeypress="return soloLetras(event);">
								</div>
								<div class="col-auto my-1">
									<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm ml-3"> <i
											class="fas fa-plus"></i><span id="btnText">Agregar</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- /.card -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Data completa de la flota</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tableFlota" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>MARCA</th>
									<th>MODELO</th>
									<th>VIM</th>
									<th>FECHA</th>
									<th>CAPACIDAD</th>
									<th>TIPO</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>MARCA</th>
									<th>MODELO</th>
									<th>VIM</th>
									<th>FECHA</th>
									<th>CAPACIDAD</th>
									<th>TIPO</th>
									<th>STATUS</th>
								</tr>
							</tfoot>
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