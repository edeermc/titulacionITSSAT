<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
            ['url' => '/', 							'ctrl' => 'HomeController@index', 						'type' => 'guest'],

			/* carrera */
			['url' => 'carrera',					'ctrl' => 'CarreraController@index',					'type' => 'guest'],
			['url' => 'carrera/save',				'ctrl' => 'CarreraController@save',						'type' => 'guest'],
            ['url' => 'carrera/del',				'ctrl' => 'CarreraController@del',						'type' => 'guest'],

            /* division */
            ['url' => 'division',					'ctrl' => 'DivisionController@index',					'type' => 'guest'],
            ['url' => 'division/save',				'ctrl' => 'DivisionController@save',					'type' => 'guest'],
            ['url' => 'division/del',				'ctrl' => 'DivisionController@del',						'type' => 'guest'],

            /* Tipo documento */
            ['url' => 'tipodocumento',				'ctrl' => 'TipoDocumentoController@index',				'type' => 'guest'],
            ['url' => 'tipodocumento/save',			'ctrl' => 'TipoDocumentoController@save',				'type' => 'guest'],
            ['url' => 'tipodocumento/del',			'ctrl' => 'TipoDocumentoController@del',				'type' => 'guest'],

            /* Opciones de ttulacion */
            ['url' => 'opciontitulacion',			'ctrl' => 'OpcionTitulacionController@index',			'type' => 'guest'],
            ['url' => 'opciontitulacion/save',		'ctrl' => 'OpcionTitulacionController@save',			'type' => 'guest'],
            ['url' => 'opciontitulacion/saved',		'ctrl' => 'OpcionTitulacionController@saved',			'type' => 'guest'],
            ['url' => 'opciontitulacion/savep',		'ctrl' => 'OpcionTitulacionController@savep',			'type' => 'guest'],
            ['url' => 'opciontitulacion/del',		'ctrl' => 'OpcionTitulacionController@del',				'type' => 'guest'],

            /* Alumnos */
            ['url' => 'egresado',			        'ctrl' => 'EgresadoController@index',			        'type' => 'guest'],
            ['url' => 'egresado/save',		        'ctrl' => 'EgresadoController@save',		            'type' => 'guest'],
            ['url' => 'egresado/del',		        'ctrl' => 'EgresadoController@del',				        'type' => 'guest'],

            /* Planes de estudio */
            ['url' => 'planestudios',			    'ctrl' => 'PlanController@index',			            'type' => 'guest'],
            ['url' => 'planestudios/save',		    'ctrl' => 'PlanController@save',		              	'type' => 'guest'],
            ['url' => 'planestudios/del',		    'ctrl' => 'PlanController@del',				            'type' => 'guest'],

            /* Proyectos */
            ['url' => 'proyecto',			        'ctrl' => 'ProyectoController@index',			        'type' => 'guest'],
            ['url' => 'proyecto/save',		        'ctrl' => 'ProyectoController@save',		          	'type' => 'guest'],
            ['url' => 'proyecto/del',		        'ctrl' => 'ProyectoController@del',				        'type' => 'guest'],

            /* Docentes */
			['url' => 'docente',					'ctrl' => 'DocenteController@index',					'type' => 'guest'],
			['url' => 'docente/save',				'ctrl' => 'DocenteController@save',						'type' => 'guest'],
			['url' => 'docente/del',				'ctrl' => 'DocenteController@del',						'type' => 'guest'],

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
