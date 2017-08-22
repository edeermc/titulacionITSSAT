<?php
namespace App\Request;

use App\Models\DivisionModel;

class DivisionRequest {
    function Agregar(){
        $division = new DivisionModel();
        if ($_POST['id'] != 0)
            $division = $division->getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $division->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= utf8_encode($division->nombre); ?>"
                           class="form-control" required>
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
        $division = new DivisionModel();
        $division = $division->getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $division->id; ?>">
            <h5>Desea eliminar la division '<?= utf8_encode($division->nombre); ?>'?</h5>

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
        $car = new DivisionModel();
        $division = $car->getSearch('nombre', $k);
        if (count($division) > 0) {
            foreach ($division as $c) { ?>
                <tr>
                    <td><?= $c->id; ?></td>
                    <td><?= utf8_encode($c->nombre); ?></td>
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
                <td colspan="3" class="text-center"> &#161;No existen coincidencias!</td>
            </tr>
            <?php
        }
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $car = new DivisionModel();
        $division = $car->getRange($p, 10);
        foreach ($division as $c) { ?>
            <tr>
                <td><?= $c->id; ?></td>
                <td><?= utf8_encode($c->nombre); ?></td>
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
}