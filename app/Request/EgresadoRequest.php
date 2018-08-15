<?php
namespace App\Request;

use App\Models\EgresadosModel;
use App\Models\PlanEstudiosModel;
use App\Models\Proyecto;

class EgresadoRequest{
    function Agregar(){
        $alumno = new EgresadosModel();
        if ($_POST['id'] != 0)
            $alumno = EgresadosModel::getById($_POST['id']);

        $planes = PlanEstudiosModel::getAll(); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" value="<?=$alumno->id_proyecto; ?>" name="id_proyecto">
            <input type="hidden" value="<?=$alumno->numero_libro; ?>" name="no_libro">
            <input type="hidden" value="<?=$alumno->numero_foja; ?>" name="no_foja">
            <div class="form-group">
                <label for="id" class="col-sm-2 control-label">No Control</label>
                <div class="col-sm-4">
                    <input type="text" name="id" id="id" value="<?=$alumno->id; ?>" class="form-control" placeholder="000A0000" required>
                </div>
            </div>

            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" value="<?= $alumno->nombre; ?>"
                           class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="apellido_paterno" id="apellido_paterno"
                           value="<?= $alumno->apellido_paterno; ?>" class="form-control"
                           placeholder="A Paterno" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="apellido_materno" id="apellido_materno"
                           value="<?= $alumno->apellido_materno; ?>" class="form-control"
                           placeholder="A Materno" required>
                </div>
            </div>
            <div class="form-group">
                <label for="sexo" class="col-sm-2 control-label">Sexo</label>
                <div class="col-sm-2">
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="H"<?= ($alumno->sexo == 'H') ? ' selected' : ''; ?>>H</option>
                        <option value="M"<?= ($alumno->sexo == 'M') ? ' selected' : ''; ?>>M</option>
                    </select>
                </div>
                <label for="id_plan" class="col-sm-4 control-label">Plan Estudios</label>
                <div class="col-sm-4">
                    <select name="id_plan" id="id_plan" class="form-control">
                        <?php foreach ($planes as $p): ?>
                            <option value="<?= $p->id; ?>"<?= ($alumno->id_plan == $p->id) ? ' selected' : ''; ?>><?= $p->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="periodo_ingreso" class="col-sm-2 control-label">Periodo ingreso</label>
                <div class="col-sm-4">
                    <input type="text" name="periodo_ingreso" id="periodo_ingreso"
                           value="<?= $alumno->periodo_ingreso; ?>" class="form-control" required>
                </div>
                <label for="periodo_egreso" class="col-sm-2 control-label">Periodo egreso</label>
                <div class="col-sm-4">
                    <input type="text" name="periodo_egreso" id="periodo_egreso"
                           value="<?= $alumno->periodo_egreso; ?>" class="form-control" required>
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

    function Eliminar(){
        $a = EgresadosModel::getById($_POST['id']); ?>
        <form method="POST" class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $a->id; ?>">
            <h5>Desea eliminar al alumno '<?= $a->getNombreCompleto(); ?>'?</h5>

            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Documentos(){
        $a = EgresadosModel::getById($_POST['id']); ?>
        <form method="POST" class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/validatedoctos'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $a->id; ?>">

            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Documento</th>
                        <th width="20%">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($a->getDocumentos() as $f): ?>
                            <tr>
                                <td>
                                    <a href="<?=resource('documentos/') . to_md5($f->n_control) ."/" . $f->ruta; ?>" target="_blank"><?=$f->getDocumento()->nombre; ?></a>
                                </td>
                                <td class="text-center">
                                    <select name="file_<?=$f->id; ?>" class="form-control input-sm">
                                        <option value="Pendiente" <?=$f->estatus == "Pendiente" ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="Aprobado" <?=$f->estatus == "Aprobado" ? 'selected' : ''; ?>>Aprobado</option>
                                        <option value="Rechazado" <?=$f->estatus == "Rechazado" ? 'selected' : ''; ?>>Rechazado</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="clearfix">
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form> <?php
    }

    function Buscar(){
        $k = $_POST['key'];
        $alumno = EgresadosModel::getAll("CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) LIKE '%{$k}%' OR id LIKE '%{$k}%'");
        if (count($alumno) > 0) {
            foreach ($alumno as $a) { ?>
                <tr>
                    <td><?= $a->id; ?></td>
                    <td><?= $a->getNombreCompleto(); ?></td>
                    <td class="text-center"><?= $a->sexo; ?></td>
                    <td><?= $a->getPlan()->getCarrera()->nombre; ?></td>
                    <td><?= $a->getPlan()->nombre; ?></td>
                    <td class="text-right">
                        <?php if (count($a->getDocumentos()) > 0): ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning">Documentos</button>
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php foreach ($a->getDocumentos() as $f): ?>
                                    <li><a href="<?=resource('documentos/') . to_md5($f->n_control) ."/" . $f->ruta; ?>" target="_blank"><?=$f->getDocumento()->nombre; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $a->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $a->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="6" class="text-center"> &#161;No existen coincidencias!</td>
            </tr>
            <?php
        }
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $alumno = EgresadosModel::getAll('', '', $p, 10);
        foreach ($alumno as $a) { ?>
            <tr>
                <td><?= $a->id; ?></td>
                <td><?= $a->getNombreCompleto(); ?></td>
                <td class="text-center"><?= $a->sexo; ?></td>
                <td><?= $a->getPlan()->getCarrera()->nombre; ?></td>
                <td><?= $a->getPlan()->nombre; ?></td>
                <td class="text-right">
                    <?php if (count($a->getDocumentos()) > 0): ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning">Documentos</button>
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php foreach ($a->getDocumentos() as $f): ?>
                                    <li><a href="<?=resource('documentos/') . to_md5($f->n_control) ."/" . $f->ruta; ?>" target="_blank"><?=$f->getDocumento()->nombre; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $a->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $a->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }
}