<?php

namespace App\Controllers;

class ErrorController{
    public function error404() {
    	return view('error/404.twig');
    }

    public function error403() {
        return view('error/403.twig');
    }

    public function error500() {
        return view('error/500.twig');
    }
}
