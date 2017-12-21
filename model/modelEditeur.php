<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelEditeur extends ModelCRUD {

		static protected $className = 'ModelEditeur';
		static protected $tableName = 'editeur';

		// Retourne un editeur par son ID
		public static function getEditeurID($idEditeur) {
			$where = 'idEditeur = :idEditeur';
			$values = array('idEditeur' => $idEditeur);
			return self::readOrFalse($where, $values);
		}
	}

	ModelEditeur::registerModel();
?>