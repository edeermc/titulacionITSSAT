<?php
namespace App\Request;

use App\Models\OpcionTitulacionModel;
use App\Models\CarreraModel;
use App\Models\TipoDocumentoModel;

class OpcionTitulacionRequest{
    function Agregar(){
        $opc = new OpcionTitulacionModel();
        if ($_POST['id'] != 0)
            $opc = OpcionTitulacionModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $opc->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= $opc->nombre; ?>" class="form-control" required>
                </div>
            </div>

            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Documentos(){
        $opc = new OpcionTitulacionModel();
        if ($_POST['id'] != 0)
            $opc = $opc->getById($_POST['id']);

        $doctos = TipoDocumentoModel::getAll(); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/saveD'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $opc->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= $opc->nombre; ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group">
                <?php foreach ($doctos as $d): ?>
                    <div class="col-sm-4">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="id_docto[]" value="<?= $d->id; ?>"<?= $d->isChecked($opc->id) ? ' checked' : ''; ?>>
                            <?= $d->nombre; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Planes(){
        $opc = new OpcionTitulacionModel();
        if ($_POST['id'] != 0)
            $opc = $opc->getById($_POST['id']);

        $carreras = CarreraModel::getAll(); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/saveP'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $opc->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= $opc->nombre; ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="clearfix"></div>
            <?php foreach ($carreras as $c): ?>
                <?php if (count($c->getPlanes()) > 0): ?>
                    <h5 class="text-center" style="margin: 0">
                        <b><?= $c->nombre; ?></b>
                        <small>
                            ( <label><input type="checkbox" id="todo<?= $c->id; ?>"> Todas</label> )
                        </small>
                    </h5>
                    <div class="form-group" id="carrera<?= $c->id; ?>">
                        <?php foreach ($c->getPlanes() as $p): ?>
                            <div class="col-sm-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="id_plan[]" value="<?= $p->id; ?>"<?= $p->isChecked($opc->id) ? ' checked' : ''; ?>>
                                    <?= $p->nombre; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                        <div class="clearfix"></div>
                        <br>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Eliminar(){
        $opc = OpcionTitulacionModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $opc->id; ?>">
            <h5>Desea eliminar la opción '<?= $opc->nombre; ?>'?</h5>

            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $opc = OpcionTitulacionModel::getAll('', '', $p, 10);
        foreach ($opc as $o) { ?>
            <tr>
                <td><?= $o->id; ?></td>
                <td><?= $o->nombre; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Planes">
                        <i class="fa fa-book"></i> Planes de estudio
                    </button>
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Documentos">
                        <i class="fa fa-files-o"></i> Documentos
                    </button>
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }

    function Buscar(){
        $k = $_POST['key'];
        $opc = OpcionTitulacionModel::getSearch('nombre', $k);

        if (count($opc) > 0) {
            foreach ($opc as $o) { ?>
                <tr>
                    <td><?= $o->id; ?></td>
                    <td><?= $o->nombre; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Planes">
                            <i class="fa fa-book"></i> Planes de estudio
                        </button>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Documentos">
                            <i class="fa fa-files-o"></i> Documentos
                        </button>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $o->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="3" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }
}