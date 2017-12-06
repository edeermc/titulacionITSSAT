<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController{
    public function index(){
        $usuario = new UsuarioModel();
        $usuarios = $usuario->getRange(0, 10);
        $c = $usuario->getAll();
        $p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

        return view('Catalogos/usuario.twig', ['usuarios' => $usuarios, 'modelo' => 'Usuario', 'pag' => $p]);
    }

    public function save(){
        $usu = new UsuarioModel();
        if($_POST['id'] != 0){
            $usu = $usu->getById($_POST['id']);
        }
        $usu->nombre = utf8_decode($_POST['nombre']);
        $usu->contrasena = ($_POST['pass']);
        $usu->usuario = ($_POST['user']);
        $usu->correo = ($_POST['correo']);
        $usu->id_perfil = ($_POST['perfil']);
        $usu->id_docente = ($_POST['docente']);

        if ($_POST['id'] == 0){
            $usu->add();
            return 1;
        }else{
            $usu->update();
            return 2;
        }
        redirect('cpanel/usuario');
    }

    public function del (){
        $usuario = new UsuarioModel();
        $usuario->delById($_POST['id']);
        return 3;

        redirect('cpanel/usuario');
    }
}