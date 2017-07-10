<?php

require_once '../../vendor/autoload.php';

use App\Models\CarreraModel;

$funcion = $_POST['function'];
call_user_func($funcion);

function Agregar(){
	if ($_POST['id'] == 0)
		$carrera = new CarreraModel();
	else
		$carrera = CarreraModel::getById($_POST['id']); ?>
	<form action="<?=route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
		<input type="hidden" name="id" value="<?=$carrera->id; ?>">
		<div class="form-group">
			<label for="nombre" class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-4">
				<input type="text" name="nombre" id="nombre" value="<?=$carrera->nombre; ?>" class="form-control" required>
			</div>

			<label for="modalidad" class="col-sm-2 control-label">Modalidad</label>
			<div class="col-sm-4">
				<select name="modalidad" id="modalidad" class="form-control">
					<option value="Escolarizado" <?=($carrera->modalidad == 'Escolarizado') ? 'selected' : ''; ?>>Escolarizado</option>
					<option value="Semiescolarizado" <?=($carrera->modalidad == 'Semiescolarizado') ? 'selected' : ''; ?>>Semiescolarizado</option>
				</select>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-sm-12 text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
	<?php
}

function Eliminar(){
	$carrera = CarreraModel::getById($_POST['id']); ?>
	<form action="<?=route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
		<input type="hidden" name="id" value="<?=$carrera->id; ?>">
		<h5>¿Desea eliminar la carrera '<?=$carrera->nombre; ?><?=($carrera->modalidad == 'Semiescolarizado') ? ' (Semiescolarizado)' : ''; ?>'?</h5>

		<div class="form-group">
			<div class="col-sm-12 text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
	<?php
}