<?php 

namespace App\Middleware;

use App\Auth\Auth;

class Middle{

	protected $auth;
	protected $is_auth;
	public function __construct() {
		$this->auth 	= new Auth();
		$this->is_auth	= $this->auth->isAuth();
	}
	public function register() {
		return array(
			'guest'     => 'guest',
            'student'   => 'student',
            'cpanel'	=> 'cpanel'
		);
	}
	public function isAuth($val, $dir) {
		$type = $this->register();
		if ($val == 'guest') {
			return;
		} else if($this->auth->isAuth()) {
			$flag = false;
			foreach($type as $k => $v){
				foreach($val as $admit){
					if($k == $admit && $v == userType())
						$flag = true;
				}
			}

			if($flag){
				return;
			} else
				redirect('403');
		} else {
			if($dir == '/')
				redirect('login');
			else
				redirect('403');
		}
	}

}