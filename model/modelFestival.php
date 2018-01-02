<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelFestival extends ModelCRUD {

		static protected $className = 'ModelFestival';
		static protected $tableName = 'festival';

		public static function getID($id) {
			$where = 'idFestival = :idFestival';
			$values = array('idFestival' => $id);
			return self::readOrFalse($where, $values);
		}
		
		public function isAnneUnique() {
			$where = 'anneeFestival = :anneeFestival';
			$values = array('anneeFestival' => $this->anneeFestival);
			$query = self::readOrFalse($where, $values);
			if (!$query) {
				return true;
			} else {
				return false;
			}
		}
	}
?>