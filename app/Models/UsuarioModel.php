<?php

namespace App\Models;

use App\Config\Executor;

class UsuarioModel extends Model {
	protected static $tablename = 'usuario';
	public $usuario = '';
	public $contrasena = '';
	public $nombre;
	public $correo;
	public $id_perfil;
	public $id_docente;

	public static function getByUser($user, $pass){
	    try {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE usuario = '{$user}' AND contrasena = '{$pass}' LIMIT 1";
            $query = Executor::doit($sql);
        
            return Model::one($query[0], new UsuarioModel());
        } catch (\Exception $e) {
	        throw new Exception($e->getMessage());
        }
    }

	public function getDocente(){
	    try {
            return DocenteModel::getById($this->id_docente);
        } catch (\Exception $e) {
	        throw new Exception($e->getMessage());
        }
	}

	public function getPerfil(){
	    try {
            return PerfilModel::getById($this->id_perfil);
        } catch (\Exception $e) {
	        throw new Exception($e->getMessage());
        }
	}
}