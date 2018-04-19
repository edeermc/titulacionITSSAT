<?php

namespace App\Models;

use App\Config\Executor;

class PerfilModel {
	protected static $tablename = 'perfil';
	public $nombre;
	public $modulo;
	public $permiso;
}