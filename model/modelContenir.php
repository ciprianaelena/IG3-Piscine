<?php
    require_once File::buildPath(array('model', 'modelCRUD.php'));

    class ModelContenir extends ModelCRUD {

        static protected $className = 'ModelContenir';
        static protected $tableName = 'contenir';

        public static function getID($id) {
            $where = 'idContenir = :idContenir';
            $values = array('idContenir' => $id);
            return self::readOrFalse($where, $values);
        }
    }
?>
