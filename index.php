<?php
	session_start();
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'file.php';
	require_once File::buildPath(array('library', 'usefull.php'));
	require_once File::buildPath(array('model', 'bdd.php'));
	require_once File::buildPath(array('controller', 'routeur.php'));
?>