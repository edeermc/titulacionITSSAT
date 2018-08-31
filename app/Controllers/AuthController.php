<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Config\Logger;

class AuthController {
    protected $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
        if(isset($_GET['msg'])) {
            return view('estudiante\login.twig', ['msg' => $_GET['msg']]);
        } elseif(!isset($_SESSION['no_control'])) {
            return view('estudiante\login.twig');
        } else {
            redirect('egresado');
        }
    }

    public function cpindex() {
        if(isset($_GET['msg'])) {
            return view('cpanel/login.twig', ['msg' => $_GET['msg']]);
        } elseif(!isset($_SESSION['id'])) {
            return view('cpanel/login.twig');
        } else {
            redirect('cpanel');
        }
    }

    public function login() {
        $user = input('usuario');
        $pass = input('contrasena');
        $auth = $this->auth->authStudent($user, md5($pass));
        var_dump($auth);
        if($auth != null && $auth->estatus == "Activo") {
            session_start();
            $_SESSION['no_control'] = $auth->id;
            $_SESSION['name'] = $auth->getNombreCompleto();
            $_SESSION['access'] = 'student';
            $_SESSION['last'] = $auth->last_login;

            try {
                $auth->last_login = date('Y-m-d H:i:s');
                $auth->update();
            } catch (\Exception $e) {
                Logger::WriteLog($e);
            }
            Logger::WriteLog("Inicio de sesión del estudiante con número de control {$auth->id}.", APP_WARNING);
            redirect('egresado');
        } else {
            redirect('login');
        }
    }

    public function cplogin() {
        $user = input('usuario');
        $pass = input('contrasena');
        $auth = $this->auth->auth($user, md5($pass));
        if($auth != null) {
            session_start();
            $_SESSION['id'] = $auth->id;
            $_SESSION['user'] = $user;
            $_SESSION['name'] = $auth->nombre;
            $_SESSION['role'] = $auth->id_perfil;
            $_SESSION['role_name'] = $auth->getPerfil()->nombre;
            $_SESSION['prof_id'] = $auth->id_docente;
            $_SESSION['access'] = 'cpanel';
            $_SESSION['last'] = $auth->last_login;

            try {
                $auth->last_login = date('Y-m-d H:i:s');
                $auth->update();
            } catch (\Exception $e) {
                Logger::WriteLog($e);
            }
            Logger::WriteLog("Inicio de sesión del usuario '{$user}' con id {$auth->id}.", APP_WARNING);
            redirect('/cpanel');
        } else {
            redirect('cpanel/login');
        }
    }

    public function logout() {
        @session_start();
        if ($_SESSION['access'] == 'student') {
            Logger::WriteLog("Cierre de sesión del estudiante con número de control {$_SESSION['no_control']}.", APP_WARNING);
        } else {
            Logger::WriteLog("Cierre de sesión del usuario '{$_SESSION['user']}' con id {$_SESSION['id']}.", APP_WARNING);
        }

        $this->auth->logout();
    }
}