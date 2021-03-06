<?php

namespace App\Request;

use App\Models\ProyectoModel;

class ProyectoRequest {
    function Agregar(){
        $proyecto = new ProyectoModel();
        if ($_POST['id'] != 0)
            $proyecto = ProyectoModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $proyecto->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= ($proyecto->nombre); ?>"
                           class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
                <div class="col-sm-9">
                    <textarea name="observaciones" id="observaciones" cols="30" rows="4" class="form-control"><?=(($proyecto->observaciones)); ?></textarea>
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
        $proyecto = ProyectoModel::getById($_POST['id']); ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4>
                        <i class="fa fa-star"></i>
                        <?=($proyecto->nombre); ?> <br>
                        <small><b><?=($proyecto->getOpcion()->nombre); ?> <?=($proyecto->estatus == 'Abierto') ? '(En curso)' : '(Finalizado)'; ?></b></small>
                    </h4>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-2 text-right"><b>Integrantes:</b></div>
                <div class="col-sm-4">
                    <?php foreach ($proyecto->getAlumnos() as $a){ ?>
                        <?=$a->getNombreCompleto(); ?><br>
                    <?php } ?>
                </div>
                <div class="col-sm-2 text-right"><b>Asesor(es):</b></div>
                <div class="col-sm-4">
                    <?=(!empty($proyecto->id_asesor)) ? $proyecto->getAsesor()->getNombreCompleto() : 'Sin asignar'; ?><br>
                    <?=(!empty($proyecto->id_asesor2)) ? $proyecto->getAsesor2()->getNombreCompleto() : ''; ?>
                </div>
                <div class="clearfix"></div>

                <?php if (!empty($proyecto->id_presidente) && !empty($proyecto->id_secretario) && !empty($proyecto->id_vocal) && !empty($proyecto->id_vocal_suplente)){ ?>
                    <div class="page-header text-center"><b>COMITE REVISOR</b></div>
                    <div class="col-sm-2 text-right"><b>Presidente:</b></div>
                    <div class="col-sm-10">
                        <?=($proyecto->getPresidente()->getNombreCompleto()); ?><br>
                    </div>
                    <div class="col-sm-2 text-right"><b>Secretario:</b></div>
                    <div class="col-sm-10">
                        <?=($proyecto->getSecretario()->getNombreCompleto()); ?><br>
                    </div>
                    <div class="col-sm-2 text-right"><b>Vocal:</b></div>
                    <div class="col-sm-10">
                        <?=($proyecto->getVocal()->getNombreCompleto()); ?><br>
                    </div>
                    <div class="col-sm-2 text-right"><b>Vocal suplente:</b></div>
                    <div class="col-sm-10">
                        <?=($proyecto->getVocalSuplente()->getNombreCompleto()); ?><br>
                    </div>
                    <div class="clearfix"></div>
                <?php } ?>

                <?php if(!empty($proyecto->observaciones)){ ?>
                    <div class="col-sm-2 text-right" style="margin-top: 25px"><b>Observaciones:</b></div>
                    <div class="col-sm-9" style="margin-top: 25px">
                        <i><?=nl2br(($proyecto->observaciones)); ?></i>
                    </div>
                    <div class="clearfix"></div>
                <?php } ?>


                <div class="page-header" style="margin-top: 35px"></div>
                <div class="col-sm-6 text-center">
                    <b>Presidente de Academia</b><br>
                    <?=($proyecto->getPresidenteAcademia()->getNombreCompleto()); ?>
                </div>
                <div class="col-sm-6 text-center">
                    <b>Secretario de Academia</b><br>
                    <?=($proyecto->getSecretarioAcademia()->getNombreCompleto()); ?>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12 text-center">
                    <b>Jefe de Carrera</b><br>
                    <?=($proyecto->getJefeCarrera()->getNombreCompleto()); ?>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cerrar
                    </button>
                </div>
            </div>
        <?php
    }

    function Dictamen(){
        $proyecto = ProyectoModel::getById($_POST['id']);?>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                    Cerrar
                </button>
            </div>
        </div>
        <?php
    }

    function Eliminar(){
        $proyecto = ProyectoModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $proyecto->id; ?>">
            <h5>Desea eliminar el proyecto '<?= $proyecto->nombre; ?>'?</h5>

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
        $proyecto = ProyectoModel::getAll('', '', $p, 10);
        foreach ($proyecto as $pr) { ?>
            <tr>
                <td><?= $pr->id; ?></td>
                <td><?= $pr->nombre; ?></td>
                <td class="text-right">
                    <?php if(count($pr->getAlumnos()) > 0){ ?>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Alumnos">
                            <i class="fa fa-users"></i> Ver alumnos
                        </button>
                    <?php } ?>
                    <?php if(count($pr->getAlumnos()) > 0){ ?>
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $pr->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Dictamen">
                            <i class="fa fa-graduation-cap"></i> Dictamen
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
        $proyecto = ProyectoModel::getSearch('nombre', $k);

        if (count($proyecto) > 0) {
            foreach ($proyecto as $p) { ?>
                <tr>
                    <td><?= $p->id; ?></td>
                    <td><?= $p->nombre; ?></td>
                    <td class="text-right">
                        <?php if(count($p->getAlumnos()) > 0){ ?>
                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                    data-target="#operationModal" data-id="<?= $p->id; ?>" data-model="<?=$_POST['model']; ?>"
                                    data-operation="Alumnos">
                                <i class="fa fa-users"></i> Ver alumnos
                            </button>
                        <?php } ?>
                        <?php if(count($p->getAlumnos()) > 0){ ?>
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