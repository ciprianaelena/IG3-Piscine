<?php
	function isConnected() {
		return isset($_SESSION['user']);
	}

	if (isset($_GET['controller'])) {
		$controller = htmlspecialchars($_GET['controller']);
	} else {
		$controller = Conf::$defaultController;
	}
	$controller = 'controller' . ucfirst($controller);
	require_once File::buildPath(array('controller', $controller . '.php'));

	// Vérifie que l'utilisateur est connecté si il essaye d'accèder à un autre controller que celui de connexion
	if ($controller != 'controllerUser' && !isConnected()) {
		require_once File::buildPath(array('controller', 'controllerUser.php'));
		ControllerUser::viewConnect('Vous devez vous connecter pour accèder à cet page');
		return true;
	}

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	} else {
		$action = Conf::$defaultAction;
	}
	$action = htmlspecialchars($action);

	$controller::$action();
?>