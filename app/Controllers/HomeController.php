<?php

namespace App\Controllers;


class HomeController{
    public function index() {
        return view('index.twig');
    }

	public function cpindex() {
		return view('cpanel/index.twig');
    }
}