<?php
namespace App\Request;

use App\Models\TipoDocumentoModel;

class tipoDoctoRequest{
    function Agregar(){
        $tipoDocumento = new TipoDocumentoModel();
        if ($_POST['id'] != 0)
            $tipoDocumento = TipoDocumentoModel::getById($_POST['id']); ?>
        <form class="form-horizontal" onsubmit="return sendForm('<?= route('cpanel/TipoDocumento/save'); ?>','tipoDocto')" id="form-submit">
            <input type="hidden" name="id" value="<?= $tipoDocumento->id; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="nombre" id="nombre" value="<?= ($tipoDocumento->nombre); ?>"
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
        $documento = TipoDocumentoModel::getById($_POST['id']); ?>
        <form class="form-horizontal"  onsubmit="return sendForm('<?= route('cpanel/TipoDocumento/del'); ?>','tipoDocto')" id="form-submit">
            <input type="hidden" name="id" value="<?= $documento->id; ?>">
            <h5>&#191;Desea eliminar el documento'<?= ($documento->nombre); ?>'?</h5>

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
        $documento = TipoDocumentoModel::getSearch('nombre', $k);

        if (count($documento) > 0) {
            foreach ($documento as $c) { ?>
                <tr>
                    <td><?= $c->id; ?></td>
                    <td><?= ($c->nombre); ?></td>
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
        } else {
            ?>
            <tr>
                <td colspan="3" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }


    function Paginacion() {
        $p = 10 * ($_POST['page'] - 1);
        $documento = TipoDocumentoModel::getAll('', '', $p, 10);
        foreach ($documento as $c) { ?>
            <tr>
                <td><?= $c->id; ?></td>
                <td><?= ($c->nombre); ?></td>
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