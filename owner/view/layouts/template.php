<?php

$user = new User();
require_once('header.php');
//unset($_SESSION);
//$verify_user = !isset(Config::get('session/session_name')) ? null : $_SESSION['email'];
// print_r('<pre>');
// //print_r(Session::get(Config::get('session/session_name')));
// print_r($user->isLoggedIn());
// //print_r(Session::get('kigbu'));
// print_r('</pre>');exit();

$goto = !isset($_GET['goto']) ? 'dashboard' : $_GET['goto'];


//Template::render($goto, 'view');

if(Session::exists(!Config::get('session/session_name')) && !$user->isLoggedIn()){
	unset($_SESSION);
	Template::render('home', 'view');
}else if(Session::exists(Config::get('session/session_name')) && $user->isLoggedIn()){
	Template::render($goto, 'view');
}else if($goto && $user->isLoggedIn()){	
	Template::render($goto, 'view');
}else if($goto && !$user->isLoggedIn()){
	Template::render('home', 'view');
}

//Template::render($goto, 'view');
require_once('footer.php');
?>