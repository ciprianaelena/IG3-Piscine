<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelRepresentant extends ModelCRUD {

		static protected $className = 'ModelRepresentant';
		static protected $tableName = 'representant';

		// Retourne un représentant par son ID
		public static function getID($id) {
			$where = 'idRepresentant = :idRepresentant';
			$values = array('idRepresentant' => $id);
			return self::readOrFalse($where, $values);
		}

		public static function readAll($idEditeur) {
			$where = 'idEditeur = :idEditeur';
			$values = array('idEditeur' => $idEditeur);
			return static::readOrFalse($where, $values);
		}
	}
?>
