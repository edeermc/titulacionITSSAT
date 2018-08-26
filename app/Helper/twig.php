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
        return @$_SESSION['access'] == 'student' ? @$_SESSION['no_control'] : @$_SESSION['user'];
    } );

    $user_name  = new Twig_SimpleFunction( 'user_name', function() {
        return @$_SESSION['name'];
    } );

    $user_type  = new Twig_SimpleFunction( 'user_type', function() {
        return @$_SESSION['access'];
    } );

    $user_role  = new Twig_SimpleFunction( 'user_role', function() {
        return @$_SESSION['role'];
    } );

    $user_role_name  = new Twig_SimpleFunction( 'user_role_name', function() {
        return @$_SESSION['role_name'];
    } );

    $user_last  = new Twig_SimpleFunction( 'user_last', function() {
        return @$_SESSION['last'];
    } );

    $to_md5  = new Twig_SimpleFunction( 'to_md5', function( $val ) {
        return to_md5( $val );
    } );
	
    $twig->addFunction( $resource );
    $twig->addFunction( $router );
    $twig->addFunction( $user_nick );
    $twig->addFunction( $user_name );
    $twig->addFunction( $user_type );
    $twig->addFunction( $user_role );
    $twig->addFunction( $user_role_name );
    $twig->addFunction( $user_last );
    $twig->addFunction( $to_md5 );
	return $twig;
}

function view( $val, $array = [] ) {
    try {
        $t = twig();
        return $t->render($val, $array);
    } catch (\Exception $e){
        \App\Config\Logger::WriteLog($e->getMessage());
        redirect('500');
    }
}