<?php

require_once '../../vendor/autoload.php';

use App\Models\PerfilModel;

$funcion = $_POST['function'];
call_user_func($funcion);

function Agregar(){
	if ($_POST['id'] == 0)
		$perfil = new PerfilModel();
	else
		$perfil = PerfilModel::getById($_POST['id']); ?>
	<form action="<?=route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
		<input type="hidden" name="id" value="<?=$perfil->id; ?>">
		<div class="form-group">
			<label for="nombre" class="col-sm-1">Nombre</label>
			<div class="col-sm-3">
				<input type="text" name="nombre" id="nombre" value="<?=utf8_decode($perfil->nombre); ?>" class="form-control" required>
			</div>
		</div>

		<div class="form-group text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</form>
	<?php
}

function Eliminar(){
	$perfil = PerfilModel::getById($_POST['id']); ?>
	<form action="<?=route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
		<input type="hidden" name="id" value="<?=$perfil->id; ?>">
		<h5>¿Desea eliminar el perfil '<?=utf8_decode($perfil->nombre); ?>'?</h5>

		<div class="form-group">
			<div class="col-sm-12 text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
	<?php
}