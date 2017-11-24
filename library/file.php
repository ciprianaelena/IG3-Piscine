<?php
	
	class File {

		// Retourne le chemin du fichier index.php par apport au serveur
		public static function serverRoot() {
			return '//' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'meme' . DIRECTORY_SEPARATOR;
		}

		// Construit un chemin relatif
		public static function buildPath($arrayPath) {
			$directorySeparator = DIRECTORY_SEPARATOR;
			$rootFolder = __DIR__ . $directorySeparator . "..";

			return $rootFolder . $directorySeparator . join($directorySeparator, $arrayPath);
		}
	}
?>