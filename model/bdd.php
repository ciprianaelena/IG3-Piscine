<?php
	class Bdd {

		public static $pdo;

		// Connecte à la base de donnée
		public static function connect() {
			$hostname = Credentials::$databaseHostname;
		    $database = Credentials::$databaseName;
		    $login    = Credentials::$databaseLogin;
		    $password = Credentials::$databasePassword;

			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $login, $password);
			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	Bdd::connect();
?>