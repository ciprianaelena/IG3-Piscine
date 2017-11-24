<?php
	require_once File::buildPath(array('library', 'conf.php'));

	class Bdd {

		public static $pdo;

		// Connecte à la base de donnée
		public static function connect() {
			$hostname = Conf::$hostname;
		    $database = Conf::getSaltDatabase();
		    $login    = Conf::getSaltLogin();
		    $password = Conf::getSaltPassword();

			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $login, $password);
			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	Bdd::connect();
?>