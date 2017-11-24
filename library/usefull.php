<?php
	class Usefull {
		// Méthodes utilitaire passe partout statique
		public static $seed = "57wk4Mf4rEPTt3VuR3d5pW8dPi23Xc7h";

		// Retourne $txt mais crypter avec un seed compliqué à trouver
		public static function crypt($txt) {
			return hash('sha256', Usefull::$seed . $txt);
		}

		// Genére un chiffre de 32 nombre unique & aléatoire
		public static function generateRandomHex() {
			$numbytes = 16; // 32 digits hexa = 16 bytes
			$bytes = openssl_random_pseudo_bytes($numbytes); 
			$hex   = bin2hex($bytes);
			return $hex;
		}

		// Vérifie que l'utilisateur est connecté
		public static function isConnected() {
			return isset($_SESSION['id']);
		}

		// Vérifie que le login est bien l'utilisateur connecté
		public static function isUser($idUser) {
			return (isset($_SESSION['id']) && ($_SESSION['id'] == $idUser));
		}

		// Vérifie si l'utilisateur connecté est admin
		public static function isAdmin() {
			return (isset($_SESSION['admin']) && $_SESSION['admin']);
		}

		// Envoi un mail de $sender à $receiver
		public static function mailto($sender, $receiver, $username, $subject, $message) {
			$headers  = "From: \"" . $username . "\"<". $sender .">\n";
			$headers .= "X-Priority: 1\n";
			$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
			$headers .= "Content-Transfer-Encoding: 8bit";

			$subject = $subject;

			$message = $message;

			// Return true si l'email à bien était envoyé sinon false
			return mail($receiver, $subject, $message, $headers);
		}
	}
?>