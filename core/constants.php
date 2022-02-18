<?php
	// Define the core paths
	// Define them as absolute paths to make sure that require_once works as expected

	// DIRECTORY_SEPARATOR is a PHP pre-defined constant
	// (\ for Windows, / for Unix)
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

	//defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
	defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'etariii');

	defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'model');