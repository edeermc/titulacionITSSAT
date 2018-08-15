<?php

function resource( $val ) {
    $url = APPLICATION_ROOT . "/public/{$val}";
    
    return $url;
}

function route( $val ) {
    $val = strtolower($val);
    $url = APPLICATION_ROOT . "/{$val}";
    
    return $url;
}

function to_md5( $val ) {
    return md5($val);
}

function twig() {
    $loader     = new \Twig_Loader_Filesystem( 'app/Views' );
    $twig       = new \Twig_Environment( $loader );
    
    $resource   = new Twig_SimpleFunction( 'resource', function( $val ) {
        return resource( $val );
    } );
    
    $router     = new Twig_SimpleFunction( 'route', function( $val ) {
        return route( $val );
    } );
    
    $user_nick  = new Twig_SimpleFunction( 'user_nick', function() {
        return @$_SESSION['user'];
    } );
    
    $user_id  = new Twig_SimpleFunction( 'user_id', function() {
		return @$_SESSION['id'];
	} );

    $to_md5  = new Twig_SimpleFunction( 'to_md5', function( $val ) {
        return to_md5( $val );
    } );
	
    $twig->addFunction( $resource );
    $twig->addFunction( $router );
    $twig->addFunction( $user_nick );
    $twig->addFunction( $user_id );
    $twig->addFunction( $to_md5 );
	return $twig;
}

function view( $val, $array = [] ) {
    $t = twig();
    return $t->render( $val, $array );
}