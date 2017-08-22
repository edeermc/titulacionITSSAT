<?php
namespace App\Request;

use App\Models\PlanEstudiosModel;
use App\Models\CarreraModel;

class PlanRequest{
    function Agregar(){
        $plan = new PlanEstudiosModel();
        if ($_POST['id'] != 0)
            $plan = $plan->getById($_POST['id']);

        $carrera = new CarreraModel();
        $carrera = $carrera->getAll(); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $plan->id; ?>">
                <label for="nombre" class="col-sm-2">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" value="<?= utf8_decode($plan->nombre); ?>" class="form-control" required>
                </div>

                <label for="carrera" class="col-sm-2">Carrera</label>
                <div class="col-sm-4">
                    <select name="id_carrera" id="carrera" class="form-control">
                        <?php foreach ($carrera as $c): ?>
                            <option value="<?=$c->id; ?>" <?=($c->id == $plan->id_carrera) ? 'selected' : '' ?>>
                                <?=utf8_encode($c->nombre); ?> <?=($c->modalidad != 'Escolarizado') ? '- '.$c->modalidad : ''; ?>
                            </option>
                        <?php endforeach; ?>
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
        $plan = new PlanEstudiosModel();
        $plan = $plan->getById($_POST['id']); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $plan->id; ?>">
            <h5>Desea eliminar el plan de estudios '<?= utf8_decode($plan->nombre); ?>'?</h5>

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

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $plan = new PlanEstudiosModel();
        $plan = $plan->getRange($p, 10);
        foreach ($plan as $pl) { ?>
            <tr>
                <td><?= $pl->id; ?></td>
                <td><?= utf8_encode($pl->nombre); ?></td>
                <td><?= utf8_encode($pl->getCarrera()->nombre); ?> <?=$pl->getCarrera()->modalidad == 'Semiescolarizado' ? ' - '.$pl->getCarrera()->modalidad : ''; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $pl->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $pl->id; ?>" data-model="<?=$_POST['model']; ?>"
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
        $plan = new PlanEstudiosModel();
        $plan = $plan->getSearch('nombre', $k);

        if (count($plan) > 0) {
            foreach ($plan as $p) { ?>
                <tr>
                    <td><?= $p->id; ?></td>
                    <td><?= utf8_encode($p->nombre); ?></td>
                    <td><?= utf8_encode($p->getCarrera()->nombre); ?> <?=$pl->getCarrera()->modalidad == 'Semiescolarizado' ? ' - '.$pl->getCarrera()->modalidad : ''; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $p->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $p->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="4" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }
}