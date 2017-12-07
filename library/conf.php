<?php

	class Conf {

		// Salt utilisé par sécurité
		public static $salt	= '';
		// Est-ce que le site est en développement 'true' ou ou non 'false'
		public static $debug = true;

		// Nom de l'hôte de la base de donnée
		public static $hostname = '';
		// Nom d'utilisateur de la base de donnée
		public static $login = 'root';
		public static function getSaltLogin() {
			return Conf::$salt . Conf::$login;
		}
		// Mot de passe de la base de donnée
		public static $password = '';
		public static function getSaltPassword() {
			return Conf::$salt . Conf::$password;
		}
		// Nom de la base de données
		public static $database = 'piscine';
		public static function getSaltDataBase() {
			return Conf::$salt . Conf::$database;
		}

		// Controller par défault à charger
		public static $defaultController = 'user';
		// Action par défault à charger
		public static $defaultAction = 'connect';
	}
?>
