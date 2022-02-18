<?php
require_once('header.php');

$goto = !isset($_GET['goto']) ? 'home' : $_GET['goto'];
if($goto){	
	Template::render($goto, 'view');
}
require_once('footer.php');
?>