<?php

namespace App\Models;

class PerfilModel extends Model {
	protected static $tablename = 'perfil';
	public $nombre;
	public $modulo;
	public $permiso;
}