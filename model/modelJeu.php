<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelJeu extends ModelCRUD {

		static protected $className = 'ModelJeu';
		static protected $tableName = 'jeu';

		// Retourne un editeur par son ID
		public static function getID($id) {
			$where = 'idJeu = :idJeu';
			$values = array('idJeu' => $id);
			return self::readOrFalse($where, $values);
		}

		private function isNumericSet() {
			
		}
	}
?>