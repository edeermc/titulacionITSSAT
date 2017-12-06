<?php

namespace App\Request;


use App\Models\DocenteModel;
use App\Models\PerfilModel;
use App\Models\UsuarioModel;

class UsuarioRequest {
    public function Agregar() {
        $perfil = new PerfilModel();
        $perfil = $perfil->getAll();
        $docente = new DocenteModel();
        $docente = $docente->getAll();

        $usuario = new UsuarioModel();

        if($_POST['id'] != 0)
            $usuario = $usuario->getById($_POST['id']);
        ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/save'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $usuario->id; ?>">
            <div class="form-group">
                <label class="control-label col-sm-2">Nombre</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="nombre" value="<?=$usuario->nombre; ?>" required>
                </div>
                <label class="control-label col-sm-2">Correo</label>
                <div class="col-sm-4">
                    <input class="form-control" type="email" name="correo" value="<?=$usuario->correo; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Perfil</label>
                <div class="col-sm-4">
                    <select class="form-control" name="perfil" required>
                        <?php foreach ($perfil as $p): ?>
                            <option value="<?= $p->id; ?>" <?=($p->id == $usuario->id_perfil) ? 'selected' : '';?>><?=$p->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="control-label col-sm-2">Docente</label>
                <div class="col-sm-4">
                    <select class="form-control" name="docente" required>
                        <?php foreach ($docente as $d): ?>
                            <option value="<?= $d->id; ?>" <?=($d->id == $usuario->id_docente) ? 'selected' : '';?>><?=$d->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Usuario</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="user" value="<?=$usuario->usuario; ?>" required>
                </div>
                <label class="control-label col-sm-2">Contraseña</label>
                <div class="col-sm-4">
                    <input class="form-control" type="password" name="pass" value="">
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
    public function Eliminar(){
        $u = new UsuarioModel();
        $u = $u->getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/' . $_POST['model'] . '/del'); ?>','<?=$_POST['model']; ?>')" id="form-submit">
            <input type="hidden" name="id" value="<?= $u->id; ?>">
            <h5>Desea eliminar al usuario '<?= utf8_encode($u->nombre); ?>'?</h5>

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

    public function Buscar(){
        $k = $_POST['key'];
        $usu = new UsuarioModel();
        $usuario = $usu->getSearch('nombre', $k);
        if (count($usuario) > 0) {
            foreach ($usuario as $u) { ?>
                <tr>
                    <td><?= $u->id; ?></td>
                    <td><?= $u->usuario; ?></td>
                    <td><?= utf8_encode($u->nombre); ?></td>
                    <td><?= $u->correo; ?></td>
                    <td><?= utf8_encode($u->getPerfil()->nombre); ?></td>
                    <td><?= utf8_encode($u->getDocente()->nombre); ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $u->id; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $u->id; ?>" data-model="<?=$_POST['model']; ?>"
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

    public function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $usuario = new UsuarioModel();
        $usuario = $usuario->getRange($p, 10);
        foreach ($usuario as $u) { ?>
            <tr>
                <td><?= $u->id; ?></td>
                <td><?= $u->usuario; ?></td>
                <td><?= utf8_encode($u->nombre); ?></td>
                <td><?= $u->corre; ?></td>
                <td><?= utf8_encode($u->getPerfil()->nombre); ?></td>
                <td><?= utf8_encode($u->getDocente()->nombre); ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $u->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $u->id; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }
}

