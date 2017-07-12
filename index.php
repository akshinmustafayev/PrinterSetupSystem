<?php
	session_start();
	spl_autoload_register(function ($class){
		include './app/controllers/' . $class . '.php';
	});
	
	$controller = new Controller($_GET, $_POST);
?>