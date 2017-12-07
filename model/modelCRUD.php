<?php

	require_once File::buildPath(array('model', 'model.php'));

	class ModelCRUD extends Model {

		// Prefix de la table si il y en a
		protected static $tablePrefix = '';
		// Nom de la classe
		public static $className = 'model_has_no_class_name';
		// Nom de la table
		protected static $tableName = 'model_has_no_table_name';

		// Fonction de création
		// className est le nom du modele, par exemple 'ModelUser'
		// values est un tableau associatif de nom de colonnes => valeurs
		public static function create($className, $values) {
			// Récupère le nom complet de la table
			$tableFullName = $className::$tablePrefix . $className::$tableName;
			
			// Créer la requête SQL
			$sqlInsert = 'INSERT INTO ' . $tableFullName . '(';
			$sqlValues = ' VALUES (';

			foreach ($values as $columnName => $columnValue) {
				$sqlInsert = $sqlInsert . $columnName . ', ';
				$sqlValues = $sqlValues . ':' . $columnName . ', ';
			}
			$sqlInsert = substr($sqlInsert, 0, -2) . ')';
			$sqlValues = substr($sqlValues, 0, -2) . ')';

			$sql = $sqlInsert . $sqlValues;
			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);
		}

		// Fonction de lecture
		// className est le nom du modele, par exemple 'ModelUser'
		// values est un tableau associatif de nom de colonnes => valeurs
		// conditions est une chaine de caractère de conditions SQL par exemple 'login = :login AND password = :pass'
		public static function read($className, $where, $values) {
			// Récupère le nom complet de la table
			$tableFullName = $className::$tablePrefix . $className::$tableName;

			$sql = 'SELECT * FROM ' . $tableFullName . ' WHERE ' . $where;

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);
			return $query->fetchAll(PDO::FETCH_CLASS, $className);
		}

		// Lit la première ligne vérifiant les conditions. Si aucune n'existe renvoi faux. Utilise la fonction read.
		public static function readOrFalse($className, $where, $values) {
			$result = ModelCRUD::read($className, $where, $values);
			if (empty($result)) {
				return false;
			}
			return $result;
		}

		// Fonction de mise à jour
		// className est le nom du modele, par exemple 'ModelUser' 
		// set est une chaine de caractère de type 'login = :newLogin'
		// where est une chaine de caractère de type 'login = :oldLogin'
		// values est un tableau associatif du type { 'newLogin' => 'Nouveau login', 'oldLogin' => 'Ancien login'}
		public static function update($className, $set, $where, $values) {
			// Récupère le nom complet de la table
			$tableFullName = $className::$tablePrefix . $className::$tableName;

			$sql = 'UPDATE ' . $tableFullName . ' SET ' . $set . ' WHERE ' . $where;

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);
		}

		// Fonction de suppression
		public static function delete($className, $where, $values) {
			// Récupère le nom complet de la table
			$tableFullName = $className::$tablePrefix . $className::$tableName;

			$sql = 'DELETE FROM ' . $tableFullName . ' WHERE ' . $where;

			$query = Bdd::$pdo->prepare($sql);
			$query->execute($values);
		}
	}

?>