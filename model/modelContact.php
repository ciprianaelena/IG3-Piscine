<?php
    require_once File::buildPath(array('model', 'modelCRUD.php'));

    class ModelContact extends ModelCRUD {

        static protected $className = 'ModelContact';
        static protected $tableName = 'suiviContact';

        public static function readAll($idEditeur) {
            $where = 'idEditeur = :idEditeur';
            $values = array('idEditeur' => $idEditeur);
            return static::readOrFalse($where, $values);
        }
    }
?>
