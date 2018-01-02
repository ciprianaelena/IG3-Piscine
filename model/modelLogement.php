<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelLogement extends ModelCRUD {

		static protected $className = 'ModelLogement';
		static protected $tableName = 'logement';

		public static function getID($id) {
            $where = 'idDemande = :idDemande';
            $values = array('idDemande' => $id);
            return self::readOrFalse($where, $values);
        }
		
	}
?>