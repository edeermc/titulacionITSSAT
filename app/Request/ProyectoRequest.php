<?php

namespace App\Request;

use App\Models\ProyectoModel;

class ProyectoRequest {
    function Agregar(){
        $proyecto = new ProyectoModel();
        if ($_POST['id'] != 0)
            $proyecto = $proyecto->getById($_POST['id']); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $proyecto->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= utf8_encode($proyecto->nombre); ?>"
                           class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
                <div class="col-sm-9">
                    <textarea name="observaciones" id="observaciones" cols="30" rows="4" class="form-control"><?=(utf8_encode($proyecto->observaciones)); ?></textarea>
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

    function Alumnos(){
        $proyecto = new ProyectoModel();
        $proyecto = $proyecto->getById($_POST['id']); ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4>
                        <i class="fa fa-star"></i>
                        <?=utf8_encode($proyecto->nombre); ?> <br>
                        <small><b><?=utf8_encode($proyecto->getOpcion()->nombre); ?> (En curso)</b></small>
                    </h4>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-2 text-right"><b>Integrantes:</b></div>
                <div class="col-sm-4">
                    <?php foreach ($proyecto->getAlumnos() as $a){ ?>
                        <?=utf8_encode($a->getNombreCompleto()); ?><br>
                    <?php } ?>
                </div>
                <div class="col-sm-2 text-right"><b>Asesor(es):</b></div>
                <div class="col-sm-4">
                    <?=utf8_encode($proyecto->getAsesor()->getNombreCompleto()); ?><br>
                    <?=utf8_encode($proyecto->getAsesor2()->getNombreCompleto()); ?>
                </div>
                <div class="clearfix"></div>

                <?php if(!empty($proyecto->observaciones)){ ?>
                    <div class="col-sm-2 text-right" style="margin-top: 25px"><b>Observaciones:</b></div>
                    <div class="col-sm-9" style="margin-top: 25px">
                        <i><?=nl2br(utf8_encode($proyecto->observaciones)); ?></i>
                    </div>
                <?php } ?>

                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        <?php
    }

    function Dictamen(){
        $proyecto = new ProyectoModel();
        $proyecto = $proyecto->getById($_POST['id']);?>
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                Cancelar
            </button>
        </div>
        <?php
    }

    function Eliminar(){
        $proyecto = new ProyectoModel();
        $proyecto = $proyecto->getById($_POST['id']); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $proyecto->id; ?>">
            <h5>Desea eliminar el proyecto '<?= utf8_encode($proyecto->nombre); ?>'?</h5>

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
        $proyecto = new ProyectoModel();
        $proyecto = $proyecto->getRange($p, 10);
        foreach ($proyecto as $pr) { ?>
            <tr>
                <td><?= $pr->id; ?></td>
                <td><?= utf8_encode($pr->nombre); ?></td>
                <td class="text-right">
                    <?php if(count($pr->getAlumnos()) > 0){ ?>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Alumnos">
                            <i class="fa fa-users"></i> Ver alumnos
                        </button>
                    <?php } ?>
                    <?php if(count($pr->getPresidente()) > 0){ ?>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Dictamen">
                            <i class="fa fa-users"></i> Dictamen
                        </button>
                    <?php } ?>

                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
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
        $proyecto = new ProyectoModel();
        $proyecto = $proyecto->getSearch('nombre', $k);

        if (count($proyecto) > 0) {
            foreach ($proyecto as $p) { ?>
                <tr>
                    <td><?= $p->id; ?></td>
                    <td><?= utf8_encode($p->nombre); ?></td>
                    <td class="text-right">
                        <?php if(count($p->getAlumnos()) > 0){ ?>
                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                    data-target="#operationModal" data-id="<?= $p->id; ?>" data-model="<?=$_POST['model']; ?>"
                                    data-operation="Alumnos">
                                <i class="fa fa-users"></i> Ver alumnos
                            </button>
                        <?php } ?>
                        <?php if(count($p->getPresidente()) > 0){ ?>
                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                    data-target="#operationModal" data-id="<?= $p->id; ?>" data-model="<?=$_POST['model']; ?>"
                                    data-operation="Dictamen">
                                <i class="fa fa-users"></i> Dictamen
                            </button>
                        <?php } ?>
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
                <td colspan="3" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }
}