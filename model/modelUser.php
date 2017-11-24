<?php
	require_once File::buildPath(array('model', 'model.php'));

	class ModelUser extends Model {

		// Retourne un utilisateur par son id
		public static function getUserID($idUser) {
			$sql = 'SELECT * FROM user WHERE idUser = :idUser';

			$values = array('idUser' => $idUser);

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);

			$return = $query->fetchAll(PDO::FETCH_CLASS, 'ModelUser');
			// Si le tableau est vide il y a eu un problème
			if (empty($return)) {
				return false;
			}
			// Sinon on retourne un objet ModelUser
			return $return[0];
		}

		// Retourne un utilisateur par son login
		public static function getUserLogin($login) {
			$sql = 'SELECT * FROM user WHERE login = :login';

			$values = array('login' => $login);

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);

			$return = $query->fetchAll(PDO::FETCH_CLASS, 'ModelUser');
			// Si le tableau est vide il y a eu un problème
			if (empty($return)) {
				return false;
			}
			// Sinon on retourne un objet ModelUser
			return $return[0];
		}

		// Retourne un utilisateur par sont email
		public static function getUserEmail($email) {
			$sql = 'SELECT * FROM user WHERE email = :email';

			$values = array('email' => $email);

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);

			$return = $query->fetchAll(PDO::FETCH_CLASS, 'ModelUser');
			// Si le tableau est vide il y a eu un problème
			if (empty($return)) {
				return false;
			}
			// Sinon on retourne un objet ModelUser
			return $return[0];
		}

		// Enregistre un utilisateur dans la base de données
		public static function registered($login, $password, $email) {
			// Génére une URL d'activation
			$activationURL = Usefull::generateRandomHex();

			$sql = 'INSERT INTO user(login, password, email, activationURL) 
					VALUES (:login, :password, :email, :activationURL)';

			$values = array(
				'login'         => $login,
				'password'      => $password,
				'email'         => $email,
				'activationURL' => $activationURL,
				);

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);
		}

		// Vérifie qu'un utilisateur avec ce login / password existe
		public static function connected($login, $password) {
			$sql = 'SELECT * FROM user WHERE login = :login AND password = :password';

			$values = array(
				'login'    => $login,
				'password' => $password,
				);

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);

			$return = $query->fetchAll(PDO::FETCH_CLASS, 'ModelUser');
			// Si le tableau est vide il y a eu un problème
			if (empty($return)) {
				return false;
			}
			// Sinon on retourne un objet ModelUser
			return $return[0];
		}
	}
?>