<?php

namespace App\Models;

use App\Config\Executor;

class UsuarioModel extends Model {
	//public static $tablename = 'usuario';
	public $id;
	public $usuario = '';
	public $contrasena = '';
	public $nombre;
	public $correo;
	public $id_perfil;
	public $id_docente;

	function __construct(){
        self::$tablename = 'usuario';
		$this->usuario = '';
		$this->contrasena = '';
		$this->nombre = '';
		$this->correo = '';
		$this->id_perfil = '';
		$this->id_docente = 'null';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (usuario, contrasena, nombre, correo, id_perfil, id_docente) VALUES ('{$this->usuario}',
		'{$this->contrasena}', '{$this->nombre}', '{$this->correo}', '{$this->id_perfil}', {$this->id_docente})";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public static function delById($id){
		$sql = "DELETE FROM ".self::$tablename." WHERE id = {$id}";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET usuario='{$this->usuario}', contrasena='{$this->contrasena}', nombre='{$this->nombre}',
		correo='{$this->correo}', id_docente='{$this->id_docente}', id_perfil='{$this->id_perfil}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
		$query = Executor::doit($sql);

		return Model::one($query[0], new UsuarioModel());
	}

	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);

		return Model::many($query[0], new UsuarioModel());
	}

    public static function getByUser($user, $pass){
        $sql = "SELECT * FROM " .self::$tablename . " WHERE usuario = '{$user}' AND contrasena = '{$pass}' LIMIT 1";
        $query = Executor::doit($sql);

        return Model::one($query[0], new UsuarioModel());
    }

	public function getDocente(){
		$u = new DocenteModel();
	    return $u->getById($this->id_docente);
	}

	public function getPerfil(){
	    $p = new PerfilModel();
		return $p->getById($this->id_perfil);
	}
}