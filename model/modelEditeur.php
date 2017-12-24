<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelEditeur extends ModelCRUD {

		static protected $className = 'ModelEditeur';
		static protected $tableName = 'editeur';

		// Retourne un editeur par son ID
		public static function getID($id) {
			$where = 'idEditeur = :idEditeur';
			$values = array('idEditeur' => $id);
			return self::readOrFalse($where, $values);
		}

		// Vérifie si le nom de l'éditeur est unique
		public function isNomEditeurUnique() {
			$where = 'nomEditeur = :nomEditeur';
			$values = array('nomEditeur' => $this->nomEditeur);
			$query = self::readOrFalse($where, $values);
			if (!$query) {
				return true;
			} else {
				return false;
			}
		}
	}
?>