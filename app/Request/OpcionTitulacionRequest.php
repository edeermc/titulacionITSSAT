<?php
require_once '../../vendor/autoload.php';

use App\Models\OpcionTitulacionModel;
use App\Models\CarreraModel;

$funcion = $_POST['function'];
call_user_func($funcion);

function Agregar(){
    $opc = new OpcionTitulacionModel();
    if ($_POST['id'] != 0)
        $opc = $opc->getById($_POST['id']);

    $carreras = new CarreraModel();
    $carreras = $carreras->getAll(); ?>
    <form action="<?=route($_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
        <input type="hidden" name="id" value="<?=$opc->id; ?>">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-6">
                <input type="text" name="nombre" id="nombre" value="<?=utf8_encode($opc->nombre); ?>" class="form-control" required>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php foreach ($carreras as $c): ?>
            <?php if(count($c->getPlanes()) > 0): ?>
                <h5 class="text-center" style="margin: 0"><b><?=utf8_encode($c->nombre);?></b></h5>
                <div class="container">
                    <?php foreach ($c->getPlanes() as $p): ?>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="id_plan[]" value="<?=$p->id; ?>"<?=$p->isChecked($opc->id) ? ' checked': ''; ?>>
                            <?=$p->nombre; ?>
                        </label>
                    <?php endforeach; ?>

                    <div class="clearfix"></div>
                    <br>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

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
    $opc = new OpcionTitulacionModel();
    $opc = $opc->getById($_POST['id']); ?>
    <form action="<?=route($_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
        <input type="hidden" name="id" value="<?=$opc->id; ?>">
        <h5>Desea eliminar la carrera '<?=$opc->nombre; ?>'?</h5>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
            </div>
        </div>
    </form>
    <?php
}

function Paginacion(){
    $p = 10 * ($_POST['page'] - 1);
    $opc = new OpcionTitulacionModel();
    $opc = $opc->getRange($p, 10);
    foreach ($opc as $o){ ?>
        <tr>
            <td><?=$o->id; ?></td>
            <td><?=utf8_encode($o->nombre); ?></td>
            <td><?=count($o->getPlanes()); ?> planes de estudio</td>
            <td class="text-right">
                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#operationModal" data-id="<?=$o->id; ?>" data-model="OpcionTitulacion" data-operation="Editar">
                    <i class="fa fa-edit"></i> Editar
                </button>
                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#operationModal" data-id="<?=$o->id; ?>" data-model="OpcionTitulacion" data-operation="Eliminar">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
        <?php
    }
}

function Buscar(){
    $k = $_POST['key'];
    $opc = new OpcionTitulacionModel();
    $opc = $opc->getSearch('nombre', $k);

    if(count($opc) > 0) {
        foreach ($opc as $o) { ?>
            <tr>
                <td><?= $o->id; ?></td>
                <td><?= utf8_encode($o->nombre); ?></td>
                <td><?= count($o->getPlanes()); ?> planes de estudio</td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="OpcionTitulacion"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="OpcionTitulacion"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    } else{ ?>
        <tr>
            <td colspan="5" class="text-center">
                &#161;No se han encontrado coincidencias!
            </td>
        </tr>
        <?php
    }
}