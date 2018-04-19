<?php

namespace App\Models;

class TipoDocumentoModel extends Model{
	protected static $tablename = 'tipo_documento';
	public $nombre;

    public function isChecked($id){
        try {
            return OpcionDocumentoModel::existOpcion($this->id, $id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}