<?php
/**
 * Created by PhpStorm.
 * User: juani
 * Date: 07/10/2017
 * Time: 01:09 PM
 */

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController{
    public function index (){
        $usuario = new UsuarioModel();
        $usuario = $usuario->getAll();

        return view('Catalogos/usuario.twig', ['usuarios' => $usuario, 'modelo' => 'Usuario', 'pag' => 1]);
    }
}