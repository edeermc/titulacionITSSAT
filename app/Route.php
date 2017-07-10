<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
            ['url' => '/', 							'ctrl' => 'HomeController@index', 						'type' => 'guest'],

			/* catalogos */
			['url' => 'carrera',					'ctrl' => 'CarreraController@index',					'type' => 'guest'],
			['url' => 'carrera/save',				'ctrl' => 'CarreraController@save',						'type' => 'guest'],
			['url' => 'carrera/del',				'ctrl' => 'CarreraController@del',						'type' => 'guest'],

            /* autenticación */
            ['url' => 'login', 						'ctrl' => 'AuthController@index', 						'type' => 'guest'],
			['url' => 'logout', 					'ctrl' => 'AuthController@logout', 						'type' => 'guest'],
			['url' => 'auth', 						'ctrl' => 'AuthController@login', 						'type' => 'guest'],

			/* error */
            ['url' => '404', 						'ctrl' => 'ErrorController@error404',					'type' => 'guest'],
			['url' => '403', 						'ctrl' => 'ErrorController@error403', 					'type' => 'guest']
        );
        return $route;
    }
}
