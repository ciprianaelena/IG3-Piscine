<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelUser extends ModelCRUD {

		public static $className = 'ModelUser';
		protected static $tableName = 'user';

		// Retourne un utilisateur par son id
		public static function getUserID($idUser) {
			$where = 'idUser = :idUser';
			$values = array('idUser' => $idUser);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Retourne un utilisateur par son login ou false si aucun utilisateur n'est trouvé
		public static function getUserLogin($login) {
			$where = 'login = :login';
			$values = array('login' => $login);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Retourne un utilisateur par sont email
		public static function getUserEmail($email) {
			$where = 'email = :email';
			$values = array('email' => $email);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Enregistre un utilisateur dans la base de données
		public static function registered($login, $password, $email) {
			// Génére une URL d'activation
			$activationURL = Usefull::generateRandomHex();

			$args = array(
				'login' => $login,
				'password' => $password,
				'email' => $email,
				'activationURL' => $activationURL
			);

			ModelUser::create(ModelUser::$className, $args);
		}

		// Vérifie qu'un utilisateur avec ce login / password existe
		public static function connected($login, $password) {
			$where = 'login = :login AND password = :password';
			$values = array(
				'login' => $login,
				'password' => $password
			);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}
	}
?>