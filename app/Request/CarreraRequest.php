<?php

namespace App\Request;

use App\Models\CarreraModel;

class CarreraRequest {
    function Agregar(){
        $carrera = new CarreraModel();
        if ($_POST['id'] != 0)
            $carrera = CarreraModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $carrera->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= $carrera->nombre; ?>"
                           class="form-control" required>
                </div>

                <label for="siglas" class="col-sm-1 control-label">Siglas</label>
                <div class="col-sm-3">
                    <input type="text" name="siglas" id="siglas" value="<?= $carrera->siglas; ?>" class="form-control"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="modalidad" class="col-sm-2 control-label">Modalidad</label>
                <div class="col-sm-4">
                    <select name="modalidad" id="modalidad" class="form-control">
                        <option value="Escolarizado" <?= ($carrera->modalidad == 'Escolarizado') ? 'selected' : ''; ?>>
                            Escolarizado
                        </option>
                        <option value="Semiescolarizado" <?= ($carrera->modalidad == 'Semiescolarizado') ? 'selected' : ''; ?>>
                            Semiescolarizado
                        </option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" data-dimiss="modal"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Eliminar(){
        $carrera = CarreraModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $carrera->id; ?>">
            <h5>Desea eliminar la carrera
                '<?= ($carrera->nombre); ?><?= ($carrera->modalidad == 'Semiescolarizado') ? ' (Semiescolarizado)' : ''; ?>
                '?</h5>

            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-dimiss="modal"><i class="fa fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $carrera = CarreraModel::getAll('', '', $p, 10);
        foreach ($carrera as $c) { ?>
            <tr>
                <td><?= $c->id; ?></td>
                <td><?= $c->nombre; ?></td>
                <td><?= $c->siglas; ?></td>
                <td><?= $c->modalidad; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>"
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
        $carrera = CarreraModel::getSearch('nombre', $k);

        if (count($carrera) > 0) {
            foreach ($carrera as $c) { ?>
                <tr>
                    <td><?= $c->id; ?></td>
                    <td><?= $c->nombre; ?></td>
                    <td><?= $c->siglas; ?></td>
                    <td><?= $c->modalidad; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="5" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }
}