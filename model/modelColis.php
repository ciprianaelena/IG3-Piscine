<?php
    require_once File::buildPath(array('model', 'modelCRUD.php'));

    class ModelColis extends ModelCRUD {

        static protected $className = 'ModelColis';
        static protected $tableName = 'suiviColis';

        public static function getID($id) {
            $where = 'idColis = :idColis';
            $values = array('idColis' => $id);
            return self::readOrFalse($where, $values);
        }
    }

?>
