<?php

require_once '../../vendor/autoload.php';

use App\Models\TipoDocumentoModel;

$funcion = $_POST['function'];
call_user_func($funcion);

function Agregar(){
    $tipoDocumento = new TipoDocumentoModel();
    if ($_POST['id'] != 0)
        $tipoDocumento = $tipoDocumento->getById($_POST['id']); ?>
    <form action="<?=route('TipoDocumento/save'); ?>" method="POST" class="form-horizontal">
        <input type="hidden" name="id" value="<?=$tipoDocumento->id; ?>">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-6">
                <input type="text" name="nombre" id="nombre" value="<?=utf8_encode($tipoDocumento->nombre); ?>" class="form-control" required>
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
    $c = new TipoDocumentoModel();
    $documento = $c->getById($_POST['id']); ?>
    <form action="<?=route('TipoDocumento/del'); ?>" method="POST" class="form-horizontal">
        <input type="hidden" name="id" value="<?=$documento->id; ?>">
        <h5>&#191;Desea eliminar el documento'<?=$documento->nombre; ?>'?</h5>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
            </div>
        </div>
    </form>
    <?php
}

function Buscar(){
    $k = $_POST['key'];
    $docto = new TipoDocumentoModel();
    $documento = $docto->getSearch('nombre', $k);

    if(count($documento)>0)
    {
        foreach ($documento as $c){ ?>
            <tr>
                <td><?=$c->id; ?></td>
                <td><?=utf8_encode($c->nombre); ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#operationModal" data-id="<?=$c->id; ?>" data-model="tipoDocto" data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#operationModal" data-id="<?=$c->id; ?>" data-model="tipoDocto" data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }

    else
    {
        ?>
            <tr>
                <td colspan="3" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
        <?php
    }
}


function Paginacion(){
    $p = 10 * ($_POST['page'] - 1);
    $docto = new TipoDocumentoModel();
    $documento = $docto->getRange($p, 10);
    foreach ($documento as $c){ ?>
        <tr>
            <td><?=$c->id; ?></td>
            <td><?=utf8_encode($c->nombre); ?></td>
            <td class="text-right">
                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#operationModal" data-id="<?=$c->id; ?>" data-model="tipoDocto" data-operation="Editar">
                    <i class="fa fa-edit"></i> Editar
                </button>
                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#operationModal" data-id="<?=$c->id; ?>" data-model="tipoDocto" data-operation="Eliminar">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
        <?php
    }
}
