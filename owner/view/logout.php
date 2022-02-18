<?php
require_once('../core/init.php');
$user = new User();
if($user->isLoggedIn()){
	// print_r('<pre>');
	// print_r($user->isLoggedIn());
	// print_r('</pre>');exit();
	Session::delete($user->data()->username);
	Session::delete('active');

	if($user->logOut()){
		
	}

	$user->update(array(
	'logged_in' => 0
	), $user->data()->user_id);
	unset($_SESSION);
	Redirect::to('index.php');
}else{
	unset($_SESSION);
	Redirect::to('index.php');
}