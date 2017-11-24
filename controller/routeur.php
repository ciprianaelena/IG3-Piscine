<?php
	require_once File::buildPath(array('controller', 'controllerUser.php'));

	if (isset($_GET['controller'])) {
		$controller = htmlspecialchars($_GET['controller']);
	} else {
		$controller = Conf::$defaultController;
	}
	$controller = 'controller' . ucfirst($controller);

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	} else {
		$action = Conf::$defaultAction;
	}
	$action = htmlspecialchars($action);

	$controller::$action();
?>