<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
            ['url' => '/', 	        						'ctrl' => 'HomeController@index', 						    'type' => 'guest'],
            ['url' => 'cpanel', 							'ctrl' => 'HomeController@index', 			    			'type' => 'guest'],
            ['url' => 'egresado', 							'ctrl' => 'EgresadoController@panel', 		    			'type' => 'guest'],
            ['url' => 'egresado/save',          			'ctrl' => 'EgresadoController@save2', 		    			'type' => 'guest'],
            ['url' => 'egresado/save2',          			'ctrl' => 'EgresadoController@save3', 		    			'type' => 'guest'],
            ['url' => 'egresado/savefiles',          		'ctrl' => 'EgresadoController@save4', 		    			'type' => 'guest'],
            ['url' => 'egresado/registro',			        'ctrl' => 'EgresadoController@registro', 	    			'type' => 'guest'],
            ['url' => 'egresado/datospersonales',			'ctrl' => 'EgresadoController@config', 		    			'type' => 'guest'],

            /* carrera */
			['url' => 'cpanel/carrera',					    'ctrl' => 'CarreraController@index',	    				'type' => 'guest'],
			['url' => 'cpanel/carrera/save',				'ctrl' => 'CarreraController@save',	    					'type' => 'guest'],
            ['url' => 'cpanel/carrera/del',				    'ctrl' => 'CarreraController@del',  						'type' => 'guest'],

            /* division */
            ['url' => 'cpanel/division',					'ctrl' => 'DivisionController@index',				    	'type' => 'guest'],
            ['url' => 'cpanel/division/save',				'ctrl' => 'DivisionController@save',					    'type' => 'guest'],
            ['url' => 'cpanel/division/del',				'ctrl' => 'DivisionController@del',					    	'type' => 'guest'],

            /* Tipo documento */
            ['url' => 'cpanel/tipodocumento',				'ctrl' => 'TipoDocumentoController@index',		    		'type' => 'guest'],
            ['url' => 'cpanel/tipodocumento/save',			'ctrl' => 'TipoDocumentoController@save',	    			'type' => 'guest'],
            ['url' => 'cpanel/tipodocumento/del',			'ctrl' => 'TipoDocumentoController@del',    				'type' => 'guest'],

            /* Opciones de ttulacion */
            ['url' => 'cpanel/opciontitulacion',			'ctrl' => 'OpcionTitulacionController@index',		    	'type' => 'guest'],
            ['url' => 'cpanel/opciontitulacion/save',		'ctrl' => 'OpcionTitulacionController@save',	    		'type' => 'guest'],
            ['url' => 'cpanel/opciontitulacion/saved',		'ctrl' => 'OpcionTitulacionController@saved',			    'type' => 'guest'],
            ['url' => 'cpanel/opciontitulacion/savep',		'ctrl' => 'OpcionTitulacionController@savep',		    	'type' => 'guest'],
            ['url' => 'cpanel/opciontitulacion/del',		'ctrl' => 'OpcionTitulacionController@del',		    		'type' => 'guest'],

            /* Alumnos */
            ['url' => 'cpanel/egresado',			        'ctrl' => 'EgresadoController@index',		    	        'type' => 'guest'],
            ['url' => 'cpanel/egresado/validatedoctos',     'ctrl' => 'EgresadoController@validatedoctos',    	        'type' => 'guest'],
            ['url' => 'cpanel/egresado/save',		        'ctrl' => 'EgresadoController@save',	    	            'type' => 'guest'],
            ['url' => 'cpanel/egresado/del',		        'ctrl' => 'EgresadoController@del',	    			        'type' => 'guest'],

            /* Planes de estudio */
            ['url' => 'cpanel/planestudios',			    'ctrl' => 'PlanController@index',			                'type' => 'guest'],
            ['url' => 'cpanel/planestudios/save',		    'ctrl' => 'PlanController@save',		                  	'type' => 'guest'],
            ['url' => 'cpanel/planestudios/del',		    'ctrl' => 'PlanController@del',				                'type' => 'guest'],

            /* Proyectos */
            ['url' => 'cpanel/proyecto',			        'ctrl' => 'ProyectoController@index',			            'type' => 'guest'],
            ['url' => 'cpanel/proyecto/save',		        'ctrl' => 'ProyectoController@save',		              	'type' => 'guest'],
            ['url' => 'cpanel/proyecto/del',		        'ctrl' => 'ProyectoController@del',			    	        'type' => 'guest'],
            ['url' => 'cpanel/proyecto/validar',		    'ctrl' => 'ProyectoController@validar',			    	    'type' => 'guest'],
            ['url' => 'cpanel/proyecto/dictamen',		    'ctrl' => 'ProyectoController@dictamen',			    	'type' => 'guest'],
            ['url' => 'cpanel/proyecto/liberar',		    'ctrl' => 'ProyectoController@liberar',			    	    'type' => 'guest'],
            ['url' => 'cpanel/proyecto/examen',		        'ctrl' => 'ProyectoController@examen',			    	    'type' => 'guest'],

            /* Docentes */
			['url' => 'cpanel/docente',					    'ctrl' => 'DocenteController@index',	    				'type' => 'guest'],
			['url' => 'cpanel/docente/save',				'ctrl' => 'DocenteController@save',	    					'type' => 'guest'],
			['url' => 'cpanel/docente/del',				    'ctrl' => 'DocenteController@del',  						'type' => 'guest'],

            /* Usuarios */
            ['url' => 'cpanel/usuario',                     'ctrl' => 'UsuarioController@index',                        'type' => 'guest'],
            ['url' => 'cpanel/usuario/save',                'ctrl' => 'UsuarioController@save',                         'type' => 'guest'],
            ['url' => 'cpanel/usuario/del',                 'ctrl' => 'UsuarioController@del',                          'type' => 'guest'],

            /* autenticación */
            ['url' => 'cpanel/login', 						'ctrl' => 'AuthController@index', 						    'type' => 'guest'],
            ['url' => 'login', 						        'ctrl' => 'AuthController@index', 						    'type' => 'guest'],
			['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'guest'],
			['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'guest'],

			/* error */
            ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
			['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest']
        );
        return $route;
    }
}
