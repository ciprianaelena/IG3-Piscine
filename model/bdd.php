<?php
	class Bdd {

		public static $pdo;

		// Connect to the database
		public static function connect() {
			$hostname = Credentials::$databaseHostname;
		    $database = Credentials::$databaseName;
		    $login    = Credentials::$databaseLogin;
		    $password = Credentials::$databasePassword;

			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $login, $password);
			// Enable errors display and exception throws in case of errors
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	Bdd::connect();
?>