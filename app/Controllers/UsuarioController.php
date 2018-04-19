<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\UsuarioModel;

class UsuarioController{
    public function index(){
        try {
            $usuarios = UsuarioModel::getAll('', '', 0, 10);
            $c = UsuarioModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);
    
            return view('Catalogos/usuario.twig', ['usuarios' => $usuarios, 'modelo' => 'Usuario', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $usu = new UsuarioModel();
            if ($_POST['id'] != 0) {
                $usu = UsuarioModel::getById($_POST['id']);
            }
            $usu->nombre = ($_POST['nombre']);
            $usu->contrasena = md5($_POST['pass']);
            $usu->usuario = ($_POST['user']);
            $usu->correo = ($_POST['correo']);
            $usu->id_perfil = ($_POST['perfil']);
            $usu->id_docente = ($_POST['docente']);
    
            if ($_POST['id'] == 0) {
                $usu->add();
                DB::commit();
                
                return 1;
            } else {
                $usu->update();
                DB::commit();
    
                return 2;
            }
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function del (){
        DB::startTransaction();
        try {
            UsuarioModel::delById($_POST['id']);
            DB::commit();
            
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }
}