<?php
	require_once File::buildPath(array('library', 'usefull.php'));
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelUser extends ModelCRUD {

		static protected $className = 'ModelUser';
		static protected $tableName = 'user';

		// Return a user by is id, if none was found return false
		public static function getUserByID($idUser) {
			$where = 'idUser = :idUser';
			$values = array('idUser' => $idUser);
			return self::readOrFalse($where, $values);
		}

		// Return a user by is login, if none was found return false
		public static function getUserByLogin($login) {
			$where = 'login = :login';
			$values = array('login' => $login);
			return self::readOrFalse($where, $values);
		}

		// Return a user by is email, if none was found return false
		public static function getUserByEmail($email) {
			$where = 'email = :email';
			$values = array('email' => $email);
			return self::readOrFalse($where, $values);
		}

		// Check register conditions
		public function checkRegister() {
			// Login is too short
			if (strlen($this->login) < 3) {
				throw new Exception('The login must be at least 3 characters long');
			}

			// Login is too long
			if (strlen($this->login) > 20) {
				throw new Exception('The login must be less than 20 charcters long');
			}

			// Password is too short
			if (strlen($this->password) < 4) {
				throw new Exception('The password must be at least 4 characters long');
			}

			// Password is too long
			if (strlen($this->password) > 32) {
				throw new Exception('The password must be less than 32 charcters long');
			}

			// Password missmatch
			if ($this->password != $this->passwordRetype) {
				throw new Exception('Passwords missmatch');
			}

			// Login is unavailable
			if (ModelUser::getUserByLogin($this->login)) {
				throw new Exception('This login is already used');
			}

			// Email is too long
			if (strlen($this->email) > 300) {
				throw new Exception('The email must be less than 300 chaarcters long');
			}

			// Email format is incorrect
			if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				throw new Exception('The email format is invalid');
			}

			// Email is already used
			if (ModelUser::getUserByEmail($this->email)) {
				throw new Exception('The email adress is already used by another account');
			}

			return true;
		}

		// Try to find a user using this login / password, return false if none was found
		public function checkConnect() {
			$password = Usefull::crypt($this->password);

			$where = 'login = :login AND password = :password';
			$values = array(
				'login' => $this->login,
				'password' => $this->password
			);

			return static::readOrFalse($where, $values);
		}

		public function connect() {
			$_SESSION['user'] = $this;
		}

		public static function disconnect() {
			if (isConnected()) {
				unset($_SESSION['user']);
				session_unset();
				session_destroy();
				setcookie(session_name(), '', time() - 1);
			}
		}
	}
?>