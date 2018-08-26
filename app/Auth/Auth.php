<?php

namespace App\Auth;

use App\Models\EgresadosModel;
use App\Models\UsuarioModel;

class Auth{
    public function isAuth() {
        @session_start();
        return !empty($_SESSION);
    }

    public function auth($user, $pass){
        $user = UsuarioModel::getByUser($user, $pass);

        return $user;
    }

    public function authStudent($ncontrol, $pass){
        $user = EgresadosModel::getAll("id LIKE '{$ncontrol}' AND contrasena LIKE '{$pass}'")[0];

        return $user;
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('/');
    }

}