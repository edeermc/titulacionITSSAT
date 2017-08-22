<?php
namespace App\Request;

use App\Models\DocenteModel;
use App\Models\CarreraModel;
use App\Models\DivisionModel;

class DocenteRequest{
    function Agregar(){
        $docente = new DocenteModel();
        if ($_POST['id'] != 0)
            $docente = $docente->getById($_POST['id']);

        $carreras = new CarreraModel();
        $carreras = $carreras->getAll();

        $divisiones = new DivisionModel();
        $divisiones = $divisiones->getAll(); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $docente->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" value="<?= utf8_encode($docente->nombre); ?>"
                           class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="apellido_paterno" id="apellido_paterno"
                           value="<?= utf8_encode($docente->apellido_paterno); ?>" class="form-control"
                           placeholder="A Paterno" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="apellido_materno" id="apellido_materno"
                           value="<?= utf8_encode($docente->apellido_materno); ?>" class="form-control"
                           placeholder="A Materno" required>
                </div>
            </div>
            <div class="form-group">
                <label for="sexo" class="col-sm-2 control-label">Sexo</label>
                <div class="col-sm-2">
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="H"<?= ($docente->sexo == 'H') ? ' selected' : ''; ?>>H</option>
                        <option value="M"<?= ($docente->sexo == 'M') ? ' selected' : ''; ?>>M</option>
                    </select>
                </div>
                <label for="cedula" class="col-sm-4 control-label">Cédula profesional</label>
                <div class="col-sm-4">
                    <input type="text" name="cedula_profesional" id="cedula"
                           value="<?= utf8_encode($docente->cedula_profesional); ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="division" class="col-sm-2 control-label">División</label>
                <div class="col-sm-4">
                    <select name="division" id="division" class="form-control">
                        <?php foreach ($divisiones as $d): ?>
                            <option value="<?= $d->id; ?>"<?= ($docente->id_division == $d->id) ? ' selected' : ''; ?>><?= utf8_encode($d->nombre); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label for="carrera" class="col-sm-2 control-label">Carrera</label>
                <div class="col-sm-4">
                    <select name="carrera" id="carrera" class="form-control">
                        <?php foreach ($carreras as $c): ?>
                            <option value="<?= $c->id; ?>"<?= ($docente->id_carrera == $c->id) ? ' selected' : ''; ?>><?= utf8_encode($c->nombre) . ($c->modalidad == 'Semiescolarizado' ? ' - Semiescolarizado' : ''); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo" class="col-sm-2 control-label">Tipo</label>
                <div class="col-sm-3">
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="Docente"<?= ($docente->tipo == 'Docente') ? ' selected' : ''; ?>>Docente</option>
                        <option value="Presidente"<?= ($docente->tipo == 'Presidente') ? ' selected' : ''; ?>>Presidente</option>
                        <option value="Secretario"<?= ($docente->tipo == 'Secretario') ? ' selected' : ''; ?>>Secretario</option>
                        <option value="JefeCarrera"<?= ($docente->tipo == 'JefeCarrera') ? ' selected' : ''; ?>>Jefe de carrera</option>
                    </select>
                </div>

                <label for="estatus" class="col-sm-2 control-label">Participa</label>
                <div class="col-sm-2">
                    <select name="estatus" id="estatus" class="form-control">
                        <option value="Si"<?= ($docente->estatus == 'Si') ? ' selected' : ''; ?>>Si</option>
                        <option value="No"<?= ($docente->estatus == 'No') ? ' selected' : ''; ?>>No</option>
                    </select>
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
        $d = new DocenteModel();
        $d = $d->getById($_POST['id']); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $d->id; ?>">
            <h5>Desea eliminar al docente '<?= utf8_encode($d->getNombreCompleto()); ?>'?</h5>

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

    function Buscar(){
        $k = $_POST['key'];
        $docente = new DocenteModel();
        $docente = $docente->getSearch('CONCAT(nombre,\' \',apellido_paterno,\' \',apellido_materno)', $k);
        if (count($docente) > 0) {
            foreach ($docente as $d) { ?>
                <tr>
                    <td><?= $d->id; ?></td>
                    <td><?= utf8_encode($d->getNombreCompleto()); ?></td>
                    <td class="text-center"><?= $d->sexo; ?></td>
                    <td><?= $d->cedula_profesional; ?></td>
                    <td><?= utf8_encode($d->getDivision()->nombre); ?></td>
                    <td><?= utf8_encode($d->getCarrera()->nombre); ?></td>
                    <td class="text-center"><i
                                class="fa fa-check <?= ($d->estatus == 'Si') ? 'text-primary' : 'text-muted'; ?>"></i>
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $d->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $d->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="8" class="text-center"> &#161;No existen coincidencias!</td>
            </tr>
            <?php
        }
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $docente = new DocenteModel();
        $docente = $docente->getRange($p, 10);
        foreach ($docente as $d) { ?>
            <tr>
                <td><?= $d->id; ?></td>
                <td><?= utf8_encode($d->getNombreCompleto()); ?></td>
                <td class="text-center"><?= $d->sexo; ?></td>
                <td><?= $d->cedula_profesional; ?></td>
                <td><?= utf8_encode($d->getDivision()->nombre); ?></td>
                <td><?= utf8_encode($d->getCarrera()->nombre); ?></td>
                <td class="text-center"><i
                            class="fa fa-check <?= ($d->estatus == 'Si') ? 'text-primary' : 'text-muted'; ?>"></i></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $d->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $d->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }
}