<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Model\Alumno;
use App\Model\AsignarGrupo;

class AuthController {
    protected $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
		if(isset($_GET['msg'])) {
			return view('login.twig', ['msg' => $_GET['msg']]);
		}elseif(!isset($_SESSION['user'])) {
			return view('login.twig');
		}else {
			redirect('/');
		}
    }

    public function login() {
        $user = input('usuario');
        $pass = input('contrasena');
        $auth = $this->auth->auth($user, $pass);
        //$auth = $this->auth->auth($user, md5($pass));
        if($auth != null) {
            session_start();
            $_SESSION['user'] = $user;
			$_SESSION['name'] = $auth->nombre;
			$_SESSION['id'] = $auth->id;

			redirect('/cpanel');
        } else {
            redirect('403');
        }
    }

    public function logout() {
        $this->auth->logout();
    }
}
