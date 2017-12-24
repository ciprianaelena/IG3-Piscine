<?php
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelFestival extends ModelCRUD {

		static protected $className = 'ModelFestival';
		static protected $tableName = 'festival';

		
	}
?>